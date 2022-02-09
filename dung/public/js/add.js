var locationBtnHtml =
    '<div class="btn_mylct"><a href="#" ><span class="spr_trff spr_ico_mylct"></spa' +
    "n></a></div>";
var map;
navigator.geolocation.getCurrentPosition(function (position) {
    coords = position.coords;

    map = new naver.maps.Map("add-map", {
        center: new naver.maps.LatLng(coords.latitude, coords.longitude),
        zoom: 18,
    });
    naver.maps.Event.once(map, "init", function () {
        var customControl = new naver.maps.CustomControl(locationBtnHtml, {
            position: naver.maps.Position.LEFT,
        });

        customControl.setMap(map);

        naver.maps.Event.addDOMListener(
            customControl.getElement(),
            "click",
            function () {
                map.setCenter(
                    new naver.maps.LatLng(coords.latitude, coords.longitude)
                );
            }
        );
        contentEl.appendTo(map.getElement());
    });
});

function searchCoordinateToAddress(latlng) {
    naver.maps.Service.reverseGeocode(
        {
            coords: latlng,
            orders: [
                naver.maps.Service.OrderType.ADDR,
                naver.maps.Service.OrderType.ROAD_ADDR,
            ].join(","),
        },
        function (status, response) {
            if (status === naver.maps.Service.Status.ERROR) {
                if (!latlng) {
                    return alert("ReverseGeocode Error, Please check latlng");
                }
                if (latlng.toString) {
                    return alert(
                        "ReverseGeocode Error, latlng:" + latlng.toString()
                    );
                }
                if (latlng.x && latlng.y) {
                    return alert(
                        "ReverseGeocode Error, x:" +
                            latlng.x +
                            ", y:" +
                            latlng.y
                    );
                }
                return alert("ReverseGeocode Error, Please check latlng");
            }

            var data = response.v2.results;
            if (data[0].name == "addr") {
                var sido = data[0].region.area1.name;
                var gugn = data[0].region.area2.name;
                var dong = data[0].region.area3.name;
                var li = data[0].region.area4.name;

                var landType = data[0].land.type;
                var landTypeTxt = "";
                if (landType == "2") landTypeTxt = "산";
                var jibun1 = data[0].land.number1;
                var jibun2 = data[0].land.number2;
                if (jibun1) {
                    var jibun = jibun2
                        ? landTypeTxt + jibun1 + "-" + jibun2
                        : landTypeTxt + jibun1;
                }
            }

            var building = "";
            if (data[1]) {
                building = data[1].land.addition0.value || null;
            }
            var address1 = sido + " " + gugn;
            var address2 = dong + " " + (li ? li + " " : "") + jibun + "번지";
            document.getElementsByName("inputtoiletName").item(0).value =
                building;
            document.getElementsByName("inputaddress").item(0).value = address1;
            document.getElementsByName("inputaddressDetail").item(0).value =
                address2;
        }
    );
}

function initGeocoder() {
    naver.maps.Event.addListener(map, "center_changed", function (center) {
        searchCoordinateToAddress(center);
        console.log(center._lat, center._lng);
        var center_lat = center._lat;
        var center_lng = center._lng;
        document.getElementsByName("lat").item(0).value = center_lat;
        document.getElementsByName("lng").item(0).value = center_lng;
    });
}

naver.maps.onJSContentLoaded = initGeocoder;
