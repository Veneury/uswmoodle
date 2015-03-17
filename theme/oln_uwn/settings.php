<?php

/**
 * Settings for the OLN Box Slider
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

//INSTRUCTIONS
$name = 'theme_oln_uwn/instructions';
$title=get_string('instruction_title','theme_oln_uwn');
$description = get_string('instructions', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

/***
    // Number of slides
    $name = 'theme_oln_uwn/slides';
    $title = get_string('slides','theme_oln_uwn');
    $description = get_string('slidesdesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '4',PARAM_CLEAN, 2);
    $settings->add($setting);
***/

// Slide Divider
$name = 'theme_oln_uwn/divider1';
$title=get_string('divider1','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 1st Screen image
    $name = 'theme_oln_uwn/bximage1';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 1st Screen content
    $name = 'theme_oln_uwn/bxtext1';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider2';
$title=get_string('divider2','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 2nd Screen image
    $name = 'theme_oln_uwn/bximage2';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);


    // 2nd Screen content
    $name = 'theme_oln_uwn/bxtext2';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider3';
$title=get_string('divider3','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 3rd Screen image
    $name = 'theme_oln_uwn/bximage3';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 3rd Screen content
    $name = 'theme_oln_uwn/bxtext3';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider4';
$title=get_string('divider4','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 4th Screen image
    $name = 'theme_oln_uwn/bximage4';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 4th Screen content
    $name = 'theme_oln_uwn/bxtext4';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider5';
$title=get_string('divider5','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 5th Screen image
    $name = 'theme_oln_uwn/bximage5';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 5th Screen content
    $name = 'theme_oln_uwn/bxtext5';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider6';
$title=get_string('divider6','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 6th Screen image
    $name = 'theme_oln_uwn/bximage6';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 6th Screen content
    $name = 'theme_oln_uwn/bxtext6';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider7';
$title=get_string('divider7','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 7th Screen image
    $name = 'theme_oln_uwn/bximage7';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 7th Screen content
    $name = 'theme_oln_uwn/bxtext7';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);

// Slide Divider
$name = 'theme_oln_uwn/divider8';
$title=get_string('divider8','theme_oln_uwn');
$description = get_string('dividerdesc', 'theme_oln_uwn');
$setting = new admin_setting_configtext($name, $title, $description, '');
$settings->add($setting);

    // 8th Screen image
    $name = 'theme_oln_uwn/bximage8';
    $title = get_string('bximage','theme_oln_uwn');
    $description = get_string('bximagedesc', 'theme_oln_uwn');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $settings->add($setting);

    // 8th Screen content
    $name = 'theme_oln_uwn/bxtext8';
    $title = get_string('bxtext','theme_oln_uwn');
    $description = get_string('bxtextdesc', 'theme_oln_uwn');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);



}
?>
