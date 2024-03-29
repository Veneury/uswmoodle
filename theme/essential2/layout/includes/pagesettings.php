<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is built using the bootstrapbase template to allow for new theme's using
 * Moodle's new Bootstrap theme engine
 *
 * @package     theme_essential2
 * @copyright   2013 Julian Ridden
 * @copyright   2014 Gareth J Barnard, David Bezemer
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
/* Group Body */
$bodyclasses = array();

if (theme_essential2_get_setting('enablealternativethemecolors1') || 
    theme_essential2_get_setting('enablealternativethemecolors2') || 
    theme_essential2_get_setting('enablealternativethemecolors3')) {
        $colourswitcher = true;
        theme_essential2_check_colours_switch();
        theme_essential2_initialise_colourswitcher($PAGE);
        $bodyclasses[] = 'essential2-colours-' . theme_essential2_get_colours();
} else {
    $colourswitcher = false;
}

if (theme_essential2_get_setting('slidecaptionbelow')) {
    $bodyclasses[] = 'frontpageslidercaptionbelow';
}

switch (theme_essential2_get_setting('pagewidth')) {
    case 100:
        $bodyclasses[] = 'pagewidthvariable';
        break;
    case 960:
        $bodyclasses[] = 'pagewidthnarrow';
        break;
    case 1200:
        $bodyclasses[] = 'pagewidthnormal';
        break;
    case 1400:
        $bodyclasses[] = 'pagewidthwide';
        break;
}
if (!empty($CFG->custommenuitems)) {
    $bodyclasses[] = 'custommenuitems';
}
if (theme_essential2_get_setting('enablecategoryicon')) {
    $bodyclasses[] = 'categoryicons';
}

if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
    $left = false;
} else {
    $regionbsid = 'region-bs-main-and-pre';
    $left = true;
}

$bodyclasses = array();
$bodyclasses[]=date("Md");

$fontselect = theme_essential2_get_setting('fontselect');

/* Group Header */

$hasanalytics = theme_essential2_get_setting('useanalytics');

$hassocialnetworks = (  theme_essential2_get_setting('facebook')     ||
                        theme_essential2_get_setting('twitter')      ||
                        theme_essential2_get_setting('googleplus')   ||
                        theme_essential2_get_setting('linkedin')     ||
                        theme_essential2_get_setting('youtube')      ||
                        theme_essential2_get_setting('flickr')       ||
                        theme_essential2_get_setting('vk')           ||
                        theme_essential2_get_setting('pinterest')    ||
                        theme_essential2_get_setting('instagram')    ||
                        theme_essential2_get_setting('skype')        ||
                        theme_essential2_get_setting('website')
                    );
$hasmobileapps =    (   theme_essential2_get_setting('ios')          ||
                        theme_essential2_get_setting('android')
                    );

$logoclass = 'span12';
if ($hassocialnetworks && !($hasmobileapps)) {
    $logoclass = 'span7';
} else if (($hassocialnetworks) && !($hasmobileapps)) {
    $logoclass = 'span10';
} else if ($hassocialnetworks && $hasmobileapps) {
    $logoclass = 'span5';
}

$oldnavbar = theme_essential2_get_setting('oldnavbar');

$haslogo = theme_essential2_get_setting('logo');

/* Group Slideshow */

/* Group Frontpage */
$alertinfo = '<span class="fa-stack "><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
$alerterror = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
$alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';

$hasmarketing1image = theme_essential2_get_setting('marketing1image');
$hasmarketing2image = theme_essential2_get_setting('marketing2image');
$hasmarketing3image = theme_essential2_get_setting('marketing3image');

/* Group Content */
$hasboringlayout = theme_essential2_get_setting('layout');

/* Group Footer */
$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$hascopyright = theme_essential2_get_setting('copyright', true);
$hasfootnote = theme_essential2_get_setting('footnote', 'format_text');
