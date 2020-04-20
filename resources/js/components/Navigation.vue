<template>
    <div class="navigation">
        <div class="container navigation-container">
            <div class="row">
                <div class="col-4 logo-container">
                    <img src="/images/Logo.png" class="logo" alt="Virac Special Logo">
                </div>
                <div class="col-8 navigation-items">
                    <router-link class="navigation-item" :to="{ name: 'home' }">Home</router-link>
                    <router-link class="navigation-item" :to="{ name: 'about' }">About</router-link>
                    <router-link class="navigation-item" :to="{ name: 'blog' }">Blog</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>