let currentMarker = null;
let lat = null;
let lng = null;
let name = '';
var selectedStopPoint = [];
let map;

function initMap() {
    const map = new map4d.Map(document.getElementById("map"), {
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
                <img src="https://motorbike-store-management.test/assets/images/${store.icon}" 
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
        marker.setMap(map);
    });

    // sự kiện click marker
    map.addListener("click", (args) => {
        const props = args.marker
        displayPlaceInfo(props.name, props.companyName, props.email, props.address, props.phoneNumber)
    }, { marker: true })

    // 2. Lắng nghe click nền bản đồ
    map.addListener("click", (args) => {
        if (!args.marker) {
            // click không phải marker
            $('.place-info').css('display', 'none')
        }
    })
}

function displayPlaceInfo(name, companyName, email, address, phoneNumber) {
    $('.place-info').css('display', 'block');
    $('.place-info .place-info-name').text(name)
    $('.place-info .place-info-company-name').text(companyName ? `Công ty: ${companyName}` : '')
    $('.place-info .place-info-email').text(`Email: ${email}`)
    $('.place-info .place-info-address').text(`Địa chỉ: ${address}`)
    $('.place-info .place-info-phone-number').text(`Số điện thoại: ${phoneNumber}`)
}

$(document).on('click', '.btn-close-place-info', function () {
    $('.place-info').css('display', 'none');
})