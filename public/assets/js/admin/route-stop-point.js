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

    const data = [
        { name: "Cửa hàng A", lat: 10.7769, lng: 106.7009, address: "123 Lê Lợi", company: { name: 'Công ty A' }, email: 'congtyA@gmail.com', phone_number: '0123123123', icon: 'shop.png'},
        { name: "Công ty B", lat: 10.7801, lng: 106.6999, address: "456 Trần Hưng Đạo", email: 'congtyB@gmail.com', phone_number: '0123123144', icon: 'company.png'},
    ];

    data.forEach(store => {
        const el = document.createElement('div');
        el.className = 'my-marker';
        el.innerHTML = `<img src="https://motorbike-store-management.test/assets/images/${store.icon}" style="width:25px;height:25px">`;

        const marker = new map4d.Marker({
            position: { lat: store.lat, lng: store.lng },
            iconView: el.outerHTML,
        });
        marker.name = store.name;
        marker.companyName = store.company?.name;
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