<?php
/*
Plugin Name: WP Windy Map
Description: A plugin to display a Windy map with configurable settings.
Version: 1.3
Author: NarcolepticNerd
*/

// Ensure this file is being run within the WordPress environment
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Function to display the Windy map
function wp_windy_display_map() {
    // Retrieve settings




    $stationLat = esc_attr(get_option('wp_windy_station_lat', '0'));
    $stationLon = esc_attr(get_option('wp_windy_station_lon', '0'));
    $displayTempUnits = esc_attr(get_option('wp_windy_temp_units', 'C'));
    $radarType = esc_attr(get_option('wp_windy_radar_type', 'temp'));

    // Output the iframe

    echo '<iframe src="https://embed.windy.com/embed2.html?lat=' . $stationLat . '&lon=' . $stationLon . '&zoom=5&level=surface&overlay=' . $radarType . '&menu=&message=true&marker=&forecast=12&calendar=now&location=coordinates&type=map&actualGrid=&metricWind=kt&metricTemp=%C2%B0' . $displayTempUnits . '" style="border:none;width:98%;height:400px;margin:0 auto"></iframe>';
}

// Shortcode function to display the map
function wp_windy_shortcode() {
    ob_start();
    wp_windy_display_map();
    return ob_get_clean();
}
add_shortcode('windy_map', 'wp_windy_shortcode');

// Add a menu item for the settings page under Tools
function wp_windy_add_admin_menu() {
    add_management_page('WP Windy Settings', 'WP Windy', 'manage_options', 'wp_windy', 'wp_windy_options_page');
}
add_action('admin_menu', 'wp_windy_add_admin_menu');

// Register settings
function wp_windy_settings_init() {





    register_setting('wp_windy_settings', 'wp_windy_station_lat', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('wp_windy_settings', 'wp_windy_station_lon', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('wp_windy_settings', 'wp_windy_temp_units', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('wp_windy_settings', 'wp_windy_show_shortcode', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('wp_windy_settings', 'wp_windy_radar_type', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    add_settings_section(
        'wp_windy_settings_section',
        __('Windy Map Settings', 'wp_windy'),
        null,
        'wp_windy_settings'
    );

    add_settings_field(
        'wp_windy_station_lat',
        __('Station Latitude', 'wp_windy'),
        'wp_windy_station_lat_render',
        'wp_windy_settings',
        'wp_windy_settings_section'
    );

    add_settings_field(
        'wp_windy_station_lon',
        __('Station Longitude', 'wp_windy'),
        'wp_windy_station_lon_render',
        'wp_windy_settings',
        'wp_windy_settings_section'
    );

    add_settings_field(
        'wp_windy_temp_units',
        __('Temperature Units', 'wp_windy'),
        'wp_windy_temp_units_render',
        'wp_windy_settings',
        'wp_windy_settings_section'
    );

    add_settings_field(
        'wp_windy_show_shortcode',
        __('Show Shortcode', 'wp_windy'),
        'wp_windy_show_shortcode_render',
        'wp_windy_settings',
        'wp_windy_settings_section'
    );

    add_settings_field(
        'wp_windy_radar_type',
        __('Radar Type', 'wp_windy'),
        'wp_windy_radar_type_render',
        'wp_windy_settings',
        'wp_windy_settings_section'
    );
}
add_action('admin_init', 'wp_windy_settings_init');

// Render latitude field
function wp_windy_station_lat_render() {


    $value = esc_attr(get_option('wp_windy_station_lat', '0'));
    echo '<input type="text" id="wp_windy_station_lat" name="wp_windy_station_lat" value="' . $value . '">';
}

// Render longitude field
function wp_windy_station_lon_render() {


    $value = esc_attr(get_option('wp_windy_station_lon', '0'));
    echo '<input type="text" id="wp_windy_station_lon" name="wp_windy_station_lon" value="' . $value . '">';
}

// Render temperature units field
function wp_windy_temp_units_render() {

    $value = esc_attr(get_option('wp_windy_temp_units', 'C'));
    echo '<select name="wp_windy_temp_units">
            <option value="C"' . selected($value, 'C', false) . '>Celsius</option>
            <option value="F"' . selected($value, 'F', false) . '>Fahrenheit</option>
          </select>';
}

// Render show shortcode field
function wp_windy_show_shortcode_render() {

    $value = esc_attr(get_option('wp_windy_show_shortcode', 'yes'));
    echo '<select name="wp_windy_show_shortcode">
            <option value="yes"' . selected($value, 'yes', false) . '>Yes</option>
            <option value="no"' . selected($value, 'no', false) . '>No</option>
          </select>';
}

// Render radar type field
function wp_windy_radar_type_render() {

    $value = esc_attr(get_option('wp_windy_radar_type', 'temp'));
    echo '<select name="wp_windy_radar_type">
            <option value="temp"' . selected($value, 'temp', false) . '>Temperature</option>
            <option value="rain"' . selected($value, 'rain', false) . '>Rain</option>
            <option value="wind"' . selected($value, 'wind', false) . '>Wind</option>
            <option value="clouds"' . selected($value, 'clouds', false) . '>Clouds</option>
            <option value="pressure"' . selected($value, 'pressure', false) . '>Pressure</option>
            <option value="waves"' . selected($value, 'waves', false) . '>Waves</option>
            <option value="snowdepth"' . selected($value, 'snowdepth', false) . '>Snow Depth</option>
            <option value="satellite"' . selected($value, 'satellite', false) . '>Satellite</option>
            <option value="radar"' . selected($value, 'radar', false) . '>Radar</option>
            <option value="humidity"' . selected($value, 'humidity', false) . '>Humidity</option>
            <option value="dewpoint"' . selected($value, 'dewpoint', false) . '>Dew Point</option>
            <option value="visibility"' . selected($value, 'visibility', false) . '>Visibility</option>
            <option value="thunder"' . selected($value, 'thunder', false) . '>Thunderstorms</option>
          </select>';
}

// Display the settings page
function wp_windy_options_page() {
    ?>
    <form action="options.php" method="post">
        <?php wp_nonce_field('wp_windy_settings_save', 'wp_windy_nonce'); ?>
        <h2><?php _e('WP Windy Settings', 'wp_windy'); ?></h2>
        <?php
        settings_fields('wp_windy_settings');
        do_settings_sections('wp_windy_settings');
        submit_button();
        ?>
        <button type="button" onclick="getCurrentLocation()">Use Current Location</button>
    </form>
    <?php
    // Display the radar map on the settings page
    echo '<h3>' . __('Radar Preview', 'wp_windy') . '</h3>';
    wp_windy_display_map();

    // Check if the shortcode should be displayed
    if (get_option('wp_windy_show_shortcode', 'yes') === 'yes') {
        ?>
        <h3><?php _e('Shortcode', 'wp_windy'); ?></h3>
        <p><?php _e('Use the following shortcode to display the Windy map:', 'wp_windy'); ?></p>
        <code>[windy_map]</code>
        <?php
    }
    ?>
    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('wp_windy_station_lat').value = position.coords.latitude;
                    document.getElementById('wp_windy_station_lon').value = position.coords.longitude;
                }, function(error) {
                    alert('Error occurred. Error code: ' + error.code);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    </script>
    <?php
}