import $ from 'jquery'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

$(function () {
  $('.jpkf-header__mobile-btn').on('click', function () {
    if ($(this).hasClass('is-open')) {
      enableBodyScroll(document.querySelector('#js-jpkf-header__menu'))
      $(this).removeClass('is-open')
      $('.jpkf-header__menu').removeClass('is-open')
    } else {
      disableBodyScroll(document.querySelector('#js-jpkf-header__menu'))
      $(this).addClass('is-open')
      $('#js-jpkf-header__menu').innerHeight(window.innerHeight - 140)
      $('.jpkf-header__menu').addClass('is-open')
    }
  })
})
