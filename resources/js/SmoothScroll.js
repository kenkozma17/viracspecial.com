export default class SmoothScroll {
    constructor() {
        this.linkElem = $('a[href^="#"]');
        this.setEventListeners();
    }

    setEventListeners() {
        this.linkElem.on('click', e => this.smoothScroll(e));
    }

    smoothScroll(e) {
        e.preventDefault();
        let target = e.currentTarget.hash;

        $('html, body').stop().animate({
            scrollTop: $(target).offset().top - 70
        }, 1000);
        return false;
    }
}
