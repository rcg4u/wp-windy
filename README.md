# WP Windy Map Plugin

## Description
The **WP Windy Map Plugin** allows you to embed a customizable Windy map into your WordPress site. You can configure the map's latitude, longitude, and temperature units through the WordPress admin panel.

## Features
- Embed a Windy map using a simple iframe.
- Configure the map's latitude and longitude to display specific locations.
- Choose between Celsius and Fahrenheit for temperature units.
- **NEW:** Use a shortcode to embed the map on any page or post.
- **NEW:** Improved settings page with geolocation support.

## Installation
1. Download the plugin files.
2. Upload the plugin folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Configuration
1. Navigate to **Tools > WP Windy** in the WordPress admin panel.
2. Configure the following settings:
   - **Station Latitude**: Enter the latitude of the location you want to display.
   - **Station Longitude**: Enter the longitude of the location you want to display.
   - **Temperature Units**: Select either Celsius or Fahrenheit.
3. Save your changes.

## Usage
### Shortcode
Use the `[windy_map]` shortcode to embed the Windy map on any page or post. Example:
```plaintext
[windy_map]
```

### Settings Page
The settings page allows you to:
- Set the latitude and longitude for the map's location.
- Choose the temperature units (Celsius or Fahrenheit).
- Use the "Use Current Location" button to auto-fill your coordinates based on your browser's geolocation.

## Changelog
### Version 1.1
- Added shortcode support for embedding the map on pages or posts.
- Improved settings page with geolocation support.

### Version 1.0
- Initial release with configurable latitude, longitude, and temperature units.