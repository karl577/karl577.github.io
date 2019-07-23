=== Simple Tagging ===

Contributors: momo360modena
Donate link: http://www.herewithme.fr/
Tags: tag, posts, tags, admin
Requires at least: 2.0.10
Tested up to: 2.2.3
Stable tag: 1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Tagging is another tagging plugin for Wordpress: smarter, better, faster :-) Tag Cloud, Related Posts, Related Tags, Tags Tabs (new!) and more...

== Description ==

**For WordPress 2.3 and upper : Please try and use [Simple Tags Plugins](http://wordpress.org/extend/plugins/simple-tags/ "The best tagging plugin for WordPress 2.3 !")**

The two mostly used tagging plugins are the Ultimate Tag Worrior (UTW) and Jerome’s Keywords.

I think most people use UTW, however especially its performance has been criticized in the past. Also, it does not provide a auto-complete type-ahead dropdown menu when tagging posts but it always displays all tags of the entire Wordpress installation which can be quite annoying if you have really many tags.

Jerome’s Keywords is unfortunately still in beta and it seems that the project will not be continued.

With Simple Tagging Plugin, I’ve coded another tagging plugin for Wordpress which is based on Jerome’s Keywords plugin and can '''import''' all your tags from UTW or Jerome.

It provides you with everything you need for tagging, in the following a list of the features:

1. Import your tags from UTW or Jerome’s Keywords
2. A field for tagging your posts easily incl. type-ahead feature
3. Display Tags of the current posts
4. A tag cloud with various options
5. Displaying a list of related posts
6. Related Tags feature when browsing your tags (idea stolen from del.icio.us)
7. Adding tags (& categories if enabled in the options) as meta keywords in the header
8. Adding tags as categories in the feed (this will index your tags with Technorati)
9. Tag management: rename tags, delete tags, replace tags, convert categories to tags, etc.
10. Support of embedded tags ([tags]tag1, tag2, tag3[/tags]): You can tag posts directly by entering the tags in the post using [tags]tag1, tag2, tag3[/tags]. This makes it possible to tag posts when you use an external blogging application like BlogDesk or Windows Live Writer.
11. A feed (RSS, RSS2, Atom) for any tag
12. Tag cloud for specific category
13. Automatically display the tags of a post after the post content
14. Generate Tag Tabs with jQuery !
15. Manage Tags Cloud in FULL WordPress Mu Site !
16. List posts from all blogs for a specific tags in WordPress Mu !
17. Edit mass tags ! 20 posts at the same time !

And more...

== Installation ==

The Simple Tagging Plugin can be installed in 4 easy steps:

1. Decompress the downloaded .zip archive and put the files into your plugins directory (/wp-content/plugins/) or into a sub directory of the plugins directory (recommended).
2. Enable the plugin in the WordPress Plugins admin page.
3. Go to Wordpress Admin > Tags > Tag Options, adjust the options and save.
4. Go to Wordpress Admin > Options > Permalinks and press the button to update the permalink structure. (very important)

== Frequently Asked Questions ==

= I can import my tags from Ultimate Tag Warrior ? =

Yes ! Simple Tagging allow importing from UTW or Jerome’s Keywords

= Simple Tagging are compatible with WordPressMu ? =

Yes ! But you must have PHP5 for this part.

= An conversion tools to official tag (WP2.3) will be created and maintened ? =

Yes ! (by default in WP)

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Arbitrary section ==
New in version 1.7:
	* Reorganise Admin Options
	* Add Tag Tabs
	* Fix lots of bugs.
		* Fix test $wp_version
		* Atom Feed fix
	* Add mass edit tags !
	* Fix a security problem

New in version 1.6.8.1:
	* Fix a important bug with related posts

New in version 1.6.8:
    * Fix bugs version 1.6.7
		* Fix wrong counter tags
		* Admin bugs. (checked)
    * Minor optimisation
	* Site wide tag cloud for WordPress Mu + List of posts.
	* Add translation: Russian & Czech

New in version 1.6.7:
    * Fix bugs version 1.6.6
    * Compatibility with MySQL 4.0
    * Optimisation 
	
New in version 1.6.6:
    * Add auto color tags cloud (no CSS, Colorpicker in admin)
    * Add Turkish translation
    * An option to limit the number of related tags
    * A possibility to call/display the related posts outside a loop
    * Tags Feed
    * limit the age of what posts show up in the tag cloud
    * An option to automatically display the tags of a post after the post content
    * Limit or exclude category or categories in Tag Cloud
    * Ability to exclude specific categories from the related posts
    * Tag Cloud for one category 

New in version 1.6.2:
    * Related Posts now work... 

New in version 1.6.1:
    * Internationalisation (french, english, german)
    * Compatibility with WPmu 
