let currentMarker = null;
let lat = null;
let lng = null;
let name = '';
var selectedStopPoint = [];
let map;

// function initMap() {
//     let options = {
//         center: { lat: 21.00922575659716, lng: 105.8238282011933 },
//         zoom: 15,
//         controls: true
//     }
//     map = new map4d.Map(document.getElementById("map"), options)
//     map.addListener("click", (args) => {
//         $('.container-map .box-search .list-search').css('display', 'none')
//         removeMaker();

//         // Tạo marker mới
//         lat = args.location.lat;
//         lng = args.location.lng;
//         localtionDetail(lat, lng)
//         currentMarker = new map4d.Marker({
//             position: {lat: lat, lng: lng}
//         });
//         // Hiển thị marker mới trên bản đồ
//         currentMarker.setMap(map);
//     },
//     {
//         location: true,
//         mappoi: true,
//         mapbuilding: true,
//         marker: true,
//         polygon: true,
//         polyline: true,
//         circle: true,
//         poi: true,
//         building: true,
//         place: true
//     })

//     map.addListener("drag", (args) => {
//         $('.container-map .box-search .list-search').css('display', 'none')
//     })
// }


// function initMap() {
//   const map = new map4d.Map(document.getElementById("map"), {
//     center: { lat: 10.7769, lng: 106.7009 },
//     zoom: 15,
//     controls: true
//   });

//   const stores = [
//     { name: "Cửa hàng A", lat: 10.7769, lng: 106.7009, address: "123 Lê Lợi" },
//     { name: "Cửa hàng B", lat: 10.7801, lng: 106.6999, address: "456 Trần Hưng Đạo" },
//   ];

//   const popupEl = document.getElementById('store-popup');

//   stores.forEach(store => {
//     // tạo DOM element cho marker
//     const el = document.createElement('div');
//     el.className = 'mf-marker';
//     el.innerHTML = `<img src="https://map4d.vn/images/default_marker.png" alt="${store.name}">`;
//     el.style.cursor = 'pointer';

//     // click trên DOM element => show popup
//     el.addEventListener('click', (ev) => {
//         console.log(123)
//     //   popupEl.innerHTML = `<strong>${store.name}</strong><br>${store.address}`;
//     //   popupEl.style.left = ev.pageX + 'px';
//     //   popupEl.style.top  = ev.pageY + 'px';
//     //   popupEl.style.display = 'block';
//     });

//     // // ẩn popup khi click ra ngoài
//     // document.addEventListener('click', (e) => {
//     //   if (!el.contains(e.target)) popupEl.style.display = 'none';
//     // });

//     // gắn el vào marker
//     const marker = new map4d.Marker({
//       position: { lat: store.lat, lng: store.lng },
//     //   iconView: el
//     });
//     marker.setMap(map);
//   });
// }

function initMap() {
    const map = new map4d.Map(document.getElementById("map"), {
        center: { lat: 10.7769, lng: 106.7009 },
        zoom: 15,
        controls: true
    });

    const stores = [
        { name: "Cửa hàng A", lat: 10.7769, lng: 106.7009, address: "123 Lê Lợi" },
        { name: "Cửa hàng B", lat: 10.7801, lng: 106.6999, address: "456 Trần Hưng Đạo" },
    ];

    stores.forEach(store => {
        const el = document.createElement('div');
        el.className = 'my-marker';
        el.innerHTML = `<img src="https://motorbike-store-management.test/assets/images/user.jpg" style="width:20px;height:20px">`;

        const marker = new map4d.Marker({
            position: { lat: store.lat, lng: store.lng },
            iconView: el.outerHTML,
            title: store.name,
            snippet: store.address,
        });
        marker.setMap(map);
    });
}

// function removeMaker() {
//     if (currentMarker !== null) {
//         currentMarker.setMap(null);
//         lat = null;
//         lng = null;
//         name = '';
//     }
// }

// $("#select-stop-point").click(function () {
//     if (lat == null) {
//         alert("Vui lòng chọn một điểm dừng trên bản đồ!");
//         return;
//     }

//     addStopPoint(lat, lng, name);
//     removeMaker();
//     hideSearchList();
//     $('#input-search-map').val('')
//     $("#modal-stop-point").modal('hide');
// });

// function addStopPoint(lat, lng, name) {
//     const index = selectedStopPoint.length;

//     selectedStopPoint.push({ lat, lng, name });

//     $('#stop-points').append(`
//         <div class="row mb-3" id="stop-point-${index}">
//             <input type="number" hidden class="form-control" name="stop_points[${index}][latitude]" value="${lat}">
//             <input type="number" hidden class="form-control" name="stop_points[${index}][longitude]" value="${lng}">
//             <div class="col-9">
//                 <input type="text" class="form-control" name="stop_points[${index}][name]" value="${name}">
//             </div>
//             <div class="col-3">
//                 <button type="button" class="btn bg-danger text-danger bg-soft remove-stop-point" data-index="${index}">
//                     <i class="mdi mdi-delete-outline"></i>
//                 </button>
//             </div>
//         </div>
//     `);

//     $(`#stop-point-${index} .remove-stop-point`).click(function () {
//         selectedStopPoint.splice(index, 1);

//         $(`#stop-point-${index}`).remove();
//     });
// }

// let searchDelayTimer;
// $('#input-search-map').on('input', function () {
//     clearTimeout(searchDelayTimer);
//     searchDelayTimer = setTimeout(searchLocation, 500);
// });

// $('#input-search-map').on('focus', function () {
//     if ($('.container-map .box-search .list-search').html()) {
//         $('.container-map .box-search .list-search').css('display', 'block');
//     }
// });

// function hideSearchList() {
//     $('.container-map .box-search .list-search').css('display', 'none').html('');
// }

// function searchLocation() {
//     const textSearch = $('#input-search-map').val();

//     function displaySearchList(html) {
//         $('.container-map .box-search .list-search').css('display', 'block').html(html);
//     }

//     function createPlaceHTML(place) {
//         return `
//             <div class="item-search item-place" data-lat="${place.location.lat}" data-lng="${place.location.lng}" data-name="${place.name}" data-address="${place.address}">
//                 <svg width="24" height="24" viewBox="0 0 24 24">
//                     <g transform="translate(-429 -564)">
//                         <g transform="translate(402.497 425.496)">
//                             <circle cx="11" cy="11" r="11" transform="translate(27.505 139.504)" fill="#ebebeb"></circle>
//                             <g transform="translate(33.836 144.669)">
//                                 <g transform="translate(0 0)">
//                                     <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="#869195"></path>
//                                     <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="none"></path>
//                                 </g>
//                                 <circle cx="1.941" cy="1.941" r="1.941" transform="translate(2.553 2.553)" fill="#fff"></circle>
//                             </g>
//                         </g>
//                     </g>
//                 </svg>
//                 <div class="item-search-text">${place.name} - ${place.address}</div>
//             </div>
//         `;
//     }

//     function createNoResultHTML() {
//         return `
//             <div class="item-search">
//                 <svg width="24" height="24" viewBox="0 0 24 24">
//                     <g transform="translate(-429 -564)">
//                         <g transform="translate(402.497 425.496)">
//                             <circle cx="11" cy="11" r="11" transform="translate(27.505 139.504)" fill="#ebebeb"></circle>
//                             <g transform="translate(33.836 144.669)">
//                                 <g transform="translate(0 0)">
//                                     <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="#869195"></path>
//                                     <path d="M6.294,1.2A4.49,4.49,0,0,0,1.8,5.694a4.308,4.308,0,0,0,.681,2.349L5.987,13.8c.068.1.136.17.238.17A.342.342,0,0,0,6.6,13.8l3.541-5.822a4.558,4.558,0,0,0,.647-2.315A4.482,4.482,0,0,0,6.294,1.2Z" transform="translate(-1.8 -1.2)" fill="none"></path>
//                                 </g>
//                                 <circle cx="1.941" cy="1.941" r="1.941" transform="translate(2.553 2.553)" fill="#fff"></circle>
//                             </g>
//                         </g>
//                     </g>
//                 </svg>
//                 <div class="item-search-text">Không tìm thấy địa điểm</div>
//             </div>
//         `;
//     }

//     if (textSearch) {
//         $.ajax({
//             url: 'https://api.map4d.vn/sdk/place/text-search',
//             type: 'GET',
//             data: {
//                 key: map4dKey,
//                 text: textSearch,
//             },
//             dataType: 'json',
//             success: function (response) {
//                 let html = '';
//                 if (response.result.length > 0) {
//                     $.each(response.result, function (index, place) {
//                         html += createPlaceHTML(place);
//                     });
//                 } else {
//                     html = createNoResultHTML();
//                 }
//                 displaySearchList(html);
//             },
//             error: function (xhr, status, error) {
//                 console.log('Error:', error);
//                 displaySearchList(createNoResultHTML());
//             }
//         });
//     } else {
//         hideSearchList();
//     }
// }

// $(document).on('click', '.item-place', function () {
//     removeMaker();
//     lat = $(this).data('lat');
//     lng = $(this).data('lng');
//     name = $(this).data('name') + '-' + $(this).data('name');
//     displayPlaceInfo($(this).data('name'), $(this).data('name'), lat, lng)

//     currentMarker = new map4d.Marker({
//         position: { lat: lat, lng: lng }
//     });
//     // Hiển thị marker mới trên bản đồ
//     currentMarker.setMap(map);

//     map.panTo({ lat: lat, lng: lng });
// });

// function localtionDetail(lat, lng) {
//     $.ajax({
//         url: 'https://api.map4d.vn/sdk/v2/geocode',
//         type: 'GET',
//         data: {
//             key: map4dKey,
//             location: lat + ', ' + lng,
//         },
//         dataType: 'json',
//         success: function (response) {
//             if (response.result.length > 0) {
//                 let result = response.result[0];
//                 displayPlaceInfo(result.name, result.address, lat, lng)
//                 name = result.name + " - " + result.address;
//             } else {
//                 $('.place-info').css('display', 'none');
//             }
//         },
//         error: function (xhr, status, error) {
//             console.log('Error:', error);
//             $('.place-info').css('display', 'none');
//         }
//     });
// }

// function displayPlaceInfo(name, address, lat, lng) {
//     $('.place-info').css('display', 'block');
//     $('.place-info .place-info-name').text(name)
//     $('.place-info .place-info-address').text(name + " - " + address)
//     // $('.place-info .place-info-latlng').text(lat + ', ' + lng)
// }

// $(document).on('click', '.btn-close-place-info', function () {
//     $('.place-info').css('display', 'none');
// })