import $ from 'jquery'

$(function () {
  $('#js-fellow-hero-next-btn').on('click', function () {
    $('html, body').animate({
      scrollTop: $('#js-jpkf-fellow-content').offset().top
    }, 1000)
  })
})
