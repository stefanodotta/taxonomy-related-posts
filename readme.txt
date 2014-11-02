=== Plugin Name ===
Contributors: danielauener, stefanodotta
Donate link: http://www.danielauener.com/
Tags: related posts, taxonomy, widget
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget that simply gives you related posts by taxonomy. Four settings to
customize the widget: title, taxonomy, related posts count, excludet terms

== Description ==

A widget that simply gives you related posts by taxonomy. It provides four
settings to customize every widget and there are no global settings to worry
about.

**Widget settings**

1. The title of the widget (default: Related Posts)
2. The taxonomy by which terms the posts are related (default: Tags)
3. How many related posts to show (default 5)
4. excludet terms

The widget is visible only when `is_single()` is true, it doesn't shows up on
archives, search templates, etc.

== Installation ==

1. Upload the `taxonomy-related-posts` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the 'Apearance/Widgets' area, add the 'Taxonomy Related Posts' widget to a widget area.
4. Make your settings
5. Done

== Frequently Asked Questions ==

There is a github-repository on: [http://github.com/danielauener/wp-simply-related-posts](http://github.com/danielauener/wp-simply-related-posts)

Q. How to add thumbnail images to the related posts list
A. You can add the 'simply_related_posts_title' filter, like
`add_filter( 'simply_related_posts_title', 'my_related_posts', 10, 2);`
The first argument is a post-object for the related post, the second argument
is the widget instance.


== Screenshots ==

1. Widget settings

== Changelog ==

= 1.0 =
* Version 1.0 done

