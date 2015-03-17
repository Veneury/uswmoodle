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
 
require_once(dirname(__FILE__).'/includes/header.php'); ?>
    <!-- Start Alerts -->

        <!-- Alert #1 -->
        <?php if ($PAGE->theme->settings->enable1alert) { ?>  
            <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert1type ?>">  
            <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
            <?php 
            if ($PAGE->theme->settings->alert1type == 'info') {
                $alert1icon = $alertinfo;
            } else if ($PAGE->theme->settings->alert1type == 'error') {
                $alert1icon = $alertwarning;
            } else {
                $alert1icon = $alertsuccess;
            } 
            $alert1title = 'alert1title';
            $alert1text = 'alert1text';
            echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->$alert1title.'</span>'.$PAGE->theme->settings->$alert1text; ?> 
        </div>
        <?php } ?>

        <!-- Alert #2 -->
        <?php if ($PAGE->theme->settings->enable2alert) { ?>  
            <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert2type ?>">  
            <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
            <?php 
            if ($PAGE->theme->settings->alert2type == 'info') {
                $alert2icon = $alertinfo;
            } else if ($PAGE->theme->settings->alert2type == 'error') {
                $alert2icon = $alertwarning;
            } else {
                $alert2icon = $alertsuccess;
            } 
            $alert2title = 'alert2title';
            $alert2text = 'alert2text';
            echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->$alert2title.'</span>'.$PAGE->theme->settings->$alert2text; ?> 
        </div>
        <?php } ?>

        <!-- Alert #3 -->
        <?php if ($PAGE->theme->settings->enable3alert) { ?>  
            <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert3type ?>">  
            <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times-circle"></i></a>
            <?php 
            if ($PAGE->theme->settings->alert3type == 'info') {
                $alert3icon = $alertinfo;
            } else if ($PAGE->theme->settings->alert3type == 'error') {
                $alert3icon = $alertwarning;
            } else {
                $alert3icon = $alertsuccess;
            } 
            $alert3title = 'alert3title';
            $alert3text = 'alert3text';
            echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->$alert3title.'</span>'.$PAGE->theme->settings->$alert3text; ?> 
        </div>
        <?php } ?>
        <!-- End Alerts -->
<!-- RMO *** Targetted Announcement section - a brief system announcement can be placed here to appear at the top of every page e.g. warning about service outage for maintenance etc.-->
<!-- <p style="font-size:medium; font-weight:400; color:#be0f34; margin-bottom:0px;">If you need access to the <span style="color:#124e8a; font-weight:900;">Moodle2012-13</span> pages please <a href="https://my.newport.ac.uk/moodle2/my/"> <span style="color:#124e8a; font-weight:900;">click here.</span></a></p> -->
<?php
// *** STAFF ONLY ANNOUNCEMENTS ***
// Is user staff or student
        if (isloggedin()){              // User must be logged in to access - but this acts as an error trap
            $useremail=$USER->email;    // Use the user email to determine user type - if not "student" then treat as staff
            $useremailtype=substr($useremail,-25,-17);
            if ($useremailtype=="students") {
                $usertype="student";
            }else{
                $usertype="staff";
            }
        }else {
            $usertype="student";
        }
// Announcement
	if ($usertype == "staff") {
		echo '<p style="font-size:medium; font-weight:400; color:#be0f34; margin-bottom:0px;margin-left:10px;margin-top:25px;">Staff, Please Note: Modules should not be hidden in their entirety as this causes confusion for students who are then under the impression they are not correctly enrolled. If you need to hide a module because it is not due to start, please hide the content within the module rather than the whole thing and add a note to the introduction explaining when the content will be made available. Thank you</p>';
	}
?>
<!-- RMO *******************************-->


<div id="page" class="container-fluid">
    <div id="page-navbar" class="clearfix row-fluid">
        <div class="breadcrumb-nav pull-<?php echo ($left) ? 'left' : 'right'; ?>"><?php echo $OUTPUT->navbar(); ?></div>
        <nav class="breadcrumb-button pull-<?php echo ($left) ? 'right' : 'left'; ?>"><?php echo $OUTPUT->page_heading_button(); ?></nav>
    </div>
    
    <section class="slideshow">
        <!-- Start Slideshow -->
        <?php 
            if(theme_essential2_get_setting('toggleslideshow')==1) {
                require_once(dirname(__FILE__).'/includes/slideshow.php');
            } else if(theme_essential2_get_setting('toggleslideshow')==2 && !isloggedin()) {
                require_once(dirname(__FILE__).'/includes/slideshow.php');
            } else if(theme_essential2_get_setting('toggleslideshow')==3 && isloggedin()) {
                require_once(dirname(__FILE__).'/includes/slideshow.php');
            } 
        ?>
        <!-- End Slideshow -->
    </section>
    
    <section role="main-content">
        <!-- Start Main Regions -->
        <div id="page-content" class="row-fluid">
            <div id="<?php echo $regionbsid ?>" class="span9">
                <div class="row-fluid">
                    <?php if ($hasboringlayout) { ?>
                    <section id="region-main" class="span8 pull-right">
                    <?php } else { ?>
                    <section id="region-main" class="span8 desktop-first-column">
                    <?php } ?>
                        <?php if ($COURSE->id > 1) {
                            echo $OUTPUT->heading($COURSE->fullname, 1, 'coursetitle');
                            echo '<div class="bor" style="margin-top: 10px;"></div>';
                        } ?>
                        <?php echo $OUTPUT->course_content_header(); ?>
                        <?php echo $OUTPUT->main_content(); ?>
                        <?php echo $OUTPUT->course_content_footer(); ?>
                    </section>
                    <?php if ($hasboringlayout) { ?>
                    <?php echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column'); ?>
                    <?php } else { ?>
                    <?php echo $OUTPUT->blocks('side-pre', 'span4 pull-right'); ?>
                    <?php } ?>
                </div>
            </div>
            <?php echo $OUTPUT->blocks('side-post', 'span3'); ?>
        </div>
        <!-- End Main Regions -->
    </section>
</div>

<?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>

</body>
</html>
