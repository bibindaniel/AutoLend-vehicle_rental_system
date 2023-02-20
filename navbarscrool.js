$(document).ready(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() >100) {
        $('.navbar').addClass('solid-nav');
      } else {
        $('.navbar').removeClass('solid-nav');
      }
    });
    $("#news-slider").owlCarousel({
      items: 3,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [980, 2],
      itemsMobile: [600, 1],
      navigation: true,
      navigationText: ["", ""],
      pagination: true,
      autoPlay: true });
  });