$(document).ready(function () {
    sessionStorage.getItem("active");

    $("#sidebarCollapse").on("click", function () {
        $("#sidebar").addClass("active");
    });

    $("#sidebarCollapseX").on("click", function () {
        $("#sidebar").removeClass("active");
    });

    $("#sidebarCollapse").on("click", function () {
        if ($("#sidebar").hasClass("active")) {
            $(".overlay").addClass("visible");
            console.log("it's working!");
        }
    });

    $("#sidebarCollapseX").on("click", function () {
        $(".overlay").removeClass("visible");
    });

    var elAct = parseInt(sessionStorage.getItem("active")) + 1;
    if(elAct)
        var obj = ".navbar-nav > li:nth-child(" + elAct + ") > a";

    $($(obj)).addClass("active");

    $(".category > li").each(function () {
        $(this).on("click", function () {
            resetActive();

            $(this).addClass("active");
            sessionStorage.setItem("active", $(this).index());

            if ($(this).hasClass("dropdown")) {
                if ($(this).children().hasClass('abrir')) {
                    $(this).children(".dropdown-menu").removeClass('abrir');
                } else {
                    $(this).children(".dropdown-menu").addClass('abrir');
                }
            }
        });
    });

    function resetActive() {
        $(".category > li").each(function () {
            $(this).removeClass("active");

            if ($(this).hasClass("dropdown"))
                $(this).children(".dropdown-menu").removeClass('abrir');
        });
    }

    $(".form-save-prod > *").each(function () {
        $(this).on("keyup", function () {
            $("#title-card-example").text($("#title").val());
            $("#price-card-example").text($("#prc").val().toString().replace(".", ","));
        })
    })

    if ($("#popup")) {
        setTimeout(() => {
            var el = $("#popup");
            el.remove();
        }, 3000);
    }

    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 0) {
            $('body').css({
                paddingTop: 140 + $('.navbar').height() + "px"
            });
            $('.navbar').addClass('nav-scroll');
        } else {
            $('body').css({
                paddingTop: 20 + "px"
            });
            $('.navbar').removeClass('nav-scroll');
        }
    });

    const switchers = [...document.querySelectorAll('.switcher')]

    switchers.forEach(item => {
        item.addEventListener('click', function () {
            switchers.forEach(item => item.parentElement.classList.remove('is-active'))
            this.parentElement.classList.add('is-active')
        })
    })
});

function previewFile() {
    var preview = document.querySelector(".prev-img");
    var file = document.querySelector("#img").files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}