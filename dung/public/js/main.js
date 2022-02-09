var HOME_PATH = window.HOME_PATH || ".";
var coords;
//자기위치 버튼 <span class="spr_trff spr_ico_mylct">   12121212</span>
var locationBtnHtml =
    '<div class="btn_mylct" id="btn_mylct"><a href="#"></a></div>';

//GPS
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            coords = position.coords;
            var map = new naver.maps.Map("map", {
                center: new naver.maps.LatLng(
                    coords.latitude,
                    coords.longitude
                ),
                zoom: 18,
            });

            naver.maps.Event.once(
                map,
                "init",
                function () {
                    var customControl = new naver.maps.CustomControl(
                        locationBtnHtml,
                        {
                            position: naver.maps.Position.RIGHT_BOTTOM,
                        }
                    );
                    customControl.setMap(map);

                    naver.maps.Event.addDOMListener(
                        customControl.getElement(),
                        "click",
                        function () {
                            map.setCenter(
                                new naver.maps.LatLng(
                                    coords.latitude,
                                    coords.longitude
                                )
                            );
                        }
                    );

                    /* var contentEl = $('<div class="iw_inner" style="width:350px;position:absolute;top:0;right:0;z-index:1000;background-color:#fff;border:solid 1px #333;">'
                        + '<h3>Map States</h3>'
                        + '<p style="font-size:14px;">centerPoint : <em class="center">'+ map.getCenter() +'</em></p>'
                        + '</div>');
                    contentEl.appendTo(map.getElement());

                    naver.maps.Event.addListener(map, 'bounds_changed', function(bounds) {
                    contentEl.find('.center').text(map.getCenter());
                    });*/

                    var myMarker = new naver.maps.Marker({
                        position: new naver.maps.LatLng(
                            coords.latitude,
                            coords.longitude
                        ),
                        map: map,
                        icon: {
                            content: [
                                `<div class="my-img-content"></div>`,
                            ].join(""),
                            size: new naver.maps.Size(38, 58),
                            anchor: new naver.maps.Point(19, 58),
                        },
                        draggable: false,
                    });

                    $(".toilet").each(function (index) {
                        let row = $(`.toilet:nth-child(${index + 1})`);
                        var marker = new naver.maps.Marker({
                            position: new naver.maps.LatLng(
                                row.attr("lat"),
                                row.attr("lng")
                            ),
                            map: map,
                            icon: {
                                content: [
                                    `<div class="img-content" id="image_${index}" onmouseover="javascript:overCrime(\'toilet_${index}\');" onmouseout="javascript:outCrime(\'toilet_${index}\');"></div>` +
                                        `<div class="icon-content" id="toilet_${index}">` +
                                        `<div class="content-name"> ${row.attr(
                                            "toiletName"
                                        )} </div>` +
                                        `<div class="content-detail"> ${row.attr(
                                            "toiletDetail"
                                        )} <br> ${(
                                            1000 * row.attr("distance")
                                        ).toFixed(0)}m </div>` +
                                        "</div>",
                                ].join(""),
                                size: new naver.maps.Size(38, 58),
                                anchor: new naver.maps.Point(19, 58),
                            },
                            draggable: false,
                        });
                        /*
                        //경로 표시
                        if(index = 0){

                            var polyline = new naver.maps.Polyline({
                                path: polylinePath,
                                strokeColor: '#00CA00',
                                strokeOpacity: 0.8,
                                strokeWeight: 6,
                                zIndex: 2,
                                clickable: true,
                                map: map
                            });
                            var polylinePath = [
                                new naver.maps.LatLng(coords.latitude, coords.longitude),
                                new naver.maps.LatLng(row.attr("lat"), row.attr("lng")),
                            ]
                        }*/
                    });

                    var mappoint = map.getCenter();
                    var paramsStr = location.href.split("?")[1];
                    //location.href = location.href + "?" + mappoint;
                    if (!paramsStr) {
                        location.href =
                            location.href +
                            `?lat=${coords.latitude}&lng=${coords.longitude}`;
                        //location.href = location.href + "?" + mappoint;
                    }
                },
                function (error) {
                    console.error(error);
                },
                {
                    enableHighAccuracy: false,
                    maximumAge: 0,
                    timeout: Infinity,
                }
            );
        });
    } else {
        alert("GPS를 지원하지 않습니다");
    }
}

getLocation();

function overCrime(childID) {
    $("#" + childID).show();
}
function outCrime(childID) {
    $("#" + childID).hide();
}

// function navClose() {
//     document
//         .getElementById("menuicon")
//         .checked = false;
// }
