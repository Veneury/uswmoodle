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
 
require_once(dirname(__FILE__).'/pagesettings.php');

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?> class="no-js">
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google web fonts -->
    <?php require_once(dirname(__FILE__).'/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/iosicons.php'); ?>
    <!-- Start Google Analytics -->
    <?php if ($hasanalytics) { ?>
        <?php require_once(dirname(__FILE__).'/analytics.php'); ?>
    <?php } ?>
    <!-- End Google Analytics -->
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner">
    <div id="page-header" class="clearfix<?php echo ($oldnavbar)? ' oldnavbar': '';?>">
        <div class="container-fluid">
            <div class="row-fluid">
            <!-- HEADER: LOGO AREA -->
                    <div class="<?php echo $logoclass; echo (!$left) ? ' pull-right': ' pull-left';?>">
                        <?php if (!$haslogo) { ?>
                            <a class="textlogo" href="<?php echo $CFG->wwwroot;?>">
                                <i id="headerlogo" class="fa fa-<?php echo theme_essential2_get_setting('siteicon'); ?>"></i>
                                <h1 id="title"><?php echo $PAGE->title; ?></h1>
                            </a>
                        <?php } else { ?>
                            <a class="logo" href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"></a>
                        <?php } ?>
                    </div>
                <?php if ($hassocialnetworks || $hasmobileapps) { ?>
                    <a class="btn btn-icon" data-toggle="collapse" data-target=".icon-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="icon-collapse collapse">
                <?php }
                // If true, displays the heading and available social links; displays nothing if false.
                if ($hassocialnetworks) {
                ?>
                <div class="span5 pull-<?php echo ($left) ? 'right': 'left';?>" id="socialnetworks">
                <p id="socialheading"><?php echo get_string('socialnetworks','theme_essential2')?></p>
                    <ul class="socials unstyled">
                        <?php
                            echo $OUTPUT->render_social_network('googleplus');
                            echo $OUTPUT->render_social_network('twitter');
                            echo $OUTPUT->render_social_network('facebook');
                            echo $OUTPUT->render_social_network('linkedin');
                            echo $OUTPUT->render_social_network('youtube');
                            echo $OUTPUT->render_social_network('flickr');
                            echo $OUTPUT->render_social_network('pinterest');
                            echo $OUTPUT->render_social_network('instagram');
                            echo $OUTPUT->render_social_network('vk');
                            echo $OUTPUT->render_social_network('skype');
                            echo $OUTPUT->render_social_network('website');
                        ?>
                    </ul>
                </div>
                <?php 
                }
                // If true, displays the heading and available social links; displays nothing if false.
                if ($hasmobileapps) {
                ?>
                <div class="span2 pull-<?php echo ($left) ? 'right': 'left';?>">
                    <p id="socialheading"><?php echo get_string('mobileappsheading','theme_essential2')?></p>
                    <ul class="socials unstyled">
                        <?php 
                            echo $OUTPUT->render_social_network('ios');
                            echo $OUTPUT->render_social_network('android');
                        ?>
                    </ul>
                </div>
                <?php 
                }
                if (!empty($courseheader)) { ?>
                    <div id="course-header"><?php echo $courseheader; ?></div>
                <?php }
                    if ($hassocialnetworks || $hasmobileapps) { ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <nav role="navigation">
        <div class="navbar<?php echo ($oldnavbar)? ' oldnavbar': '';?>">
            <div class="container-fluid navbar-inner">
                <div class="row-fluid">
                    <div class="custommenus pull-left">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="<?php echo $CFG->wwwroot;?>"><!--<?php echo $SITE->shortname; ?>--></a>
                        <div class="nav-collapse collapse pull-left">
                            <div id="custom_menu_language">
                                <?php echo $OUTPUT->custom_menu_language(); ?>
                            </div>
                            <div id="custom_menu_courses">
                            <?php echo $OUTPUT->custom_menu_courses(); ?>
                            </div>
                            <?php if ($colourswitcher) { ?>
                                <div id="custom_menu_themecolours">
                                <?php echo $OUTPUT->custom_menu_themecolours(); ?>
                                </div>
                            <?php } ?>
                            <div id="custom_menu">
                            <?php echo $OUTPUT->custom_menu(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="usermenu">
                            <?php echo $OUTPUT->custom_menu_user(); ?>
                        </div>
                        <div class="messagemenu">
                            <?php echo $OUTPUT->custom_menu_messages(); ?>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </nav>
</header>
