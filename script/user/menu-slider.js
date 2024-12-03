// FOR SLIDER
let swiper = new Swiper(".slide-container", {
  slidesPerView: 4,
  spaceBetween: 20,
  sliderPerGroup: 4,
  loop: true,
  centerSlide: "true",
  fade: "true",
  grabCursor: "true",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


// // FOR FILTER
$(document).ready(function() {
  
  $('.tag[data-filter="all"]').addClass('active');
  $('.menu-item').show(); 
  
  $('.tag').click(function() {
    let filterValue = $(this).attr('data-filter');
    
    $('.tag').removeClass('active');
    $(this).addClass('active');
    
    // PUWEDE NAMANG TANGGALIN YUNG DELAY IF PANGET
    setTimeout(function () {
      if (filterValue == 'all') {
        $('.menu-item').show(); 
      } else {
        $('.menu-item').hide(); 
        $('.menu-item[data-category="' + filterValue + '"]').show(); 
      }
    }, 500);
  });
});