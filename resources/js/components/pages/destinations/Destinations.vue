<template>
    <div class="container medium destinations">
        <div class="title">Destinations</div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="locations-list">
                    <div class="card mb-3" v-for="(location, index) in locations">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div class="image" :data-marker-id="index" :style="{ 'background-image': 'url(' + location.image + ')' }"></div>
                            </div>
                            <div class="col-md-8 card-content">
                                <div class="card-body">
                                    <h5 class="card-title" :data-marker-id="index">{{ location.title }}</h5>
                                    <p :data-marker-id="index" class="card-text" v-html="location.limited_content"></p>
                                    <a target="_blank" :href="location.website" class="card-text"><small class="text-muted">Visit Website</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="map"></div>
            </div>
        </div>
    </div>
</template>
<script>
    const {Loader} = require('google-maps');
    module.exports = {
        props: ['locations', 'googleApiKey'],
        methods: {
            loadMapStyle() {
                return [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}];
            },
            scrollTo(destination) {
                if($(window).width() < 769) {
                    $('html, body').stop().animate({
                        scrollTop: $(destination).offset().top - 100
                    }, 1000);
                }
            },
        },
        mounted() {
            let _this = this;
            const loader = new Loader(this.googleApiKey);
            loader.load().then((google) => {
                const markers = [];
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 13.7989, lng: 124.2422},
                    zoom: 10,
                    styles: this.loadMapStyle()
                });

                const locations = this.locations.forEach((item, key) => {
                    let marker = new google.maps.Marker({
                        position: new google.maps.LatLng(item.lat,item.lng),
                        icon: {
                            url: "/svg/marker.svg",
                            scaledSize: new google.maps.Size(14, 18)
                        },
                        map: map,
                        anchor: "map"+key,
                        title: item.title,
                        content: item.content,
                        optimized: false
                    });

                    // Set infowindow content for the marker
                    marker["infowindow"] = new google.maps.InfoWindow({
                        content: `
                            <div id="marker-infowindow">
                                <img style="max-width: 100%" src="` + item.image + `" />
                                <div class="info-wrapper">
                                    <br>
                                    <h5>${item.title}</h5>
                                    <p>${item.content}</p>
                                    <p>${item.address ? item.address : ''}</p>
                                    <a target="_blank" href="${item.website}">Visit Website</a>
                                </div>
                            </div>
                            `,
                    });

                    // Add event listener to marker for scrolling to the location's employees
                    google.maps.event.addListener(marker, "mousedown", function() {
                        markers.forEach(function(marker) {
                            marker.infowindow.close(map, marker);
                        });
                        // Open infowindow
                        this["infowindow"].open(map, this);
                    });

                    markers.push(marker);
                });

                /** Opens infowindow on click from buildings list on sidebar */
                const cardTitle = document.querySelectorAll('.card-title, .card-text');
                if(cardTitle) {
                    cardTitle.forEach((el) => {
                        el.addEventListener('click',(e) => {
                            google.maps.event.trigger(markers[e.target.dataset.markerId], 'mousedown');
                            _this.scrollTo('#map');
                        });
                    });
                }

                const cardImage = document.querySelectorAll('.image');
                if(cardImage) {
                    cardImage.forEach((el) => {
                        el.addEventListener('click',(e) => {
                            google.maps.event.trigger(markers[e.target.dataset.markerId], 'mousedown');
                            _this.scrollTo('#map');
                        });
                    });
                }
            });
        }
    }
</script>
