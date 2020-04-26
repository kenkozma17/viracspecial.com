<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span>Hey, </span>
                </li>
                <li class="nav-item" v-if="$auth.check()" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                    <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
                </li>
                <li class="nav-item" v-if="$auth.check()">
                    <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    export default {
        data() {
            return {
                routes: {
                    // UNLOGGED
                    unlogged: [
                        {
                            name: 'Register',
                            path: 'register'
                        },
                        {
                            name: 'Login',
                            path: 'login'
                        }
                    ],
                    // LOGGED USER
                    user: [
                        {
                            name: 'Dashboard',
                            path: 'dashboard'
                        }
                    ],
                    // LOGGED ADMIN
                    admin: [
                        {
                            name: 'Dashboard',
                            path: 'admin.dashboard'
                        }
                    ]
                },
                auth: this.$auth
            }
        },
        watch() {
            if(this.$auth.ready()) {
                console.log('ready!');
                console.log(this.auth.user());
            }
        },
    }
</script>