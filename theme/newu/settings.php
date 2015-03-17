<?php

/**
 * Settings for the newu theme
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Background colour setting
    $name = 'theme_newu/backgroundcolor';
    $title = get_string('backgroundcolor','theme_newu');
    $description = get_string('backgroundcolordesc', 'theme_newu');
    $default = '#be0f34';
    $previewconfig = array('selector'=>'html', 'style'=>'backgroundColor');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    
    //Set the path to the logo image
    $name = 'theme_newu/logourl';
    $title = get_string('logourl','theme_newu');
    $description = get_string('logourldesc', 'theme_newu');
    $default = 'usw1';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);
    
    // Menu Background colour setting
    $name = 'theme_newu/menubackgroundcolor';
    $title = get_string('menubackgroundcolor','theme_newu');
    $description = get_string('menubackgroundcolordesc', 'theme_newu');
    $default = '#c4002e';
    $previewconfig = array('selector'=>'html', 'style'=>'menubackgroundColor');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    
    // Custom CSS file
    $name = 'theme_newu/customcss';
    $title = get_string('customcss','theme_newu');
    $description = get_string('customcssdesc', 'theme_newu');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);

    // Foot note setting
    $name = 'theme_newu/footnote';
    $title = get_string('footnote','theme_newu');
    $description = get_string('footnotedesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

    // Enable edit buttons (replace rows of icons)
    $name = 'theme_newu/useeditbuttons';
    $title = get_string('useeditbuttons','theme_newu');
    $description = get_string('useeditbuttonsdesc', 'theme_newu');
    $default = 1;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Enable "persistent editing mode" (no need to turn on/off edit mode)
    $name = 'theme_newu/persistentedit';
    $title = get_string('persistentedit','theme_newu');
    $description = get_string('persistenteditdesc', 'theme_newu');
    $default = 0;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Hide Settings block
    $name = 'theme_newu/hidesettingsblock';
    $title = get_string('hidesettingsblock','theme_newu');
    $description = get_string('hidesettingsblockdesc', 'theme_newu');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Hide Navigation block
    $name = 'theme_newu/hidenavigationblock';
    $title = get_string('hidenavigationblock','theme_newu');
    $description = get_string('hidenavigationblockdesc', 'theme_newu');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);
    
    // Show user profile picture
    $name = 'theme_newu/showuserpicture';
    $title = get_string('showuserpicture','theme_newu');
    $description = get_string('showuserpicturedesc', 'theme_newu');
    $default = 1;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Add custom menu to Awesomebar
    $name = 'theme_newu/custommenuinawesomebar';
    $title = get_string('custommenuinawesomebar','theme_newu');
    $description = get_string('custommenuinawesomebardesc', 'theme_newu');
    $default = 0;
    $choices = array(1=>'Yes', 0=>'No');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Place custom menu after Awesomebar
    $name = 'theme_newu/custommenuafterawesomebar';
    $title = get_string('custommenuafterawesomebar','theme_newu');
    $description = get_string('custommenuafterawesomebardesc', 'theme_newu');
    $default = 0;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);
  
//Settings brought across from Zebra
    //This is the descriptor for the following browser compatibility settings
    $name = 'theme_newu/compatibilityinfo';
    $heading = get_string('compatinfo', 'theme_newu');
    $information = get_string('compatinfodesc', 'theme_newu');
    $setting = new admin_setting_heading($name, $heading, $information);
    $settings->add($setting);

    //Enable inclusion of respond.js in the footer
    $name = 'theme_newu/userespond';
    $visiblename = get_string('userespond', 'theme_newu');
    $title = get_string('userespond', 'theme_newu');
    $description = get_string('useresponddesc', 'theme_newu');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Enable prompt of Google Chrome Frame
    $name = 'theme_newu/usecf';
    $visiblename = get_string('usecf', 'theme_newu');
    $title = get_string('usecf', 'theme_newu');
    $description = get_string('usecfdesc', 'theme_newu');
    $setting = new admin_setting_configcheckbox($name, $visiblename, $description, 1);
    $settings->add($setting);

    //Set maximum version for Chrome Frome prompt
    $name = 'theme_newu/cfmaxversion';
    $title = get_string('cfmaxversion','theme_newu');
    $description = get_string('cfmaxversiondesc', 'theme_newu');
    $default = 'ie8';
    $choices = array('ie6'=>'6', 'ie7'=>'7', 'ie8'=>'8');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting); 
    
// Profilebar Email url setting

$name = 'theme_newu/emailurl';
$title = get_string('emailurl','theme_newu');
$description = get_string('emailurldesc', 'theme_newu');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$settings->add($setting);
   
// Profilebar custom block title setting

$name = 'theme_newu/profilebarcustomtitle';
$title = get_string('profilebarcustomtitle','theme_newu');
$description = get_string('profilebarcustomtitledesc', 'theme_newu');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$settings->add($setting);

// Profilebar custom block setting

$name = 'theme_newu/profilebarcustom';
$title = get_string('profilebarcustom','theme_newu');
$description = get_string('profilebarcustomdesc', 'theme_newu');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$settings->add($setting);

/**** BOX SLIDER ****/

//INSTRUCTIONS
$name = 'theme_newu/instructions';
$title=get_string('instruction_title','theme_newu');
$description = get_string('instructions', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider1';
$title=get_string('divider1','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 1st Screen image
    $name = 'theme_newu/bximage1';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 1st Screen content
    $name = 'theme_newu/bxtext1';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider2';
$title=get_string('divider2','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 2nd Screen image
    $name = 'theme_newu/bximage2';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);


    // 2nd Screen content
    $name = 'theme_newu/bxtext2';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider3';
$title=get_string('divider3','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 3rd Screen image
    $name = 'theme_newu/bximage3';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 3rd Screen content
    $name = 'theme_newu/bxtext3';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider4';
$title=get_string('divider4','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 4th Screen image
    $name = 'theme_newu/bximage4';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 4th Screen content
    $name = 'theme_newu/bxtext4';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider5';
$title=get_string('divider5','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 5th Screen image
    $name = 'theme_newu/bximage5';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 5th Screen content
    $name = 'theme_newu/bxtext5';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider6';
$title=get_string('divider6','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 6th Screen image
    $name = 'theme_newu/bximage6';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 6th Screen content
    $name = 'theme_newu/bxtext6';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider7';
$title=get_string('divider7','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 7th Screen image
    $name = 'theme_newu/bximage7';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 7th Screen content
    $name = 'theme_newu/bxtext7';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_newu/divider8';
$title=get_string('divider8','theme_newu');
$description = get_string('dividerdesc', 'theme_newu');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 8th Screen image
    $name = 'theme_newu/bximage8';
    $title = get_string('bximage','theme_newu');
    $description = get_string('bximagedesc', 'theme_newu');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 8th Screen content
    $name = 'theme_newu/bxtext8';
    $title = get_string('bxtext','theme_newu');
    $description = get_string('bxtextdesc', 'theme_newu');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

}
