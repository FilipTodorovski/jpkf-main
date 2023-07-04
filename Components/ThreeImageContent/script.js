import $ from 'jquery'

$(function () {
  $('#js-jpkf-three-image-content__arrow-down').on('click', function () {
    $('html, body').animate({
      scrollTop: $('#jpkf-three-image-content__top-next').offset().top
    }, 1000)
  })
})
