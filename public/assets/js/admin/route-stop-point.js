let currentMarker = null;
let lat = null;
let lng = null;
let name = '';
var selectedStopPoint = [];
let map;

function initMap() {
    map = new map4d.Map(document.getElementById("map"), {
        center: { lat: 10.7769, lng: 106.7009 },
        zoom: 15,
        controls: true
    });

    // const data = [
    //     { name: "Cửa hàng A", lat: 10.7769, lng: 106.7009, address: "123 Lê Lợi", company: { name: 'Công ty A' }, email: 'congtyA@gmail.com', phone_number: '0123123123', icon: 'shop.png'},
    //     { name: "Công ty B", lat: 10.7801, lng: 106.6999, address: "456 Trần Hưng Đạo", email: 'congtyB@gmail.com', phone_number: '0123123144', icon: 'company.png'},
    // ];

    data.forEach(store => {
        const el = document.createElement('div');
        el.className = 'my-marker';
        el.innerHTML = `
            <div style="display:flex; align-items:center; gap:4px; white-space:nowrap;">
                <img src="/assets/images/${store.icon}" 
                    style="width:25px;height:25px">
                <span style="background:#fff; padding:2px 4px; border-radius:4px; font-size:12px; box-shadow:0 1px 2px rgba(0,0,0,0.3); position: absolute; left: 27px; top: 1.5px;">
                    ${store.name}
                </span>
            </div>
        `;

        const marker = new map4d.Marker({
            position: { lat: store.lat, lng: store.lng },
            iconView: el.outerHTML,
        });
        marker.name = store.name;
        marker.companyName = store.company_name;
        marker.email = store.email;
        marker.address = store.address;
        marker.phoneNumber = store.phone_number;
        marker.shop_id = store.shop_id;
        marker.type = store.type
        marker.setMap(map);
    });

    // sự kiện click marker
    map.addListener("click", (args) => {
        $('.container-map .box-search .list-search').css('display', 'none')
        removeMaker();

        const props = args.marker
        displayPlaceInfo(props.shop_id, props.name, props.companyName, props.email, props.address, props.phoneNumber, props.type)
    }, { marker: true })

    // 2. Lắng nghe click nền bản đồ
    map.addListener("click", (args) => {
        if (!args.marker) {
            // click không phải marker
            $('.place-info').css('display', 'none')
        }
    })

    map.addListener("drag", (args) => {
        $('.container-map .box-search .list-search').css('display', 'none')
    })
}

function displayPlaceInfo(shop_id, name, companyName, email, address, phoneNumber, type) {
    $('.place-info').css('display', 'block');
    $('.place-info .place-info-name').text(name)
    $('.place-info .place-info-company-name').text((companyName != undefined && companyName != 'undefined') ? `Công ty: ${companyName}` : '')
    $('.place-info .place-info-email').text(`Email: ${email}`)
    $('.place-info .place-info-address').text(`Địa chỉ: ${address}`)
    $('.place-info .place-info-phone-number').text(`Số điện thoại: ${phoneNumber}`)
    $('.place-info .place-statistic').html(type == 'shop' ? `<a href="/admin/statistic/${shop_id}" target="_blank">Xem thống kê</a>` : ``)
}

$(document).on('click', '.btn-close-place-info', function () {
    $('.place-info').css('display', 'none');
})

let searchDelayTimer;
$('#input-search-map').on('input', function () {
    clearTimeout(searchDelayTimer);
    searchDelayTimer = setTimeout(searchLocation, 500);
});

$('#input-search-map').on('focus', function () {
    if ($('.container-map .box-search .list-search').html()) {
        $('.container-map .box-search .list-search').css('display', 'block');
    }
});

function hideSearchList() {
    $('.container-map .box-search .list-search').css('display', 'none').html('');
}

function searchLocation() {
    const textSearch = $('#input-search-map').val();

    function displaySearchList(html) {
        $('.container-map .box-search .list-search').css('display', 'block').html(html);
    }

    function createPlaceHTML(place) {
        return `
            <div class="item-search item-place" data-lat="${place.lat}" data-lng="${place.lng}" data-shop-id="${place.shop_id}" data-name="${place.name}" data-company-name="${place.company_name}" data-address="${place.address}" data-type="${place.type}" data-email="${place.email}" data-phone-number="${place.phone_number}">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <g transform="translate(-429 -564)">
                        <g transform="translate(402.497 425.496)">
                            <circle cx="11" cy="11" r="11" transform="translate(27.505 139.504)" fill="#ebebeb"></circle>
                            <g transform="translate(33.836 144.669)">
                                <g transform="translate(0 0)">
                                    <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="#869195"></path>
                                    <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="none"></path>
                                </g>
                                <circle cx="1.941" cy="1.941" r="1.941" transform="translate(2.553 2.553)" fill="#fff"></circle>
                            </g>
                        </g>
                    </g>
                </svg>
                <div class="item-search-text">${place.name} - ${place.address}</div>
            </div>
        `;
    }

    function createNoResultHTML() {
        return `
            <div class="item-search">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <g transform="translate(-429 -564)">
                        <g transform="translate(402.497 425.496)">
                            <circle cx="11" cy="11" r="11" transform="translate(27.505 139.504)" fill="#ebebeb"></circle>
                            <g transform="translate(33.836 144.669)">
                                <g transform="translate(0 0)">
                                    <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="#869195"></path>
                                    <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="none"></path>
                                </g>
                                <circle cx="1.941" cy="1.941" r="1.941" transform="translate(2.553 2.553)" fill="#fff"></circle>
                            </g>
                        </g>
                    </g>
                </svg>
                <div class="item-search-text">Không tìm thấy địa điểm</div>
            </div>
        `;
    }

    function searchByName(keyword) {
        // chuyển keyword thành chữ thường để tìm không phân biệt hoa thường
        const lowerKeyword = keyword.toLowerCase();

        // lọc data
        const results = data.filter(item => item.name.toLowerCase().includes(lowerKeyword));

        return results; // trả về mảng các object khớp
    }

    if (textSearch) {
        let html = '';
        if (data.length > 0) {
            const matched = searchByName(textSearch);
            if (matched.length > 0) {
                $.each(matched, function (index, place) {
                    html += createPlaceHTML(place);
                });
            } else {
                html = createNoResultHTML();
            }
        } else {
            html = createNoResultHTML();
        }
        displaySearchList(html);
    } else {
        hideSearchList();
    }
}

function removeMaker() {
    if (currentMarker !== null) {
        currentMarker.setMap(null);
        lat = null;
        lng = null;
        name = '';
    }
}

$(document).on('click', '.item-place', function () {
    removeMaker();
    hideSearchList();
    lat = $(this).data('lat');
    lng = $(this).data('lng');
    displayPlaceInfo($(this).data('shopId'), $(this).data('name'), $(this).data('companyName'), $(this).data('email'), $(this).data('address'), $(this).data('phoneNumber'), $(this).data('type'))

    currentMarker = new map4d.Marker({
        position: { lat: lat, lng: lng }
    });
    // Hiển thị marker mới trên bản đồ
    currentMarker.setMap(map);

    map.panTo({ lat: lat, lng: lng });
});

$(document).on('click', '.btn-close-place-info', function () {
    $('.place-info').css('display', 'none');
})