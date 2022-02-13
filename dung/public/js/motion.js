$(document).ready(function () {
    $(".menu_btn>a").on("click", function () {
        $(".menu_bg").show();
        $("#sidebar_menu").show().animate({
            left: 0,
        });
    });
    $(".close_btn>a").on("click", function () {
        $(".menu_bg").hide();
        $("#sidebar_menu").animate(
            {
                left: "-" + 50 + "%",
            },
            function () {
                $("#sidebar_menu").hide();
            }
        );
    });
});

$(document).mouseup(function (e) {
    var target = $("#sidebar_menu");
    if (target.has(e.target).length == 0) {
        $(".menu_bg").hide();
        target.animate({
            left: "-" + 50 + "%",
        });
    }
});

$(window).load(function () {
    $(".loading").fadeOut();
});

function showPopup(hasFilter) {
    const popup = document.querySelector("#popup");

    if (hasFilter) {
        popup.classList.add("has-filter");
    } else {
        popup.classList.remove("has-filter");
    }

    popup.classList.remove("hide");
}

$(document).mouseup(function (e) {
    var target = $("#popup");
    if (target.has(e.target).length == 0) {
        target.addClass("hide");
    }
});

function closePopup() {
    const popup = document.querySelector("#popup");
    popup.classList.add("hide");
}

$(function () {
    $(".info").slice(0, 10).show();
    $("#more").on("click", function (e) {
        e.preventDefault();
        $(".info:hidden").slice(0, 4).fadeIn("slow");
        if ($(".info:hidden").length == 0) {
            $("#more").fadeOut("slow");
        }
    });
});
