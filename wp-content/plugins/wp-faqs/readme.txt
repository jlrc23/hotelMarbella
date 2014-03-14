Our FAQs plugin makes it easy to create FAQ sections on your WordPress powered blog. Simply activate, add FAQ items + groups, then display them on a post or page by using a shortcode.

== Features ==

*	Create as many FAQ items and groups as you like via familiar UI
*	Drag and drop to re-order your FAQ Items
*	Utilises WordPress custom post types and taxonomies
*	Output your FAQ's using a simple shortcode
*	Choose to enable 'folding' - powered by javascript (click to open and close).
*	Optional index at the top of each FAQ

== Installation ==

*	Upload the wp-faq plugin folder to your wp-content/plugins/ directory.
*	Activate the plugin from the WordPress admin panel
*	Your ready! In the WP admin panel you will now see the 'FAQ' section, just below posts.

== Usage ==

*	Create FAQ Items (just like posts) from the Admin > FAQ Items page - you can even place them in categories (groups) if you want multiple FAQ lists.
*	From the FAQ Items admin page you can drag and drop to re-order your items. This order can be used by the shortcode (see below).
*	To show the FAQ use our [faq] shortcode in a post or page.
*	If you want to show it in the template itself use: echo do_shortcode('[faq]');

== Shortcode Instructions ==

The [faq] shortcode can be inserted into WordPress posts and pages takes the following arguments:

*	id (optional) - ID of group to show, found by going to Admin > FAQ Items > FAQ Groups and hovering over a group.
*	name (optional) - Name of group to show found by going to Admin > FAQ Items > FAQ Groups.
*	slug (optional) - Slug of group to show found by going to Admin > FAQ Items > FAQ Groups.
*	folding (optional) - Set to true by default. Set to true to enable jQuery folding up of items, or false to have them all revealed.
*	orderby (optional) - title by default. Set to 'menu_order' to use the order your FAQ Items are defined (drag and drop to reorder).
*	show_index (optional) - true by default. Set to false to hide the index at the top of the faq list.

If you want to show a group of FAQ items you *must* use either id, name, or slug so the plugin knows what group to show, otherwise it will show all FAQ items.

Examples:

*	[faq name="Ninety"] - Show FAQ items in the 'Ninety' group
*	[faq name="Ninety" orderby="menu_order"] - Show FAQ items in the 'Ninety' group and order them using the drag and drop order.
*	[faq show_index="false"] - Show all FAQ Items without an index.

== Additonal Notes / Support ==

If you find a bug with this plugin please give us full details in the comments section on CodeCanyon. From here we will assist.

However, we will *not* assist with styling and customisation issues - this is beyond the scope of support and should be performed by a developer/designer.

Thanks :)

== Changelog ==

= 1.1.2 - 17.03.2013 =
* Fix show index

= 1.1.1 - 08.12.2012 =
* Check if base class exists

= 1.1.0 - 07.12.2012 =
* Full rewrite.
* Fixed ordering bugs.
* Introduced template system to allow overrides of FAQ display.
* Drag and drop FAQ ordering instead of input box based ordering.

= 1.0.1 - 09.02.2011 =
* Potential date bug fixed.
* Added filters to get_the_content().

= 1.0 =
* First Release.