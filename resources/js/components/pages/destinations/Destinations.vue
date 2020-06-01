<template>
    <div class="container destinations">
        <div class="title">Destinations</div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div id="map"></div>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</template>
<script>
    module.exports = {
        data() {
            return {}
        },
        mounted() {
            var map;
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 13.7989, lng: 124.2422},
                zoom: 10
            });
        }
    }
</script>