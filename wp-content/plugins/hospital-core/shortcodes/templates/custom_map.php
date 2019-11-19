<?php
add_shortcode('kc_custom_map', function($atts, $content) {
    ob_start();
?>


         <div class="map-content">
            <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->
            <div id="map"></div>
        </div>
        
        <?php 
          $map_api= defined('FW') ? fw_get_db_settings_option('map_api'):'';
        ?>
   <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_api;?>"></script>      
 <script>
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);

            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 4, scrollwheel: false,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(23.8103968, 90.41256666), //Dhaka

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "administrative.locality", "elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}]}, {"featureType": "administrative.locality", "elementType": "labels.icon", "stylers": [{"visibility": "on"}, {"color": "#f1c40f"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#037d71"}, {"visibility": "on"}]}]
                };

                // image from external URL

                var myIcon = '<?php echo get_template_directory_uri();?>/assets/img/marker.png';

                //preparing the image so it can be used as a marker
                //https://developers.google.com/maps/documentation/javascript/reference#Icon
                //includes hacky fix "size" to allow for wobble
                var catIcon = {
                    url: myIcon
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(23.8103968, 90.41256666), //Dhaka
                    map: map,
                    icon: catIcon,
                    title: 'Snazzy!',
                    animation: google.maps.Animation.DROP
                });
            }
        </script>

<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'your_init', 99 );
 
function your_init() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_custom_map' => array(
	                'name' => 'Custom Map',
	                'description' => __('Display single icon', 'KingComposer'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                    // array(
	                    //     'name' => 'icon',
	                    //     'label' => 'Select Icon',
	                    //     'type' => 'icon_picker',
	                    //     'admin_label' => true,
	                    // ),
	                    array(
	                        'name' => 'icon_size',
	                        'label' => 'Icon Size',
	                        'type' => 'text',
	                        'admin_label' => true,
	                        'description' => __('Enter font-size for icon such as: 15px, 1em ..etc..', 'KingComposer')
	                    ),
	                   
	                )
	            ),  // End of elemnt kc_icon 
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>