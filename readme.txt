=== Plugin Name ===
Contributors: stefanodotta
Tags: related posts, taxonomy, widget
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget that simply gives you related posts by taxonomy. Six settings to
customize the widget: title, subtitle, taxonomy, sorting order, related posts count, list format

== Description ==

A widget that simply gives you related posts by taxonomy. 
Based on the following plugins:
1.  Daniel Lauener Simply Related Posts plugin
    https://github.com/danielauener/wp-simply-related-posts
2.  Justin Tadlock Series plugin
    https://github.com/justintadlock/series

== Widget settings ==

1. The title of the widget (default: none)
2. Option to display the taxonomy name as subtitle (default: none)
3. The taxonomy by which terms the posts are related (default: Tags)
4. The sorting order of the post listed (default: ascending)
5. How many related posts to show (default is -1)
6. List format (default: unordered)

The widget is visible only when `is_single()` is true, it doesn't shows up on
archives, search templates, etc.

== Installation ==

1. Upload the `taxonomy-related-posts` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the 'Appearance/Widgets' area, add the 'Taxonomy Related Posts' widget to a widget area.
4. Make your settings
5. Done

== CSS Customization ==
These CSS classes are available:
1. .widget-subtitle
    Allows you to customize the subtitle.
2. .taxonomy-related-posts
    Class attached to the widget. It allows you to customize the widget and the lists.

== Frequently Asked Questions ==

There is a github-repository on: 
https://github.com/stefanodotta/taxonomy-related-posts/

== Screenshots ==

1. Widget settings

== Changelog ==

= v1.1 = 2014-11-02
Moved the condition to verify if there are terms of the taxonomy
attached to the post before the reset of the terms.

Done some housekeeping in the form funtion (labels)

= v1.0 = 2014-11-01
Version 1.0 done



