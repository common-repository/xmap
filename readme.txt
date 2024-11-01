=== XMap ===
Contributors: parelius
Tags: map, mapping, google maps, maptoolkit, openstreetmap, osm, opencyclemap, bikemap, runmap, inlinemap, wandermap, mopedmap, shortcode, gpx, gps
Requires at least: 3.0
Tested up to: 4.5
Stable tag: 1.3

XMap lets you embed maptoolkit maps (like www.bikemap.net) into your WordPress blog.

== Description ==

Embed maps from the following domains into your WordPress blog:

* www.bikemap.net
* www.runmap.net
* www.inlinemap.net
* www.wandermap.net
* www.mopedmap.net

You can do this using simple shortcodes, e.g.:

* [bikemap route="1026736"]
* [wandermap route="123456" extended="false"]

The following shortcodes are allowed:

* [bikemap]
* [wandermap]
* [runmap]
* [inlinemap]
* [mopedmap]

The following attributes are allowed:

* `route`: The route id (an integer)
* `extended`: If route info like elevation, distance etc. should be shown	(true|false, default:true)
* `width`: The width of the map (an integer, default: 640)
* `height`:	The height of the map (an integer, default: 400)
* `unit`: The unit used in the route info (km|miles, default:km)

== Installation ==

Follow one of the standard installation processes:

* Upload the plugin folder `xmap` to the `/wp-content/plugins/` directory and activate it
* OR use the search function within WordPress Admin, search for the Plugin, install and activate.

== Upgrade Notice ==

When upgrading to v1.0, default plugin options will be stored to the db.


== Frequently Asked Questions ==


== Screenshots ==



== Changelog ==

= 1.3 =
* Adapted code to a change in MapToolKit Widgets

= 1.2 =
* Fixed a problem with included file paths that prevented plugin from being activated
* Checked for compatibility with WordPress 4.4

= 1.1 =
* Checked for compatibility with WordPress 3.9
* Checked for compatibility with MapToolKit
* Small fixes in the options pane

= 1.0.1 =
* Shortcode handling improved
* Allow CSS configuration

= 1.0 =
* XMap options page added to admin interface
* Default map properties can be defined in the pluging options
* German localization added

= 0.9 =
* First public release