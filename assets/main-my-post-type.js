/* shop about swiper */
jQuery(document).ready(function() {

var full_weight=0;
var container = $('.swiper_about_shop').width();
$(".swiper_about_shop>.swiper-wrapper>.swiper-slide").each(function(){full_weight+=$(this).width();});
  if(full_weight > container){
    $('.swiper_about_shop').prepend('<div class="arrow_container"><div class="swiper-button-next"><svg class="svg-icon svg-icon-chevron-right" focusable="false" height="16" width="16" viewBox="0 0 12 12" aria-hidden="true"><path d="M8.5 5.987a.58.58 0 0 0-.138-.385L6.767 2.956 5.172.311C4.742-.404 3.669.242 4.1.956l1.517 2.516 1.517 2.516-3.035 5.057c-.429.715.644 1.358 1.073.643l3.191-5.316a.58.58 0 0 0 .137-.385z"></path></svg></div><div class="swiper-button-prev"><svg class="svg-icon svg-icon-chevron-left" focusable="false" height="16" width="16" viewBox="0 0 12 12" aria-hidden="true"><path d="M4 5.987a.58.58 0 0 1 .138-.385l1.595-2.646L7.328.311C7.758-.404 8.831.242 8.4.956L6.883 3.472 5.366 5.988l3.035 5.057c.429.715-.644 1.358-1.073.643L4.137 6.372A.58.58 0 0 1 4 5.987z"></path></svg></div></div>')
  }else {}

var swiper = new Swiper('.swiper_about_shop', {
      slidesPerView: 4,
      //slidesPerView: 'auto',
      //centeredSlides: true,
      spaceBetween: 8,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    breakpoints: {
    480: {
      slidesPerView: 1
    },
    790: {
      slidesPerView: 2
    },
    1040: {
      slidesPerView: 3
    },
    1280: {
      slidesPerView: 4
    }
  }

    });

});
/* shop about swiper end */