=== Cache by Folium ===
Contributors: pigeonhut
Tags: cache, cdn, minify, database optimization, browser caching
Requires at least: 4.6
Tested up to: 7.0
Stable tag: 1.6.19
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Fast, easy to use cache for WordPress with option for 3 separate CDN's. Optimize Database.

== Description ==
<font color="blue"><strong>Fast, easy to use cache</strong></font> for WordPress with option for up-to 3 separate CDN's - for js, css & images from 3 providers.<br>
Added the ability to set and forget <strong>Database clean-ups</strong> on a scheduled timescale including removing revisions, clean-up transients, remove comment spam. Generally help keep the Database lean and tidy.

Built in support for <a href="https://gridpane.com/">GridPane</a> based WordPress Installations with more functionality coming soon.

Added Automatic CDN support, Free for now, just enable in settings and your site will be automatically added to the grid.

We have many features planned and have an active development cycle which will be user focused based on feedback.

For extra performance we recommend <a href="https://wordpress.org/plugins/wp-disable/">Featherweight</a>, our request cleanup plugin for reducing front-end weight and removing unused WordPress output.

<strong>Coming Soon</strong> – Dedicated WooCommerce caching for optimized e-commerce performance.

For hands-on performance work, see <a href="https://foliumstudio.co.uk">Folium Studio</a>.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Cache by Folium settings screen to configure the plugin


== Frequently Asked Questions ==

= What about Minification, do I still need it? =

Yes, you absolutely do, and none come close to the awesome <a href="https://en-gb.wordpress.org/plugins/autoptimize/">Autoptimize</a> by Frank Goossens.

= I would like to contribute/I have an idea =

Please send us any <a href="https://foliumstudio.co.uk">Feedback</a> if you would like to contribute or have any ideas to add.

= Do I need to use a CDN ? =

No, you do not need to use one, but if you do, we have made it really simple to add on your CDN of choice.  We offer 3 routes for CDN, so you can effectively run 3 CDN's one for JS, CSS & images.<br>
Bare in mind, if you choose to use a CDN, your files will be uploaded and stored on the CDN of choice, please consult their privacy policies.



== Screenshots ==

== Changelog ==
= 1.6.19 =
* Added the standard WordPress.org directory banner and icon asset sizes so the refreshed Cache by Folium listing artwork displays consistently.

= 1.6.18 =
* Complete Folium-family visual redesign of the Cache by Folium admin screen, including the shared By Folium shell, Dashboard/Caching/CDN/Tools tabs, ajax save/reset/clear actions, and matching suite overview card.
* Removed the legacy blue/orange admin stylesheet so the new interface loads cleanly without flashing old styles.

= 1.6.17 =
* Updated plugin description with information about upcoming dedicated WooCommerce caching feature.
* Simplified image compression plugin recommendation.

= 1.6.16 =
* Removed a stray generated report file from the plugin root and hardened the build excludes so no development markdown ships in the distribution.

= 1.6.15 =
* Settings page header now shows "Cache by Folium" (was an older hardcoded title) and the rate-us link points to the plugin's reviews page.

= 1.6.14 =
* Renamed plugin to "Cache by Folium" for unique, clearly branded naming per WordPress.org plugin review feedback. No functional changes; slug and text domain unchanged.

= 1.6.13 =
* Renamed plugin to "Speed Cache" and updated branding to comply with WordPress.org trademark guidelines.
* Security: added nonce and capability checks to all settings forms (CSRF hardening).
* Security: sanitised and validated all request input; hardened cache path handling against host/path tampering.
* Fixed fatal errors and deprecations under PHP 8; tested up to PHP 8.4.
* Standardised the text domain and cleaned up plugin headers, tags and contributor list.

= 1.5.06 =
*

= 1.5.05 =
* Removed images from Cache CDN for even better performance, images will be served via a dedicated image CDN.
* Plugin now serves css/js via our cdn
* Promoted the Folium performance suite for dedicated image and CDN workflows.

= 1.5.04 =
* Fixed issue where existing CDN Zone not being deleted on Disable

= 1.5.03 =
* small bug fixes in cdn
* when disabling CDN, all content stored will be deleted and zone will be destroyed. If you re-enable, it will create again.

= 1.5.02 =
* Added ability to minify html
* Fixed bug in path for CDN causing some sites to render without CSS.

= 1.5.01 =
* Added Free CDN for all sites
* Auto Add your domain to zone on on_activation
* Auto re-write paths to route css/js/images to cdn
* Re-write to local on de-activation and delete cdn_zone

= 1.4.11 =
* Added a note on dashbaord about what to look for to disable our plugins.  People have started leaving negative feedback cause can't remember what they installed. Hopefully, this clears it up

= 1.4.1 =
* Fixed cache/cdn rewrite path for Slide Anything Plugin

= 1.4.0 =
* Rebuild of cache libraries for better more reliable caching

= 1.3.4 =
* Added support for Purging Nginx Cache.
* General bug fixes
* Added support for GridPane (read more about <a href="https://gridpane.com/">GridPane</a>)

= 1.3.32 =
* Removed unused references

= 1.3.3 =
* General bug fix and minor improvements

= 1.3.2 =
* Bug fix - stats not displaying
* Minor improvements

= 1.3.1 =
* Please note, if you use more than one of our Optimisation plugins, they all need to be updated to the latest versions to ensure a seamless working experience
* More visual cleanups
* Removed all webfonts
* Minor bug fix on reporting on dashboard
* All 3 plugins should now be seamless
* General cleanup of WP Repo removing old versions inline with WP guidelines

= 1.3.0 =
* General visual improvements
* Tighter integration into the optimisation.io suite

= 1.2.14 =
* General navigation tidy up
* General Dashboard tidy up

= 1.2.13 =
* Added ability to cache Gravatars
* Updated import/export logic to work across the whole optimisation suite
* General code cleanup
* Restored "Clear cache" to Admin bar


= 1.2.12 =
Sync Settings for Import/Export
Fixed MySQL query in DB Tables prefix
Removed recommended plugins
General Small visual fixes

= 1.2.11 =
Removed admin bar navigation
Added Stats dashboard
Tighter integration with WP Disable and Image compression
Removed CDN Nag screen
Small code improvements throughout

= 1.2.1 =
Tidied up Navigation
Added Navigation to Admin Bar (new features planned)

= 1.2.0 =
Improved Navigation (moved to its own section)
Added Database stats visually under Optimise tab
Added a pre-crawl warm cache crawler
Added option to leverage browser caching
removed old tags to clean up
created changelog.txt to keep readme cleaner


= 1.1.2 =
* Bug fix on DB scheduling
* Updated Visuals

= CREDITS =
This plugin is partially based on Cache Enabler by KeyCDN, itself a fork of Cachify.
