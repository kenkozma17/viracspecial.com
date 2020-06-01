<template>
    <nav class="navigation">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <a href="/">
                        <img src="/images/Logo.png" class="logo" alt="Virac Special Logo">
                    </a>
                </div>
                <div class="col">
                    <div class="nav-item-container">
                        <a href="/" class="nav-item">Home</a>
                        <a href="/vs-blog" class="nav-item">Blog</a>
                        <a href="/destinations" class="nav-item">Destinations</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
    module.exports = {
        data() {
            return {}
        },
        methods: {
            stickyNav() {
                let nav = $('.navigation'), scrolled = window.pageYOffset;
                if(window.location.pathname === '/') {
                    (scrolled > 100) ? nav.addClass('sticky') : nav.removeClass('sticky');
                } else {
                    nav.addClass('sticky');
                }
            }
        },
        mounted: function() {
            this.stickyNav();
            window.addEventListener('scroll', this.stickyNav);
        }
    }
</script>