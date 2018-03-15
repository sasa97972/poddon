jQuery(document).ready(function($) {
    $(".nav__system-cart").click(function () {
        $(".cart__modal").fadeIn(500);
    });

    $(".cart__close").click(function () {
        $(".cart__modal").fadeOut(500);
    });

    $(".events__button").click(function() {
        alert("Для того чтобы продать свои поддоны, вам нужно связатся с нами по одному из телефонов: 066-900-96-02 или 098-575-87-70");
        return false;
    })
});