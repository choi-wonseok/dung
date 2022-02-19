var HOME_PATH = window.HOME_PATH || ".";
var coords;
var locationBtnHtml =
    '<div class="btn_mylct" id="btn_mylct"><a href="#"></a></div>';
var locationBtnHtml1 =
<<<<<<< HEAD
    '<div id="toilet_{{ $row->toiletNum }}"><a href="#"></a></div>';
var locationBtnHtml2 =
    '<div id="toilet__{{ $row->toiletNum }}"><a href="#"></a></div>';
=======
    '<div class="info" id="toilet_{{ $row->toiletNum }}"><a href="#"></a></div>';

>>>>>>> 4f840f8e0f81c9a3815c1ac2ccf0c427e9933c3a
//GPS
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                coords = position.coords;

                var map = new naver.maps.Map("map", {
                    center: new naver.maps.LatLng(
                        coords.latitude,
                        coords.longitude
                    ),
                    zoom: 18,
                });

                naver.maps.Event.once(map, "init", function () {
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
                });

                $(".toilet").each(function (index) {
                    let row = $(`.toilet:nth-child(${index + 1})`);
                    //지도 이동
                    var toilet_num = row.attr("toiletNum");
                    var a = new naver.maps.LatLng(
                        row.attr("lat"),
                        row.attr("lng")
                    );
                    $("#toilet_" + toilet_num).on("click", function (e) {
                        map.setCenter(a);
                        console.log(e);
                    });
                    $("#toilet__" + toilet_num).on("click", function (e) {
                        map.setCenter(a);
                        console.log(e);
                    });

                    var marker = new naver.maps.Marker({
                        position: new naver.maps.LatLng(
                            row.attr("lat"),
                            row.attr("lng")
                        ),
                        map: map,
                        icon: {
                            content: [
                                `<div class="img-content" id="image_${index}"></div>` +
                                    `<div class="icon-content" id="toilet_${index}">` +
                                    `<div class="content-name"><a class="link"; href="nmap://route/walk?slat=null&slng=null&sname=null&dlat=${row.attr(
                                        "lat"
                                    )}&dlng=${row.attr("lng")}&dname=${row.attr(
                                        "toiletName"
                                    )}&appname=https://x-angels.ml"> ${row.attr(
                                        "toiletName"
                                    )}</a></div>` +
                                    `<div class="content-detail"> ${row.attr(
                                        "toiletDetail"
                                    )} <br> ${row.attr("ToiletPaper")} <br>
                                    ${(1000 * row.attr("distance")).toFixed(
                                        0
                                    )}m </div>` +
                                    "</div>",
                            ].join(""),
                            size: new naver.maps.Size(38, 58),
                            anchor: new naver.maps.Point(19, 58),
                        },
                        draggable: false,
                    });
                    console.log(index);

                    $(document).ready(function () {
                        $("#image_" + index).click(function (event) {
                            event.stopPropagation();
                            $("#toilet_" + index).slideToggle("slow");
                        });
                        $("#toilet_" + index).on("click", function (event) {
                            event.stopPropagation();
                        });
                    });
                    $(document).on("click", function () {
                        $("#toilet_" + index).hide();
                    });
                });

                var mappoint = map.getCenter();
                var paramsStr = location.href.split("?")[1];
                if (!paramsStr) {
                    location.href =
                        location.href +
                        `?lat=${coords.latitude}&lng=${coords.longitude}`;
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
    } else {
        alert("GPS를 지원하지 않습니다");
    }
}

getLocation();

$(document).ready(function () {
    $(".my-add").click(function (event) {
        event.stopPropagation();
        $(".myadd").slideToggle("slow");
    });
    $(".myadd").on("click", function (event) {
        event.stopPropagation();
    });
});
$(document).on("click", function () {
    $(".myadd").hide();
});
