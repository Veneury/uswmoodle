<?php
if (!empty($CFG->themedir) and file_exists("$CFG->themedir/newu")) {
    require_once ($CFG->themedir."/newu/lib.php");
} else {
    require_once ($CFG->dirroot."/theme/newu/lib.php");
}

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

// $PAGE->blocks->region_has_content('region_name') doesn't work as we do some sneaky stuff 
// to hide nav and/or settings blocks if requested
$blocks_side_pre = trim($OUTPUT->blocks_for_region('side-pre'));
$hassidepre = strlen($blocks_side_pre);
$blocks_side_post = trim($OUTPUT->blocks_for_region('side-post'));
$hassidepost = strlen($blocks_side_post);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
if (empty($PAGE->layout_options['nocourseheaderfooter'])) {  //Check if we're displaying course specific headers and footers
    $courseheader = method_exists($OUTPUT, "course_header") ? $OUTPUT->course_header() : NULL; //Course header - Backward compatible for <2.4
    $coursecontentheader = method_exists($OUTPUT, "course_content_header") ? $OUTPUT->course_content_header() : NULL; //Course content header - Backward compatible for <2.4
    if (empty($PAGE->layout_options['nocoursefooter'])) { //Chekc if we're displaying course footers
        $coursefooter = method_exists($OUTPUT, "course_footer") ? $OUTPUT->course_footer() : NULL; //Course footer - Backward compatible for <2.4
      $coursecontentfooter = method_exists($OUTPUT, "course_content_footer") ? $OUTPUT->course_content_footer() : NULL; //Course Content Footer - Backward compatible for <2.4
    }
}

// newu_initialise_awesomebar($PAGE);

$bodyclasses = array();
$bodyclasses[]=date("Md");

if(!empty($PAGE->theme->settings->useeditbuttons) && $PAGE->user_allowed_editing()) {
    newu_initialise_editbuttons($PAGE);
    $bodyclasses[] = 'newu_with_edit_buttons';
}

if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

if(!empty($PAGE->theme->settings->persistentedit) && $PAGE->user_allowed_editing()) {
    if(property_exists($USER, 'editing') && $USER->editing) {
        $OUTPUT->set_really_editing(true);
    }
    $USER->editing = 1;
    $bodyclasses[] = 'newu_persistent_edit';
}

if (!empty($PAGE->theme->settings->footnote)) {
    $footnote = $PAGE->theme->settings->footnote;
} else {
    $footnote = '<!-- There was no custom footnote set -->';
}

if (check_browser_version("MSIE", "0")) {
    header('X-UA-Compatible: IE=edge');
}

//Settings for responsive design taken from Zebra theme
$userespond = ($PAGE->theme->settings->userespond); //Check the theme settings to see if respond.js should be called
$usecf = ($PAGE->theme->settings->usecf); //Check the theme settings to see if Chrome Frame should be called
$cfmaxversion = ($PAGE->theme->settings->cfmaxversion); //Check the theme settings to see which versions of IE get prompted for Chrome Frame
$ieversion = strpos($PAGE->bodyclasses, $cfmaxversion);
$usingie = strpos($PAGE->bodyclasses, 'ie ie'); //Check if the user is using IE
$usingie9 = strpos($PAGE->bodyclasses, 'ie9'); //Make sure the user isn't using IE9 because it can use @media declarations natively
$usingios = (preg_match('/iPhone|iPod|iPad/i', $_SERVER['HTTP_USER_AGENT']));
$requiresrespond = ($userespond && $usingie && !$usingie9); //Check all the options necessary to print respond.js
$requirescf = ($usecf && $usingie && $ieversion); // Check all the options necessary to print chrome frame
//Settings for profilebar taken from Aardvark
$hasemailurl = (!empty($PAGE->theme->settings->emailurl));
$hasprofilebarcustom = (!empty($PAGE->theme->settings->profilebarcustom));


echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <?php if ($usecf) { ?><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php } ?>
    <title><?php echo $PAGE->title ?></title>
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo $OUTPUT->pix_url('favicon/favicon', 'theme'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $OUTPUT->pix_url('favicon/h/apple-touch-icon-precomposed', 'theme'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $OUTPUT->pix_url('favicon/m/apple-touch-icon-precomposed', 'theme'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $OUTPUT->pix_url('favicon/l/apple-touch-icon-precomposed', 'theme'); ?>">

    <?php echo $OUTPUT->standard_head_html() ?>
    <script type="text/javascript">
    YUI().use('node', function(Y) {
        window.thisisy = Y;
    	Y.one(window).on('scroll', function(e) {
    	    var node = Y.one('#back-to-top');

    	    if (Y.one('window').get('docScrollY') > Y.one('#page-content-wrapper').getY()) {
    		    node.setStyle('display', 'block');
    	    } else {
    		    node.setStyle('display', 'none');
    	    }
    	});

    });
    </script>
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
        <?php include_once("analyticstracking.php") ?>
<?php echo $OUTPUT->standard_top_of_body_html();?>

<div id="page">

<?php if ($hasheading || $hasnavbar) { ?>

    <div id="page-header">
		<div id="page-header-wrapper">
	        
	        <?php if ($hasheading) { ?>
		    	<h1 class="headermain"><?php echo $PAGE->heading ?></h1>
    		    <div class="headermenu">
        			<?php
        	            include('profileblock.php')
        			?>
	        	</div>
	        <?php } ?>        
        	
	    </div>
    </div>
	<div class="navbutton"> <?php echo $PAGE->button; ?></div>
    <?php if ($hascustommenu && empty($PAGE->theme->settings->custommenuinawesomebar)) { ?>
      <div id="custommenu" class="newu-awesome-bar"><?php echo $custommenu; ?></div>
 	<?php } ?>
	
<!-- RMO *** Announcement section - a brief system announcement can be placed here to appear at the top of every page e.g. warning about service outage for maintenance etc.-->
<p style="font-size:medium; font-weight:400; color:#be0f34; margin-bottom:0px;">If you need access to the <span style="color:#124e8a; font-weight:900;">Moodle2012-13</span> pages please <a href="https://my.newport.ac.uk/moodle2/my/"> <span style="color:#124e8a; font-weight:900;">click here.</span></a></p>
<!-- RMO *******************************-->

    <?php if ($hasnavbar) { ?>
	    <div class="navbar clearfix">
<!--    	    <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>  -->
    	    <div class="breadcrumb"><?php include('mybreadcrumbs.php'); ?></div>
        </div>

    <?php } ?>

<?php } ?>
<!-- END OF HEADER -->
<div id="page-content-wrapper" class="clearfix">
    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">
            
                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                        
                            <?php if (!empty($courseheader)) { ?>
                                 <div id="course-header"><?php echo $courseheader; ?></div>
                            <?php } ?>
                            <?php echo $coursecontentheader; ?>

                            <?php echo method_exists($OUTPUT, "main_content")?$OUTPUT->main_content():core_renderer::MAIN_CONTENT_TOKEN ?>
                            
                            <?php echo $coursecontentfooter; ?>
                            
                        </div>
                    </div>
                </div>
                
                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $blocks_side_pre ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                        <?php echo $blocks_side_post ?>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>

<!-- START OF FOOTER -->
<?php     if (!empty($coursefooter)) { ?>	
       <div id="course-footer"><?php echo $coursefooter; ?></div>
     <?php } ?>
     
    <?php if ($hasfooter) { ?>
    <div id="page-footer" class="clearfix">
		<div class="footnote"><?php echo $footnote; ?></div>
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>
    <?php } ?>
</div>
    <?php if ($requirescf) {
	$PAGE->requires->js(new moodle_url('http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js')); ?>
	<script>
	    //<![CDATA[
		window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})
	    //]]>
	</script>
    <?php }
    
/*    if ($requiresrespond) {
        if (!empty($CFG->themedir) and file_exists("$CFG->themedir/newu")) {
	    $PAGE->requires->js($CFG->themedir.'/newu/yui/respond.js');
	    } else {
	    $PAGE->requires->js($CFG->dirroot.'/theme/newu/yui/respond.js');
	    }
    } */
/*    if ($usingios) { //Check if the user is using iOS and serve a JS to fix a viewport re-flow bug
        if (!empty($CFG->themedir) and file_exists("$CFG->themedir/newu")) {
	    $PAGE->requires->js($CFG->themedir.'/newu/yui/iOS-viewport-fix.js');
	    } else {
	    $PAGE->requires->js($CFG->dirroot.'/theme/newu/yui/iOS-viewport-fix.js');
	    }
    } */?>
      
<?php echo $OUTPUT->standard_end_of_body_html() ?>
<div id="back-to-top"> 
    <a class="arrow" href="#">▲</a> 
    <a class="text" href="#">Back to Top</a> 
</div>
</body>
</html>
