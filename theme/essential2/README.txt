The "Essential" Moodle Theme
======================

With 2.5 now released Julian thought it time to take the opportunity to build a new theme that would push the new theme engine to it's limits a bit. With that in mind he introduced the new "Essential" theme. Now Julian has left us for Canvassian adventures, Gareth and David have taken over development and maintenance of this theme.
The idea of this theme is to make the site look as little like Moodle as possible. In this specific instance, it would be used on sites where Moodle would potentially serve as a company homepage rather than just a course list.

Cool things to know about the theme.
 - It attempts to load as many as possible icons from a font
 - Most of what you think are "graphics" are actually the [Awesome font](http://fortawesome.github.io/Font-Awesome/)
 - The slider on the frontpage of the demo site is completely customisable through theme settings
 - I am really trying to push what [Bootstrap](http://twitter.github.io/bootstrap/) Grids can do. As such the theme is fully responsive.
 - The footer is all custom Moodle regions. This means blocks can be added. The footer of the demo site is full of HTML blocks in this instance
 - The Theme uses [Google web fonts](http://www.google.com/fonts/) to give it that extra bit of shazam!
 - Social Network icons appear at the top of the page dynamically based on theme settings
 - The entire colour scheme can be modified with theme settings
 - The homepage main area is just a label. The theme will ship with custom classes that you can set for tables and links to modify their formatting. No knowledge of code is needed as you can use the text editor to do this. Documentation will be provided outlining what the additional classes are.

Required version of Moodle
==========================
This version works with Moodle version 2013111800 release 2.6 (Build: 20131118) and above within the 2.6 branch until the
next release.

Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on
'docs.moodle.org/26/en/Installing_Moodle'.

Installation
============
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential2 as the
    theme relies on underlying core code that is out of our control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Copy the extracted 'essential2' folder to the '/theme/' folder.
 4. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 5. Select as the theme for the site.
 6. Put Moodle out of Maintenance Mode.

Upgrading
=========
 1. Ensure you have the version of Moodle as stated above in 'Required version of Moodle'.  This is essential2 as the
    theme relies on underlying core code that is out of our control.
 2. Login as an administrator and put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 3. Make a backup of your old 'essential2' folder in '/theme/' and then delete the folder.
 4. Copy the replacement extracted 'essential2' folder to the '/theme/' folder.
 5. Go to 'Site administration' -> 'Notifications' and follow standard the 'plugin' update notification.
 6. If automatic 'Purge all caches' appears not to work by lack of display etc. then perform a manual 'Purge all caches'
    under 'Home -> Site administration -> Development -> Purge all caches'.
 7. Put Moodle out of Maintenance Mode.

Uninstallation
==============
 1. Put Moodle in 'Maintenance Mode' so that there are no users using it bar you as the administrator.
 2. Change the theme to another theme of your choice.
 3. In '/theme/' remove the folder 'essential2'.
 4. Put Moodle out of Maintenance Mode.

Downgrading
===========
If for any reason you wish to downgrade to a previous version of the theme (unsupported) then this procedure will inform you of how to
do so:
1.  Ensure that you have a copy of the existing and older replacement theme files.
2.  Put Moodle into 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode', so that there
    are no users using it bar you as the administrator.
3.  Switch to a core theme, 'Clean' for example, under 'Home -> Administration -> Site administration -> Appearance -> Themes ->
    Theme selector -> Default'.
4.  In '/theme/' remove the folder 'essential2' i.e. ALL of the contents - this is VITAL.
5.  Put in the replacement 'essential2' folder into '/theme/'.
6.  In the database, remove the row with the 'plugin' of 'theme_essential2' and 'name' of 'version' in the 'config_plugins' table, then
    in the 'config' table find the 'name' with the value 'allversionhash' and clear its 'value' field.  Perform a 'Purge all caches'
    under 'Home -> Site administration -> Development -> Purge all caches'.
7.  Go back in as an administrator and follow standard the 'plugin' update notification.  If needed, go to
    'Site administration' -> 'Notifications' if this does not happen.
8.  Switch the theme back to 'Essential' under 'Home -> Administration -> Site administration -> Appearance -> Themes -> Theme selector ->
    Default'.
9.  Put Moodle out of 'Maintenance mode' under 'Home -> Administration -> Site administration -> Server -> Maintenance mode'.

Reporting issues
================
Before reporting an issue, please ensure that you are running the latest version for your release of Moodle.  It is essential2
that you are operating the required version of Moodle as stated at the top - this is because the theme relies on core
functionality that is out of its control.

When reporting an issue you can post in the theme's forum on Moodle.org (currently 'moodle.org/mod/forum/view.php?id=46')
or check the issue list https://github.com/DBezemer/moodle-theme_essential2/issues and if the problem does not exist, create an
issue.

It is essential2 that you provide as much information as possible, the critical information being the contents of the theme's 
'version.php' file.  Other version information such as specific Moodle version, theme name and version also helps.  A screen shot
can be really useful in visualising the issue along with any files you consider to be relevant.

New in 2.7.6
========================
- FIX: Issue #159: Custom Category Icons not displaying in 2.7.5h (Build: 2014081404).
- FIX: Issue #155: Social Icons Missing 2.7.5h
- FIX: Issue #156, #70, #56: Caption background colour frontpage slider & active slide colours
- FIX: Issue #164: When side pre is empty, then content area does not fill space when editing is off.
- FIX: Issue #165: Menu options has transparent background for a hidden block
- FIX: Issue #166: invalid email and white page for main administrator
- FIX: Issue #166: invalid email and white page for main administrator
- NEW: Full filter support in all custom areas (frontcontent, slider, alerts, footer), this includes the multilang filter
- NEW: Also show read messages, but distinct from unread ones
- NEW: Add courses titles to course pages
- NEW: Add styling to block regions for easier drag/drop regions, especially for footer
- NEW: Create github page for Essential theme
- NEW: Backported to Moodle 2.5!!!
- HELP WANTED: All language strings are now in AMOS (Moodle Language packs) please update your own language!

New in 2.7.5
========================
- FIX: Issue #96:  2.7.4 breaks 'oldnavbar' setting.
- FIX: Issue #98:  Lang en/iosicondesc - Change 'them' to 'theme'.  Thanks to Skylar Kelty.
- FIX: Issue #101: Navbar not expanding properly on android mobile and tablet.
- FIX: Issue #107: No fixed width to header on login page.
- FIX: Issue #113: Remove FontAwesome from all links in section heading except for the edit icon.
- FIX: Issue #110: Refactor middle blocks wording, thanks @mkpelletier.
- FIX: Issue #109: Re-order middle blocks settings, thanks @mkpelletier.
- FIX: Issue #108: Add similar toggle options to front page content, thanks @mkpelletier.
- FIX: Issue #67:  Refactored so menus are renderer all separately.
- FIX: Issue #60:  Add styling to invisible courses in breadcrumb.
- FIX: Issue #126: Header logo right border syntax.
- FIX: Issue #127: Need to guard against uninitialised settings.
- FIX: Issue #128: Dropdown menu items are invisible when navigation bar text is white.
- FIX: Issue #134: Marketing height broken.
- FIX: Issue #135: Cannot edit topic summary.
- FIX: Issue #136: Too many docked icons.
- FIX: Issue #138: Breadcrumb above content / blocks.
- FIX: Issue #141: Check slider caption underneath in 2.7.5g.
- FIX: Issue #142: Check slider speed.
- FIX: Issue #144: Unmatched end tags in carousel.
- FIX: Issue #145: Language dropdown cut short when open.
- FIX: Correctly show no enrolments message when all courses are hidden.
- FIX: Reworked header menu and added responsive options to apps/social icons.
- FIX: Removed dnd upload status as it blocks the edit icons.
- FIX: Further work on RTL support.
- FIX: Theme Cleanup milestone completely finished!
- FIX: Further performance optimalizations using own CSS
- FIX: Provide fixes for IE8, Essential now largely works with IE8 as expected, but no support is given
- NEW: Issue #114: Add downgrade instructions.  See above.
- NEW: Removed bootstrapbase dependency for further minification.
- NEW: Split out alternative theme colours to reduce CSS loading when this is not enabled.
- NEW: Small tweak to site widths, now available options are 1400px, 1200px and 960px.
- NEW: Switched to bootstrap all in one for massive speed improvement (from 10 to 1 http request).
- NEW: Removed option for restricting block width as it was not possible to get this working properly.
- NEW: Issue #123: Add messages menu from Shoehorn and give it a FaceBook restyle
- NEW: Issue #14: Add a brand new user menu replacing the Dashboard menu
- NEW: Automatically collapsing breadcrumb
- NEW: Updated HTMLshiv
- NEW: Persistent link to your own grade report, available as long as you are enrolled in one visible course

New in 2.7.4
========================
- FIX: Issue #68.  Expand all not showing on Edit course settings.
- FIX: Issue #58.  Add font colour setting.
- FIX: Issue #63.  Slider caption overlap.
- FIX: Issue #66.  Link Colour Not Working.
- FIX: Issue #85.  Header logo location in RTL.
- FIX: Reverted icons back to #999.
- FIX: Alternative colour sets all now have the same CSS, docking fixed and consistent with settings.
- FIX: Moved all RTL to separate sheet from main CSS.  Sheet 'essential2-rtl' uses 'flipped' technology ('grunt-css-flip') whilst 'rtl' sheet has manual styles.
- FIX: Issue #78.  Category icon issue in RTL.
- FIX: Issue #90.  XML Editor last used.
- FIX: Issue #88.  XML editor contrast issues.
- FIX: Issue #89.  Dock causes horizontal scroll bar.
- FIX: Issue #93.  Navbar / breadcrumb colour setting needed for contrast issues.
- FIX: Issue #94.  Docking centred text.
- FIX: Issue #95.  Navbar colour to far.
- FIX: Height of page header constrained when screen width < 767px and row-fluid spans go 100%.
- NEW: Alternative colour sets have text and link colour settings.
- NEW: Optimised svg's to be smaller.
- NEW: Warning about IE8 as M2.6 does not support it - http://docs.moodle.org/dev/Moodle_2.6_release_notes#Requirements.
- NEW: If the page width setting is narrow and there are custom menu items the navigation bar and page adjusts to cope.
- NEW: Optimised colour setting code in lib.php.
- NOTE: If you are using an RTL language then please read the instructions in the config.php file to swap to the RTL styles manually.  As
        a code solution to swapping files does not work at the moment and combining all possible CSS into one file leads to a big file with
        lots of redundant CSS.  This presents problems when it comes to portable devices and bandwidth.

New in 2.7.3
========================
- FIX: Fixed slide show by replacing with Bootstrap 2.3.2 one.  Issue #18.
- FIX: Make background image fixed and set a background transparent colour
- FIX: Permanently replace edit icons with FontAwesome icons
- FIX: Massive cleanup in all files, reducing CSS with 25%
- FIX: Fixed all custom block regions to stick where they are
- FIX: Displaying footer and header on login page as well
- FIX: Further language file cleanup, looking for maintainers of all non-english language files!
- FIX: Optimize code for much improved processing time
- FIX: Optimize javascript to reduce browser lag on load
- FIX: Resolve layout issues on font-rendering
- FIX: Set layout options for responsive rendering, more mobile support to come soon
- FIX: Load fonts through htmlwriter (Thanks Mary :))
- FIX: Fix various alignment issues
- FIX: Fix popup/secure header overlay for quizzes
- FIX: optimize code to make loading much faster
- NEW: Reduced amount of fonts in theme, added legacy themes for websafe support
- NEW: New slider with up to 16 slides, full responsive
- NEW: Footer will go all the way to bottom on modern browsers (except IE of course)
- NEW: Removed output of summary to header due to potential exploits
- NEW: Breadcrumb styling
- NEW: Login Block styling
- NEW: Full custom category icon settings (Thanks Danny Wahl)
- NEW: Transparent fixed background when setting a background image

New in 2.7.2
========================
- FIX: Slideshow CSS fixes
- FIX: Image alignment on slideshow
- NEW: Select slideshow background color
- NEW: Option to bring back the old navbar location
 
New in 2.7.1
========================
- FIX: Numerous CSS fixes
- FIX: Translation fixes
- FIX: Updated Google Analytics code
- FIX: Cleanup of code in files
- FIX: Fixed logout page blocks in footer
- FIX: Now also outputs detailed performance info when selected
- FIX: Various menu features (messaging/badges) only enabled when feature is enabled
- NEW: Dutch translation
- NEW: Moved menu bar to top
- NEW: Now allows setting target on links
- NEW: New slideshow design (WIP)
 
New in 2.6.3
========================
- FIX: Numerous CSS fixes
- FIX: Due to popular request reports are now 2 column again
- FIX: Significantly improved RTL support
- FIX: Back To Top link now moved to the right side so does not overlap on content
- FIX: Fixed layout of top icons.
- NEW: Can create alternative colour schemes for users to select.
- NEW: Can select icons for categories
- NEW: Add support for the max-layout-width feature when empty regions are used.
- NEW: Start Dutch translation

New in 2.6.2
========================
- FIX: Numerous CSS fixes
- FIX: Third level dropdown in custom menu now works
- FIX: iOS7 custom menu now works when changed to a sing dropdown in portrait view
- FIX: Social networking icons now line up properly
- FIX: GoogleFonts will now load in HTTPS setups
- NEW: Frontpage content now goes full width if all blocks removed.

New in 2.6.1
========================
- NEW: MAJOR UPDATES for 2.6 compatibility.
- NEW: Moved layouts to a more "Moodle standard" 1, 2 and 3 column layout.
- NEW: Can now add three columns of blocks to middle of the homepage under marketing spots.
- NEW: Theme setting added to allow admins to align frontage blocks to the left or right.
- NEW: Two designs for the slideshow available. One with image to the right, other with a background image.
- UPDATE: [Font Awesome 4.0.3](http://fontawesome.io/) now supported.
- UPDATE: Using new font setting to dynamically load the fonts.
- UPDATE: Removing autohide feature as no longer needed in Moodle 2.6
- FIX: Guest users no longer get "my courses" or "dashboard" dropdown menus.
- FIX: Nav Menu generates cleanly on IE.
- FIX: Gradebook now displays no blocks to maximise available space.
- FIX: Numerous CSS fixes and cleanup

New in 2.6
========================
- Added ability to select from 21 preset Google Font combinations or disable their use completely.
- Now includes additional Bootstrap JS plugins to allow for more dynamic formatting as shown on http://getbootstrap.com/javascript/
- New Frontpage Slideshow settings to allow to display; all the time, only before login, only after login or never.
- New Marketing Spots settings to allow to display; all the time, only before login, only after login or never.
- Course Labels are no longer in bold by default
- Now has a companion Mahara ePorfolio theme so you can keep them looking alike - https://github.com/moodleman/mahara-theme_essential2
- Further minor bug fixes and tidy up.

New in 2.5.4
========================
- Display current enrolled courses in dropdown menu and choose terminology (modules, courses, classes or units).
- New 'My Dashboard" in custommenu provides quick links to student tools. Can be disabled in theme settings.
- iOS home screen icons now built in. Can upload your own via settings.
- Alerts for users can be added to the frontpage. (Originally dreamed up by Shaun Daubney and re-coded by me).
- Theme options to connect to Google Analytics.
- Advanced Google Analytics function allowing Clean URL's for better reporting. Contributed by @basbrands and @ghenrick. More info on this feature can be found in [this blog post](http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-moodlemoot-analytics-to-the-front/)
- Significantly improved gradebook formatting.
- Toggle in Theme settings determines if FontAwesome is loaded from the theme or from the netdna.bootstrapcdn.com source.
- Back to top button for course pages.
- New "Frontpage Content" box to add custom content in between the slideshow and marketing spots.

Fixes in 2.5.4
=======================
- Fix to frontpage slideshow. First slide now loads properly.
- Updated include method to minimise conflicts with 3rd party plugins
- Code significantly optimised. (about 1/5 less lines!)
- Many CSS Fixes
- IMPORTANT: Theme requires Moodle 2.5.1 or higher

New in 2.5.3
========================
- New Settings screen just for colour selection
- Admin can now toggle to use "autohide" functionality in courses.
- Admin now upload their own background image
- Can now set colours for footer area
- Cleanup of required images (Theme now only uses 4 images)
- Performance info now neatly formatted.
- Fixed Custom Menu colour in IE8 and IE9
- Can now upload optional images into the marketing spots
- Now available in English, German, Russian, Turkish and Spanish (many thanks to the Moodle Community for translating)
- New Pinterest, Instagram, Skype and the Russian VK social networks added.
- Can now add links to Mobile apps on the iOS App Store and Google Play
- New formatting on login block
- Minor CSS Fixes
- EXPERIMENTAL: New course editing icons formatted and built with Font Awesome can now be used.
 
New in  2.5.2
========================
 - New theme setting to have user image show in the header when logged in.
 - Admin can choose to revert courses to a "standard" layout with blocks on the left and right sides
 - Admin can choose the default Navbar/breadcrumb separator
 - Frontage now is a 2 column layout by popular demand
 - Icons in navigation and administration block now rendered with Awesome Font
 - Font Awesome now loaded and cached through lib.php. Should improve performance
 - Minor CSS fixes
 
See the theme in Action
========================
A video showing many of the core features is available for viewing at http://vimeo.com/69683774

Documentation
=============
As always, documentation is a work in progress. Available documentation is available at http://docs.moodle.org/25/en/Essential_theme
If you have questions you can post them in the issue tracker at https://github.com/DBezemer/moodle-theme_essential2/issues

Maintained by
========================
David Bezemer
Moodle profile: https://moodle.org/user/profile.php?id=1416592

G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.
Moodle profile: http://moodle.org/user/profile.php?id=442195
Web profile   : http://about.me/gjbarnard
