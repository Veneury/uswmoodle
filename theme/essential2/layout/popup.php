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
 * A popup layout for the Bootstrapbase theme.
 *
 * @package   theme_essential2
 * @copyright 2012 Bas Brands, www.basbrands.nl
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google web fonts -->
	<?php require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- Start Google Analytics -->
    <?php if ($hasanalytics) {
        require_once(dirname(__FILE__).'/includes/analytics.php');
	} ?>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php
    // If on desktop, then hide the header/footer.
    $hideclass = '';
    $devicetype = core_useragent::get_device_type();
    if($devicetype !== 'mobile' and $devicetype !== 'tablet') {
        // We can not use the Bootstrap responsive css classes because popups are phone sized on desktop.
        $hideclass = 'hide';
    }
?>

<header role="banner" class="navbar navbar-fixed-top moodle-has-zindex <?php echo $hideclass; ?>">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
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
    </nav>
</header>

<div id="page" class="container-fluid">
    <div id="page-navbar" class="clearfix row-fluid">
        <div class="breadcrumb-nav pull-<?php echo ($left) ? 'left' : 'right'; ?>"><?php echo $OUTPUT->navbar(); ?></div>
        <nav class="breadcrumb-button pull-<?php echo ($left) ? 'right' : 'left'; ?>"><?php echo $OUTPUT->page_heading_button(); ?></nav>
    </div>
    <header id="page-header" class="clearfix">
        <?php echo $OUTPUT->page_heading(); ?>
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>

    <div id="page-content" class="row-fluid">
        <section id="region-main" class="span12">
            <?php
            echo $OUTPUT->course_content_header();
            echo $OUTPUT->main_content();
            echo $OUTPUT->course_content_footer();
            ?>
        </section>
    </div>

    <footer id="page-footer" class="<?php echo $hideclass; ?>">
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
