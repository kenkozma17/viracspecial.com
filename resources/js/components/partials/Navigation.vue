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
                        <a href="/" class="nav-item">Contact Us</a>
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
                (scrolled > 100) ? nav.addClass('sticky') : nav.removeClass('sticky');
            }
        },
        created: function() {
            window.addEventListener('scroll', this.stickyNav);
        }
    }
</script>