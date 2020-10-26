$(document).ready(function() {
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    items: 2,
    margin: 30,
    nav: false,
    dots: false,
  });
  // Go to the next item
  $('#next-slide').click(function() {
    owl.trigger('next.owl.carousel');
  });
  // Go to the previous item
  $('#previous-slide').click(function() {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel');
  });
});