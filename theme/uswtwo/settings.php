<?php

/**
 * Settings for the uswtwo theme
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Background colour setting
    $name = 'theme_uswtwo/backgroundcolor';
    $title = get_string('backgroundcolor','theme_uswtwo');
    $description = get_string('backgroundcolordesc', 'theme_uswtwo');
    $default = '#be0f34';
    $previewconfig = array('selector'=>'html', 'style'=>'backgroundColor');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    
    //Set the path to the logo image
    $name = 'theme_uswtwo/logourl';
    $title = get_string('logourl','theme_uswtwo');
    $description = get_string('logourldesc', 'theme_uswtwo');
    $default = 'usw1';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);
    
    // Menu Background colour setting
    $name = 'theme_uswtwo/menubackgroundcolor';
    $title = get_string('menubackgroundcolor','theme_uswtwo');
    $description = get_string('menubackgroundcolordesc', 'theme_uswtwo');
    $default = '#c4002e';
    $previewconfig = array('selector'=>'html', 'style'=>'menubackgroundColor');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    
    // Custom CSS file
    $name = 'theme_uswtwo/customcss';
    $title = get_string('customcss','theme_uswtwo');
    $description = get_string('customcssdesc', 'theme_uswtwo');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // Foot note setting
    $name = 'theme_uswtwo/footnote';
    $title = get_string('footnote','theme_uswtwo');
    $description = get_string('footnotedesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

    // Enable edit buttons (replace rows of icons)
    $name = 'theme_uswtwo/useeditbuttons';
    $title = get_string('useeditbuttons','theme_uswtwo');
    $description = get_string('useeditbuttonsdesc', 'theme_uswtwo');
    $default = 1;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Enable "persistent editing mode" (no need to turn on/off edit mode)
    $name = 'theme_uswtwo/persistentedit';
    $title = get_string('persistentedit','theme_uswtwo');
    $description = get_string('persistenteditdesc', 'theme_uswtwo');
    $default = 0;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Hide Settings block
    $name = 'theme_uswtwo/hidesettingsblock';
    $title = get_string('hidesettingsblock','theme_uswtwo');
    $description = get_string('hidesettingsblockdesc', 'theme_uswtwo');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Hide Navigation block
    $name = 'theme_uswtwo/hidenavigationblock';
    $title = get_string('hidenavigationblock','theme_uswtwo');
    $description = get_string('hidenavigationblockdesc', 'theme_uswtwo');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);
    
    // Show user profile picture
    $name = 'theme_uswtwo/showuserpicture';
    $title = get_string('showuserpicture','theme_uswtwo');
    $description = get_string('showuserpicturedesc', 'theme_uswtwo');
    $default = 1;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Add custom menu to Awesomebar
    $name = 'theme_uswtwo/custommenuinawesomebar';
    $title = get_string('custommenuinawesomebar','theme_uswtwo');
    $description = get_string('custommenuinawesomebardesc', 'theme_uswtwo');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Place custom menu after Awesomebar
    $name = 'theme_uswtwo/custommenuafterawesomebar';
    $title = get_string('custommenuafterawesomebar','theme_uswtwo');
    $description = get_string('custommenuafterawesomebardesc', 'theme_uswtwo');
    $default = 0;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);
  
//Settings brought across from Zebra
    //This is the descriptor for the following browser compatibility settings
    $name = 'theme_uswtwo/compatibilityinfo';
    $heading = get_string('compatinfo', 'theme_uswtwo');
    $information = get_string('compatinfodesc', 'theme_uswtwo');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Enable inclusion of respond.js in the footer
    $name = 'theme_uswtwo/userespond';
    $visiblename = get_string('userespond', 'theme_uswtwo');
    $title = get_string('userespond', 'theme_uswtwo');
    $description = get_string('useresponddesc', 'theme_uswtwo');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Enable prompt of Google Chrome Frame
    $name = 'theme_uswtwo/usecf';
    $visiblename = get_string('usecf', 'theme_uswtwo');
    $title = get_string('usecf', 'theme_uswtwo');
    $description = get_string('usecfdesc', 'theme_uswtwo');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Set maximum version for Chrome Frome prompt
    $name = 'theme_uswtwo/cfmaxversion';
    $title = get_string('cfmaxversion','theme_uswtwo');
    $description = get_string('cfmaxversiondesc', 'theme_uswtwo');
    $default = 'ie8';
    $choices = array('ie6'=>'6', 'ie7'=>'7', 'ie8'=>'8');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting); 
    
// Profilebar Email url setting

$name = 'theme_uswtwo/emailurl';
$title = get_string('emailurl','theme_uswtwo');
$description = get_string('emailurldesc', 'theme_uswtwo');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$settings->add($setting);
   
// Profilebar custom block title setting

$name = 'theme_uswtwo/profilebarcustomtitle';
$title = get_string('profilebarcustomtitle','theme_uswtwo');
$description = get_string('profilebarcustomtitledesc', 'theme_uswtwo');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$settings->add($setting);

// Profilebar custom block setting

$name = 'theme_uswtwo/profilebarcustom';
$title = get_string('profilebarcustom','theme_uswtwo');
$description = get_string('profilebarcustomdesc', 'theme_uswtwo');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$settings->add($setting);

/**** BOX SLIDER ****/

//INSTRUCTIONS
$name = 'theme_uswtwo/instructions';
$title=get_string('instruction_title','theme_uswtwo');
$description = get_string('instructions', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider1';
$title=get_string('divider1','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 1st Screen image
    $name = 'theme_uswtwo/bximage1';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 1st Screen content
    $name = 'theme_uswtwo/bxtext1';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider2';
$title=get_string('divider2','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 2nd Screen image
    $name = 'theme_uswtwo/bximage2';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);


    // 2nd Screen content
    $name = 'theme_uswtwo/bxtext2';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider3';
$title=get_string('divider3','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 3rd Screen image
    $name = 'theme_uswtwo/bximage3';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 3rd Screen content
    $name = 'theme_uswtwo/bxtext3';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider4';
$title=get_string('divider4','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 4th Screen image
    $name = 'theme_uswtwo/bximage4';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 4th Screen content
    $name = 'theme_uswtwo/bxtext4';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider5';
$title=get_string('divider5','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 5th Screen image
    $name = 'theme_uswtwo/bximage5';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 5th Screen content
    $name = 'theme_uswtwo/bxtext5';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider6';
$title=get_string('divider6','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 6th Screen image
    $name = 'theme_uswtwo/bximage6';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 6th Screen content
    $name = 'theme_uswtwo/bxtext6';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider7';
$title=get_string('divider7','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 7th Screen image
    $name = 'theme_uswtwo/bximage7';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 7th Screen content
    $name = 'theme_uswtwo/bxtext7';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_uswtwo/divider8';
$title=get_string('divider8','theme_uswtwo');
$description = get_string('dividerdesc', 'theme_uswtwo');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 8th Screen image
    $name = 'theme_uswtwo/bximage8';
    $title = get_string('bximage','theme_uswtwo');
    $description = get_string('bximagedesc', 'theme_uswtwo');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 8th Screen content
    $name = 'theme_uswtwo/bxtext8';
    $title = get_string('bxtext','theme_uswtwo');
    $description = get_string('bxtextdesc', 'theme_uswtwo');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

}
