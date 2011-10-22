=== Rating-Widget ===
Contributors: svovaf
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=VAFEFAZRTLXU4
Tags: rate, rating, ratings, vote, votes, voting, star, like, widget, widgets, comment, comments, post, posts, page, admin, plugin, ajax, buddypress, bbpress
Requires at least: 2.6
Tested up to: 3.2
Stable tag: 1.3.8

Create and manage Rating-Widget ratings from within WordPress (+ BuddyPress Support + BP's bbPress Support).

== Description ==

The Rating-Widget Ratings plugin allows you to **create and manage ratings** from within your WordPress dashboard. You can embed ratings into your posts, pages or comments. PLUS, you can embed ratings into your BuddyPress activity updates and comments. In extra, the rating support BP's bbPress forum posts ratings. All Rating-Widget ratings are fully customizable, cross-browser, support multi-language, CSS3 compliant and hosted by Rating-Widget.com. You can create unlimited ratings and collect unlimited votes. The rating editor allows you to fully customize your ratings and its placement on your blog's layout. You can also avail of the the 'Top Rated' widget that will allow you to place the widget in your sidebar. This widget will show you the top rated posts, pages and comments.

To get the **Pro Version** go to - http://rating-widget.com/get-the-word-press-plugin/

Rating-Widget ratings are localizable and currently available in:

* Arabic
* Bulgarian
* Chineese
* Croatian
* Czech
* Danish
* English
* French
* Georgian
* German
* Greek
* Hebrew
* Hungarian
* Italian
* Japanese
* Nederlands
* Polish
* Portuguese
* Romanian
* Russian
* Serbian
* Spanish
* Swedish
* Turkish

Help us translate the widget into more languages at - http://rating-widget.com/help-translate/

Help us to enrich Rating-Widget customization by adding more ratings designs at - http://rating-widget.com/contribute-rating-design/

Follow us on **Twitter** to keep up with the latest updates [Rating-Widget](http://twitter.com/ratingwidget)
AND/OR
Become our **Facebook** fan to keep up with the latest updates [Rating-Widget](http://www.facebook.com/rating.widget)

== Installation ==

Upload the plugin to your blog and activate it. Then, follow the instructions.

== Screenshots ==

1. Ratings settings button
2. Creating user-key
3. Add ratings
4. Set rating alignment
5. Ratings on a posts
6. Ratings on comments
7. Ratings on activity updates & comments
8. Top Rated widget
9. Ratings options
10. Ratings advanced font options
11. Ratings advanced layout options
12. Ratings advanced text options
13. Rating settings Live Preview
14. Top Rated widget settings
15. Ratings availability settings
16. Ratings visibility settings

== Frequently Asked Questions ==

= How is Rating-Widget different than some other rating widgets, like starrating.org or polldaddy.com? =
It's the best one! The Rating-Widget is without registration, fully customizable, cross-browser & multi-language supported - including Right-To-Left languages support, and of course we host it for free.

= How can I change the default stars style with something else? =
It's very easy. First, go to the Ratings settings. Then, on the Rating-Widget options, select the "Custom" button in the color section, and follow the instructions which will appear in the new window.

= Can my Authors edit my blog ratings? =

Nope. Only administrators can edit the blog ratings.

= Where are my ratings? =

Check your theme's footer.php calls wp_footer. The rating javascript is loaded on this action. 

More info here - http://codex.wordpress.org/Theme_Development#Plugin_API_Hooks

== Change Log ==
= 1.3.8 =
* New: Top-Rated Widget order type - you can now show worst rated elements.
* New: Localized to Czech.
* New: Localized to Danish.
* New: Twitter follow us button (at the dashboard).

= 1.3.7 =
* New: Top-Rated Widget minimum votes parameter.
* New: Top-Rated Widget Order By parameter (Average Rate, Likes Number, Created, Updated).
* Fix: Top-Rated Widget Average Rate Order for thumbs was fixed (sort by likes minus dislikes).
* New: Added Rating Boosting options for Pro version users.

= 1.3.6 =
* Fix: Top-Rated Widget is now showing the ratings (Sorry friends :-).

= 1.3.5 =
* Fix: API Key is now showing your unique-user-key even if you don't have a secret key.
* New: Additional advanced analytics reports - you can now filter votes by IP, PC Identifier and User Id.
* New: Localized to Chineese.
* New: Localized to Hungarian.
* New: Localized to Japanese.
* New: Localized to Swedish.

= 1.3.4 =
* New: Added BP's bbPress forum topics ratings support.
* New: Debug mode is now supports logging.
* Fix: Thumbs rating style on front-posts while the Top-Rating widget is enabled.
* Fix: Ratings settings dashboard CSS was updated for the new WP version.

= 1.3.3 =
* New: "Top Rated" Widget titles display is now configurable.
* New: Short code for adding posts & pages inline ratings - **[ratingwidget]**.

= 1.3.2 =
* New: Localized to Georgian.
* New: Localized to Serbian.

= 1.3.1 =
* Fix: "Top Rated" Widget font size and line height.
* New: Advanced thumbs rating settings - now you can hide/show like or/and dislike thumbs.

= 1.3.0 =
* New: Localized to Greek.
* New: Localized to Nederlands.
* New: Localized to Romanian.

= 1.2.9 =
* Fix: "Top-Rated Widget" is now loading the right graphics.

= 1.2.8 =
* New: BuddyPress activity page is now showing also blog posts & blog comments ratings.
* Fix: Comments ratings alignment fix.

= 1.2.7 =
* New: Localized to Italian.
* Fix: Removed mb_strlen and mb_substr dependency.

= 1.2.6 =
* New: Advanced settings page.
* New: You can now control flash dependency.

= 1.2.5 =
* New: You can now control whether ratings will appear on excerpts or not.
* New: Localized to Bulgarian.
* New: Localized to Turkish.

= 1.2.4 =
* Fix: BuddyPress another bug fix.

= 1.2.3 =
* New: Localized to Polish.
* Fix: BuddyPress comments ratings.

= 1.2.2 =
* Fix: Post urid fix.

= 1.2.1 =
* New: Advanced star options - you can now select the number of stars you will have in your widget.
* New: Availability settings - you can now specify if ratings will be active, disabled or hidden for un-logged users.
* New: Visibility settings - you can now explicitly exclude or include ratings from specified posts/pages/comments/activity-updates/activity-comments.
* Fix: Show ratings on excerpts.
* Fix: BuddyPress background stuck bug fixed - now you can explicitaly select between Transparent or BuddyPress background types.
* Fix: Removed unnecessary user-key validations.
* Fix: Organized hooks hierarchy.

= 1.2.0 =
* New/Fix: Now you can rate from multiple computers under the same network.
* Fix: Themes list alignment & preview was fixed.

= 1.1.9 =
* New: We now hold 44 different star rating themes.

= 1.1.8 =
* Fix: Fixed posts & pages disable option bug.

= 1.1.7 =
* New: Localized to Arabic.

= 1.1.6 =
* New: Rating-Widget is now suppports BuddyPress activity!
* New: Special BuddyPress Stars & Thumbs Theme.
* Fix: Optimized JS loading mechanism.
* Fix: CSS tweaks for BuddyPress.

= 1.1.5 =
* New: Top Rated Widget is now available!

= 1.1.4 =
* Fix: Initial size icons are now match to the selected theme and type.
* Fix: Initial themes list is now match the saved rating type.
* Fix: ReadOnly icons are now linked to the correct url.
* Fix: Themes list loading Gif is now points to the correct url.

= 1.1.3 =
* Fix: There was a problem when selecting the default theme of the thumbs type.

= 1.1.2 =
* Fix: Initial settings preview bug fix.

= 1.1.1 =
* New: Localized to Croatian.
* New: Localized to Portuguese.
* Fix: Russian translation was fixed.

= 1.1.0 =
* New: Major UI change, now we have Themes option.
* New: 3 new rating designs (check out the Thumb type).
* New: Color property was deprecated.
* New: HTTP calls optimization.
* Fix: JS optimizations.
* Fix: CSS stylesheet tweaks.

= 1.0.9 =
* New: Localized to French.
* New: Localized to Spanish.
* Fix: CSS stylesheet improvements.

= 1.0.8 =
* New: Localized to German.

= 1.0.7 =
* New: ReadOnly functionality was added - now you can set your ratings to also be readonly (e.g. the front page posts).
* New: You can now specify any UTF-8 letters in the advanced text settings. E.g. you can use Swedish words with letters like Å, Ä, Ö.
* Fix: CSS stylesheet improvements.

= 1.0.6 =
* New: Added find us on Facebook window.
* Fix: Internal CSS bug fixes.

= 1.0.5 =
* Fix: Settings UI loading minor fixes.
* New: No more confusing 2 different save buttons - one "Save Changes" button for all.

= 1.0.4 =
* Fix: Rating-Widget options errors were fixed.

= 1.0.3 =
* Fix: reCAPTCHA set keys was replaced into global keys. Now it will work across all domains.
* Fix: Plugin version fix.

= 1.0.2 =
* Fix: Readme file was changed.
* Fix: Plugin containing folder was removed.

= 1.0.1 =
* New: Initial release
