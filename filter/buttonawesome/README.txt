ButtonAwesome Filter
====================
An adaptation of the fontawesome filter to incorporate bootstrap button styled backgrounds behind the fontawesome icons
This has been written for a specific use at USW rather than general release
@copyright of the adaptation - Richard Oelmann: copyright of the original fontawesome filter - Julian Ridden (see below)

FontAwesome Filter
=========================
This filter allows you to use fontawesome icons in the Moodle text editor without worrying about having your div's stripped out by the Moodle Tinymce HTML cleaner.

New in Version 2.0
=========================
This filter has been updated to work with FontAwesome 4.0.3

IMPORTANT: FontAwesome have changed their naming convensions. If you are upgrading from te previous version of this filter you will need to update your syntax as listed below to the new "fa-" methodology

Requirements
=========================
Your site/theme must have FontAwesome embedded already. This filter does not provide the font.

Installation
=========================
Install the plugin like any other plugin to folder /filter/fontawesome

See http://docs.moodle.org/25/en/Installing_plugins for details on installing Moodle plugins

Usage
=========================
First, activate the filter_tabs plugin in Site Administration -> Plugins -> Filters -> Manage filters

To create FontAwesome icons in textfields, use the following syntax: [fa-*] where * is the name of the icon you wish to display
To create the buttonawesome buttons and icons use the following key:
[btn-x-iconname] where x can be p (primary), s (success), i (info), w (warning), d (danger) or any other single character for default and will apply the theme's colour scheme for those preset bootstrap button classes.
Settings
=========================
filter_fontawesome has a settings page to allow you to limit the filter to only certain textbox formats.

Still to be done
=========================
I am still figuring out how to add an abilityt  o detect a custom variable to allow the user to set the icon size. DONE: Simply add the icon size fontawesome code (e.g. fa-2x) following the icon name - it works

Copyright
=========================
Written by Julian (@moodleman) Ridden. Visit the blog at http://www.moodleman.net
Updated by David Bezemer. Visit his company page at http://www.uplearning.nl
