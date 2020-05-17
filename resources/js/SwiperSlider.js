import Swiper from 'swiper';

export default class SwiperSlider {
    constructor() {
        this.fullSliderEl = $('.swiper-fullscreen');
        this.multiSliderEl = $('.swiper-multi');
        if(this.fullSliderEl.length) {
            this.fullSlider(this.fullSliderEl);
        }
        if(this.multiSliderEl.length) {
            this.multiSlider(this.multiSliderEl);
        }
    }

    fullSlider(el) {
        let swiper = new Swiper(el, {
            centeredSlides: true,
            speed: 1000,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 6000,
                disableOnInteraction: true,
                stopOnLastSlide: true
            },
        });
    }

    multiSlider(el) {
        let swiper = new Swiper(el, {
            slidesPerView: 3,
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
}