import $ from 'jquery'
import Swiper, { Navigation, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, A11y, Autoplay])

class SupportSlider extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.$ = $(this)
    this.resolveElements()
  }

  resolveElements () {
    this.$slider = $('.swiper-container', this)
    this.$buttonPrev = $('.jpkf-support-slider__button--prev', this)
    this.$buttonNext = $('.jpkf-support-slider__button--next', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 2,
      spaceBetween: 0,
      autoplay: {
        delay: 5000
      },
      loop: true,
      navigation: {
        nextEl: this.$buttonNext.get(0),
        prevEl: this.$buttonPrev.get(0)
      },
      breakpoints: {
        800: {
          slidesPerView: 3,
          spaceBetween: 0
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 0
        }
      }
    }

    this.slider = new Swiper(this.$slider.get(0), config)
  }
}

window.customElements.define('flynt-support-slider', SupportSlider, { extends: 'div' })
