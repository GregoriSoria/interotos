(function ($) {
    var styles = [
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e9e9e9"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#dedede"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#333333"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f2f2f2"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        }
    ];

    /*Data for the markers consisting of a name, a LatLng and a zIndex for the
    order in which these markers should display on top of each other.*/
    var beaches = [
        ['Bondi Beach', -33.9, 151.151, 1]
    ];
    var myLatlng = {lat: 13.8705583 - 0.0033, lng: 100.5976089 - 0.0055};

    /* Begin Map contact short code*/
	var json= {};
    var json1= {};
	var timeout_map = 1;
	var attr = '';

	if ($( "#map" ).length) {
		timeout_map = 2000;
		var address = $( '#map' ).data( 'address' );
		if (address != '') {
			$.ajax({
				url: "http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
				type: "POST",
                async: false,
				success: function(res){
					json.address = address;
					json.lat = res.results[0].geometry.location.lat;
					json.lng = res.results[0].geometry.location.lng;
					$('#map').attr('data-json', JSON.stringify(json));
				}
			});
		}
	}

    if ($( "#footer-map" ).length) {
        timeout_map = 2000;
        var address = $( '#footer-map' ).data( 'address' );
        var lat = $( '#footer-map' ).data( 'lat' );
        var lng = $( '#footer-map' ).data( 'lng' );
        if( lat != '' && lng != '' ){
            json.lat = lat;
            json.lng = lng;
            if (address != '') {
                json.address = address;
            }
            $('#footer-map').attr('data-json', JSON.stringify(json));
        }else{
            if (address != '') {
                $.ajax({
                    url: "http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
                    type: "POST",
                    async: false,
                    success: function(res){
                        json.address = address;
                        json.lat = res.results[0].geometry.location.lat;
                        json.lng = res.results[0].geometry.location.lng;
                        $('#footer-map').attr('data-json', JSON.stringify(json));
                    }
                });
            }
        }
    }

    function map_init() {

    if ( $('#map').attr('data-address') ) {
        if ($("#map").length) {
            var data = $('#map').data( 'json' );
            if( data != undefined ) {
                myLatlng = {lat: parseFloat(data.lat), lng: parseFloat(data.lng)};
                var markerLatLng = {lat: parseFloat(data.lat), lng: parseFloat(data.lng)};
                var markerTitle = data.address;
            }
        }
        /*If document (your website) is wider than 767px, isDraggable = true, else isDraggable = false*/
        var isDraggable = $(document).width() > 767 ? true : false;
        if ( $('#map').attr('data-zoom') ) {
            var zoom;
            zoom = parseInt($('#map').attr('data-zoom'));
        }
        var styledMap = new google.maps.StyledMapType(styles,
            {name: "Styled Map"});
        var myOptions = {
            zoom: zoom,
            center: myLatlng,
            mapTypeControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggable: isDraggable,
            scrollwheel: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }

        };
        var contentString = '<div id="content">' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var map = new google.maps.Map(document.getElementById('map'), myOptions);
        var icon =  $('#map').attr('data-img-url');
        var phone = '';
        var address = '';
        var img = '';
        var marker = new google.maps.Marker({
            position: markerLatLng,
            map: map,
            icon: icon,
            title: 'medic plus',
        });
        if ( $('#map').attr('data-phone') ) {
            phone = '<div class="g-phone-num medic-phone"><i class="fa fa-phone"></i>'+ $('#map').attr('data-phone') +'</div>';
        }
        if ( $('#map').attr('data-urlimg') ) {
            img = '<div class="logo"><div class="header-logo"><img src="'+ $('#map').attr('data-urlimg') +'" alt=""></div></div>';
        }
        if ( $('#map').attr('data-address') ) {
            address = '<div class="g-address medic-text"><i class="fa fa-home"></i>'+ $('#map').attr('data-address') +'</div>';
        }
        var contentString = '<div id="content" class="map-content">' +
            '<div class="text-center">' +
            img +
            /*'<h1 id="firstHeading" class="firstHeading medic-title"></h1>' +*/
             address +
             phone  +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        google.maps.event.addListener(infowindow, 'domready', function() {
            var iwOuter = $('.gm-style-iw');
            var iwBackground = iwOuter.prev();

            iwBackground.children(':nth-child(2)').css({
                'box-shadow' : 'none',
                'background-color': 'transparent',
            });

            var iwCloseBtn = iwOuter.next();

            iwBackground.children(':nth-child(4)').css({
                'border' : '2px solid #07932e',
            });

            iwBackground.children(':nth-child(3)').find('div').children().css({
                'box-shadow': '#07932e 1px 2px 6px', 
                'z-index' : '1',
            });
        });

        google.maps.event.addListener(infowindow,'closeclick',function(){
            map.setCenter({
                lat: parseFloat(data.lat - 0.0022),
                lng: parseFloat(data.lng - 0.0055)
            });
        });
      }
    }

	/* End Map contact short code*/
    function map_init_footer() {  
        if ($("#footer-map").length) {
            var data = $('#footer-map').data( 'json' );
            var data_style = $('#footer-map').data( 'style' );
            if( data != undefined ) {
                myLatlng = {lat: parseFloat(data.lat), lng: parseFloat(data.lng)};
                var markerLatLng = {lat: parseFloat(data.lat), lng: parseFloat(data.lng)};
                var markerTitle = data.address;
            }
            if(data_style == 'two' || data_style == 'three'){
                if($(window).width() > 1199) {
                var center_in_screen = new google.maps.LatLng( parseFloat(data.lat), parseFloat(data.lng) + 0.015); 
                }
                if($(window).width() > 991 && $(window).width() <= 1199) {
                    var center_in_screen = new google.maps.LatLng( parseFloat(data.lat), parseFloat(data.lng) + 0.01); 
                }
                if($(window).width() > 767 && $(window).width() <= 991) {
                    var center_in_screen = new google.maps.LatLng( parseFloat(data.lat), parseFloat(data.lng) + 0.008); 
                }
                if($(window).width() < 768) {
                    var center_in_screen = new google.maps.LatLng( parseFloat(data.lat), parseFloat(data.lng)); 
                }
            }else{
                var center_in_screen = new google.maps.LatLng( parseFloat(data.lat), parseFloat(data.lng)); 
            }
            
        }
        var isDraggable = $(document).width() > 767 ? true : false;
        var zoom;
        if ($("#footer-map").length) {
            if ( $('#footer-map').attr('data-zoom') ) {
                var attr_zoom = $('#footer-map').attr('data-zoom');
                if (attr_zoom != '') {
                    zoom = parseInt(attr_zoom);
                }
            }
            var styledMap = new google.maps.StyledMapType(styles,
                {name: "Styled Map"});
            var myOptions = {
                zoom: zoom,
                center: center_in_screen,
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                draggable: isDraggable,
                scrollwheel: false,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }

            };
            var contentString = '<div id="content">' +
                '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            var map = new google.maps.Map(document.getElementById('footer-map'), myOptions);
            var icon =  $('#footer-map').attr('data-img-url');
            var phone = '';
            var address = '';
            var img = '';
            var marker = new google.maps.Marker({
                position: markerLatLng,
                map: map,
                icon: icon,
                title: 'medic plus',
            });
            if ( $('#footer-map').attr('data-phone') ) {
                phone = '<div class="g-phone-num medic-phone"><i class="fa fa-phone"></i>'+ $('#footer-map').attr('data-phone') +'</div>';
            }
            if ( $('#footer-map').attr('data-urlimg') ) {
                img = '<div class="logo"><div class="header-logo"><img src="'+ $('#footer-map').attr('data-urlimg') +'" alt=""></div></div>';
            }
            if ( $('#footer-map').attr('data-address') ) {
                address = '<div class="g-address medic-text"><i class="fa fa-home"></i>'+ $('#footer-map').attr('data-address') +'</div>';
            }
            var contentString = '<div id="content" class="map-content">' +
                '<div class="text-center">' +
                img +
                 address +
                 phone  +
                '</div>' +
                '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
            google.maps.event.addListener(infowindow, 'domready', function() {

                var iwOuter = $('.gm-style-iw');
                var iwBackground = iwOuter.prev();

                iwBackground.children(':nth-child(2)').css({
                    'box-shadow' : 'none',
                    'background-color': 'transparent',
                });

                var iwCloseBtn = iwOuter.next();

                iwBackground.children(':nth-child(4)').css({
                    'border' : '2px solid #07932e',
                });
                iwBackground.children(':nth-child(3)').find('div').children().css({
                    'box-shadow': '#07932e 1px 2px 6px', 
                    'z-index' : '1',
                });

            });

            google.maps.event.addListener(infowindow,'closeclick',function(){
                map.setCenter({
                    lat: parseFloat(data.lat - 0.0022),
                    lng: parseFloat(data.lng - 0.0055)
                });
            });
        }
    }

    function height_map() {
        if( $('.contact-form-wrapper .contact-form-content.contact-form').length ) {
            var HeightContactForm = $('.contact-form-wrapper').height(),
                offsetContact = $('.contact-form-wrapper').offset().left;
            if($(window).width() < 768) {
               $('#map').css({
                    'height': $('.contact-form-wrapper .contact-form-content.right').height()*0.9,
                    "left": -offsetContact
                }); 
            }
            else {
                $('#map').css({
                    'height': HeightContactForm,
                    "left": -offsetContact
                });
            } 
        }else{
            var heightofmap = $('#map').data('height');
            var widthofmap = $('#map').data('width');
            $('#map').css({
                'width' : widthofmap,
                'height': heightofmap,
                'position': 'static',
            });
        }
    }

    function height_map_footer() {
        if( $('.footer-contact-form-wrapper').length ) {
            var wrapper = $('.footer-contact-form-wrapper');
            var footerMap = $('#footer-map');
            var footerContent = wrapper.children('.contact-footer-map');
            var widthFooterContent = footerContent.width();
            var HeightContactForm = wrapper.height(),
                offsetContact = wrapper.offset().left;
            if($(window).width() < 768) {
               footerMap.css({
                    'height': $('.footer-contact-form-wrapper .contact-form-content.right').height()*0.9,
                    "left": -offsetContact
                }); 
            }
            else {
                footerMap.css({
                    'height': HeightContactForm,
                    "left": -offsetContact,
                    // 'width': widthFooterContent+offsetContact+15
                });
            }
        }
    }


    /* BEGIN Google map of location page */
    var map_location = $('.sc_location_map #map_location');

    var is_addBigMaker = false;
    var zoomMap;
    var logoSrc = '/wp-content/plugins/slz-core/assets/images/logo-default.png';
    var iconMakerBig = '';
    var iconMakerSmall = '';
    var locations = [];
    var markers = [];
    var marker = [];

    var logoAttr = map_location.data('logo');
    if (logoAttr != '') {
        logoSrc = logoAttr;
    }
    if (logoSrc != '') {
        logoContent = '<div class="logo"><a href="/" class="header-logo"><img src="'+ logoSrc +'" alt="logo"></a></div>';
    }
    var zoomAttr = map_location.data('zoom');
    if ( typeof zoomAttr !== 'undefined' && zoomAttr != '') {
        zoomMap = zoomAttr;
    }
    var iconAttr = map_location.data('icon');
    if ( typeof iconAttr !== 'undefined' && iconAttr != '') {
        iconMakerSmall = iconAttr;
    }
    var iconBigAttr = map_location.data('icon-big');
    if ( typeof iconBigAttr !== 'undefined' && iconBigAttr != '') {
        iconMakerBig = iconBigAttr;
    }
    var functionAttr = map_location.data('function');
    if ( functionAttr == 1 ) {
        $('.sc_location').find('.get_map_content').each(function() {
            var title, phone, address, item_id, position_lat, position_lng;
            address = $(this).data('address');
            title = $(this).find('.get_map_title').text();
            phone = $(this).find('.get_map_phone').data('phone');
            item_id = $(this).data('item-id');
            position_lat = $(this).data('position-lat');
            position_lng = $(this).data('position-lng');
            marker.push([address, title, phone, item_id, position_lat, position_lng]);
        });
    } else if ( functionAttr == 2 ) {
        marker = map_location.data('json');
    }

    if ( marker.length ) {
        locations = calc_marker_locations(marker, iconMakerSmall, iconMakerBig);
    }


    function calc_marker_locations (marker, iconMakerSmall, iconMakerBig) {
        var i;
        var locations = [];
        for (var i = 0; i < marker.length; i++) {
            var contentInfoWindow,
                iconMaker,
                address_lat,
                address_lng,
                titleContent,
                phoneContent,
                addressContent;
            var marker_info = [];

            if (i == 0) {
                iconMaker = iconMakerBig;
            } else {
                iconMaker = iconMakerSmall;
            }

            var address = marker[i][0];
            var title = marker[i][1];
            var phone = marker[i][2];
            var item_id = marker[i][3];
            var position_lat = marker[i][4];
            var position_lng = marker[i][5];
            if (typeof title !== 'undefined' && title != '') {
                titleContent = '<div class="g-address medic-text"><i class="fa fa-home"></i>'+ title +'</div>';
            }
            if (typeof phone !== 'undefined' && phone != '') {
                phoneContent = '<div class="g-phone-num medic-phone"><i class="fa fa-phone"></i>'+ phone +'</div>';
            }

            addressContent = '<div class="g-address medic-text"><i class="fa fa-map-marker"></i>'+ address +'</div>';
            contentInfoWindow = 
                '<div id="content" class="map-content">' +
                    '<div class="text-center">' +
                        logoContent +
                        titleContent +
                        addressContent +
                        phoneContent +
                    '</div>' +
                '</div>';
            if ( typeof position_lat !== 'undefined' && position_lat != '' && typeof position_lng !== 'undefined' && position_lng != '' ) {
                marker_info = [title, position_lat, position_lng, contentInfoWindow, iconMaker, item_id];                        
                locations.push(marker_info);
            } else if (address != '') {
                $.ajax({
                    url: "http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
                    type: "POST",
                    async: false,
                    success: function(res){
                        if (res.status == 'OK') {
                            address_lat = res.results[0].geometry.location.lat;
                            address_lng = res.results[0].geometry.location.lng;
                            marker_info = [title, address_lat, address_lng, contentInfoWindow, iconMaker, item_id];                        
                            locations.push(marker_info);
                        }
                    }
                });
            };
        }
        return locations;
    }

    function init_location (locations, zoomMap) {
        var myLatlng = new google.maps.LatLng(39.9679831, -75.1641189);
        var center_in_screen = new google.maps.LatLng(39.9679831, -75.1641189);

        /*If document (your website) is wider than 767px, isDraggable = true, else isDraggable = false*/
        var isDraggable = false;
        if ( $(window).width() >= 768 ) {
            isDraggable = true;
        }
        if ( locations.length ) {
            center_in_screen = new google.maps.LatLng(locations[0][1], locations[0][2]);
        }
        var styledMap = new google.maps.StyledMapType(styles, { name: "Styled Map" });
        var myOptions = {
            zoom: zoomMap,
            center: center_in_screen,
            mapTypeControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggable: isDraggable,
            scrollwheel: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }

        };

        var map = new google.maps.Map(document.getElementById('map_location'), myOptions);
        var infowindow = new google.maps.InfoWindow({});
        var bounds = new google.maps.LatLngBounds();
        var marker, i;
        var idMarkerArr = [];

        if ( locations.length ) {
            for (i = 0; i < locations.length; i++) {
                var titleMarker = locations[i][0];
                var latMarker = locations[i][1];
                var lngMarker = locations[i][2];
                var contentInfoWindow = locations[i][3];
                var iconMarker = locations[i][4];
                var idMarker = locations[i][5];
                if ( typeof latMarker === 'undefined' || latMarker == '' ||  typeof lngMarker === 'undefined' || lngMarker == '' ) { 
                    continue; 
                }

                var marker = new google.maps.Marker({
                    __gm_id: idMarker,
                    position: new google.maps.LatLng(latMarker, lngMarker),
                    map: map,
                    icon: iconMarker,
                    title: titleMarker,
                    animation: google.maps.Animation.DROP
                });

                bounds.extend(marker.position);

                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');

                google.maps.event.addListener(marker, 'click', (function(marker, idMarker, contentInfoWindow) {
                    return function() {
                        infowindow.setContent(contentInfoWindow);
                        infowindow.open(map, marker);
                        map.panTo(marker.getPosition());
                        gmap_marker_bounce(marker, idMarkerArr);
                    }
                })( marker, idMarker, contentInfoWindow ));
                markers[idMarker] = marker;
                idMarkerArr.push(idMarker);                
            }

            if ( typeof zoomMap === 'undefined' || zoomMap == '' ) {
                /* Screen map include each marker's position */
                map.fitBounds(bounds);
            }
        }         


        /* show btn when map has marker*/
        if ( idMarkerArr.length ) {
            for (var i = 0; i < idMarkerArr.length; i++) {
                $('.marker_' + idMarkerArr[i]).removeClass('hide');
            }
        }

        google.maps.event.addListener(infowindow, 'domready', function() {
            var iwOuter = $('.gm-style-iw');
            var iwBackground = iwOuter.prev();

            iwBackground.children(':nth-child(2)').css({
                'box-shadow': 'none',
                'background-color': 'transparent',
            });

            var iwCloseBtn = iwOuter.next();

            iwBackground.children(':nth-child(4)').css({
                'border': '2px solid #07932e',
            });
            iwBackground.children(':nth-child(3)').find('div').children().css({
                'box-shadow': '#07932e 1px 2px 6px',
                'z-index': '1',
            });
        });

        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();
        $('.get_direction').on('click', function() {
            var position_end = $(this).closest('.get_map_content').data('address');
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var position_start = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    calculateAndDisplayRoute(directionsService, directionsDisplay, position_start, position_end);
                    directionsDisplay.setMap(map);
                }, showErrorGeolocation );
            } else {
                alert('The browser does not support Geolocation.');
            }
        });
        $('.get_location').on('click', function() {
            var item_id = $(this).closest('.get_map_content').data('item-id');
            var marker = markers[item_id];
            new google.maps.event.trigger( marker, 'click' );
            map.setZoom(14);
            $('html, body').animate({
                scrollTop: $("#map_location").offset().top
            }, 500);
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay, start, end) {
        directionsService.route({
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING /* DRIVING, BICYCLING, TRANSIT, WALKING */
        }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $("#map_location").offset().top
                    }, 1000);
                }, 500);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
    function showErrorGeolocation(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert('The browser does not support or user denied the request for Geolocation.');
                break;
            case error.POSITION_UNAVAILABLE:
                alert('Location information is unavailable.');
                break;
            case error.TIMEOUT:
                alert('The request to get user location timed out.');
                break;
            case error.UNKNOWN_ERROR:
                alert('An unknown error occurred.');
                break;
        }
    }

    /*
     *  Google map - Marker: Bounce marker
     */
    function gmap_marker_bounce_clear(markers, idMarkerArr) {
        $(idMarkerArr).each(function (key, value) {
            var markerRemove = markers[value];
            markerRemove.setAnimation(null);
        });
    }
    function gmap_marker_bounce(marker, idMarkerArr) {
        gmap_marker_bounce_clear(markers, idMarkerArr);
        if (marker.getAnimation() == null) {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    /* END Google map of location page */


    if ($('#map').length) {

        $(window).on('resize load', function() {
            height_map();
        });
        $(document).on('ready', function() {
            height_map();
        });
        setTimeout(function() {
            map_init();
        }, timeout_map);     
    }
    if ($('#footer-map').length) {
        $(window).on('resize load', function() {
            height_map();
        });
        $(document).on('ready', function() {
            height_map_footer();
        });
        setTimeout(function() {
            map_init_footer();
        }, timeout_map);     
    }
    if ($('.sc_location_map #map_location').length) {
        init_location(locations, zoomMap);        
    }
    
})(jQuery);