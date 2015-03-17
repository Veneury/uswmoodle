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
 
$settings = null;

defined('MOODLE_INTERNAL') || die;

    $ADMIN->add('themes', new admin_category('theme_essential2', 'Essential2'));

    /* Generic Settings */
    $temp = new admin_settingpage('theme_essential2_generic',  get_string('genericsettings', 'theme_essential2'));
    
    $donate = new moodle_url('https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=themmai%40gmail%2ecom&lc=GB&item_name=Essential%20Theme%20Fund&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted');
    $donate = html_writer::link($donate, get_string('donate_click', 'theme_essential2'), array('target' => '_blank'));
    
    $temp->add(new admin_setting_heading('theme_essential2_generaldonate', get_string('donate_title', 'theme_essential2'),
            get_string('donate_desc', 'theme_essential2', array('url' => $donate))));
            
    $temp->add(new admin_setting_heading('theme_essential2_generalheading', get_string('generalheadingsub', 'theme_essential2'),
        format_text(get_string('generalheadingdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // Default Site icon setting.
    $name = 'theme_essential2/siteicon';
    $title = get_string('siteicon', 'theme_essential2');
    $description = get_string('siteicondesc', 'theme_essential2');
    $default = 'laptop';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Include Awesome Font from Bootstrapcdn
    $name = 'theme_essential2/bootstrapcdn';
    $title = get_string('bootstrapcdn', 'theme_essential2');
    $description = get_string('bootstrapcdndesc', 'theme_essential2');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Logo file setting.
    $name = 'theme_essential2/logo';
    $title = get_string('logo', 'theme_essential2');
    $description = get_string('logodesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Font Selector.
    $name = 'theme_essential2/fontselect';
    $title = get_string('fontselect' , 'theme_essential2');
    $description = get_string('fontselectdesc', 'theme_essential2');
    $default = 1;
    $choices = array(
        1 =>'Open Sans', 
        2  =>'Oswald & PT Sans', 
        3  =>'Roboto', 
        4  =>'PT Sans', 
        5  =>'Ubuntu',
        6  =>'Arimo',
        7  =>'Lobster & Raleway',
        8  =>'Arial',
        9  =>'Georgia',
        10 =>'Verdana',
        11 =>'Times New Roman',
        12 =>'Consolas', 
        );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Background Image.
    $name = 'theme_essential2/pagebackground';
    $title = get_string('pagebackground', 'theme_essential2');
    $description = get_string('pagebackgrounddesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Fixed or Variable Width.
    $name = 'theme_essential2/pagewidth';
    $title = get_string('pagewidth', 'theme_essential2');
    $description = get_string('pagewidthdesc', 'theme_essential2');
    $default = 1200;
    $choices = array(960  => get_string('fixedwidthnarrow','theme_essential2'),
                     1200 => get_string('fixedwidthnormal','theme_essential2'),
                     1400 => get_string('fixedwidthwide','theme_essential2'),
                     100  => get_string('variablewidth','theme_essential2'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Custom or standard layout.
    $name = 'theme_essential2/layout';
    $title = get_string('layout', 'theme_essential2');
    $description = get_string('layoutdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // New or old navbar.
    $name = 'theme_essential2/oldnavbar';
    $title = get_string('oldnavbar', 'theme_essential2');
    $description = get_string('oldnavbardesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Performance Information Display.
    $name = 'theme_essential2/perfinfo';
    $title = get_string('perfinfo' , 'theme_essential2');
    $description = get_string('perfinfodesc', 'theme_essential2');
    $perf_max = get_string('perf_max', 'theme_essential2');
    $perf_min = get_string('perf_min', 'theme_essential2');
    $default = 'min';
    $choices = array('min'=>$perf_min, 'max'=>$perf_max);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Choose breadcrumbstyle
    $name = 'theme_essential2/breadcrumbstyle';
    $title = get_string('breadcrumbstyle' , 'theme_essential2');
    $description = get_string('breadcrumbstyledesc', 'theme_essential2');
    $default = 1;
    $choices = array(1 => get_string('breadcrumbstyled', 'theme_essential2'),
                     2 => get_string('breadcrumbsimple', 'theme_essential2'),
                     3 => get_string('breadcrumbthin', 'theme_essential2'),
                     0 => get_string('nobreadcrumb', 'theme_essential2')
                    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Copyright setting.
    $name = 'theme_essential2/copyright';
    $title = get_string('copyright', 'theme_essential2');
    $description = get_string('copyrightdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    
    // Footnote setting.
    $name = 'theme_essential2/footnote';
    $title = get_string('footnote', 'theme_essential2');
    $description = get_string('footnotedesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Custom CSS file.
    $name = 'theme_essential2/customcss';
    $title = get_string('customcss', 'theme_essential2');
    $description = get_string('customcssdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $readme = new moodle_url('/theme/essential2/README.txt');
    $readme = html_writer::link($readme, get_string('readme_click', 'theme_essential2'), array('target' => '_blank'));

    $temp->add(new admin_setting_heading('theme_essential2_generalreadme', get_string('readme_title', 'theme_essential2'),
            get_string('readme_desc', 'theme_essential2', array('url' => $readme))));

    $ADMIN->add('theme_essential2', $temp);
    

    
    /* Colour Settings */
    $temp = new admin_settingpage('theme_essential2_color', get_string('colorheading', 'theme_essential2'));
    $temp->add(new admin_setting_heading('theme_essential2_color', get_string('colorheadingsub', 'theme_essential2'),
            format_text(get_string('colordesc' , 'theme_essential2'), FORMAT_MARKDOWN)));

    // Main theme colour setting.
    $name = 'theme_essential2/themecolor';
    $title = get_string('themecolor', 'theme_essential2');
    $description = get_string('themecolordesc', 'theme_essential2');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Main theme text colour setting.
    $name = 'theme_essential2/themetextcolor';
    $title = get_string('themetextcolor', 'theme_essential2');
    $description = get_string('themetextcolordesc', 'theme_essential2');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme link colour setting.
    $name = 'theme_essential2/themeurlcolor';
    $title = get_string('themeurlcolor', 'theme_essential2');
    $description = get_string('themeurlcolordesc', 'theme_essential2');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Main theme Hover colour setting.
    $name = 'theme_essential2/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential2');
    $description = get_string('themehovercolordesc', 'theme_essential2');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Icon colour setting.
    $name = 'theme_essential2/themeiconcolor';
    $title = get_string('themeiconcolor', 'theme_essential2');
    $description = get_string('themeiconcolordesc', 'theme_essential2');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Navigation colour setting.
    $name = 'theme_essential2/themenavcolor';
    $title = get_string('themenavcolor', 'theme_essential2');
    $description = get_string('themenavcolordesc', 'theme_essential2');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for the Footer
    $name = 'theme_essential2/footercolorinfo';
    $heading = get_string('footercolors', 'theme_essential2');
    $information = get_string('footercolorsdesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Footer background colour setting.
    $name = 'theme_essential2/footercolor';
    $title = get_string('footercolor', 'theme_essential2');
    $description = get_string('footercolordesc', 'theme_essential2');
    $default = '#555555';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer text colour setting.
    $name = 'theme_essential2/footertextcolor';
    $title = get_string('footertextcolor', 'theme_essential2');
    $description = get_string('footertextcolordesc', 'theme_essential2');
    $default = '#bbbbbb';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer Block Heading colour setting.
    $name = 'theme_essential2/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_essential2');
    $description = get_string('footerheadingcolordesc', 'theme_essential2');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer Seperator colour setting.
    $name = 'theme_essential2/footersepcolor';
    $title = get_string('footersepcolor', 'theme_essential2');
    $description = get_string('footersepcolordesc', 'theme_essential2');
    $default = '#313131';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer URL colour setting.
    $name = 'theme_essential2/footerurlcolor';
    $title = get_string('footerurlcolor', 'theme_essential2');
    $description = get_string('footerurlcolordesc', 'theme_essential2');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Footer URL hover colour setting.
    $name = 'theme_essential2/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_essential2');
    $description = get_string('footerhovercolordesc', 'theme_essential2');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // This is the descriptor for the user theme colors.
    $name = 'theme_essential2/alternativethemecolorsinfo';
    $heading = get_string('alternativethemecolors', 'theme_essential2');
    $information = get_string('alternativethemecolorsdesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    $defaultalternativethemecolors = array('#a430d1', '#d15430', '#5dd130');
    $defaultalternativethemehovercolors = array('#9929c4', '#c44c29', '#53c429');

    foreach (range(1, 3) as $alternativethemenumber) {

        // Enables the user to select an alternative colours choice.
        $name = 'theme_essential2/enablealternativethemecolors' . $alternativethemenumber;
        $title = get_string('enablealternativethemecolors', 'theme_essential2', $alternativethemenumber);
        $description = get_string('enablealternativethemecolorsdesc', 'theme_essential2', $alternativethemenumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
        
        // User theme colour name.
        $name = 'theme_essential2/alternativethemename' . $alternativethemenumber;
        $title = get_string('alternativethemename', 'theme_essential2', $alternativethemenumber);
        $description = get_string('alternativethemenamedesc', 'theme_essential2', $alternativethemenumber);
        $default = get_string('alternativecolors', 'theme_essential2', $alternativethemenumber);
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
  
        // User theme colour setting.
        $name = 'theme_essential2/alternativethemecolor' . $alternativethemenumber;
        $title = get_string('alternativethemecolor', 'theme_essential2', $alternativethemenumber);
        $description = get_string('alternativethemecolordesc', 'theme_essential2', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Alternative theme text colour setting.
        $name = 'theme_essential2/alternativethemetextcolor' . $alternativethemenumber;
        $title = get_string('alternativethemetextcolor', 'theme_essential2', $alternativethemenumber);
        $description = get_string('alternativethemetextcolordesc', 'theme_essential2', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Alternative theme link colour setting.
        $name = 'theme_essential2/alternativethemeurlcolor' . $alternativethemenumber;
        $title = get_string('alternativethemehovercolor', 'theme_essential2', $alternativethemenumber);
        $description = get_string('alternativethemehovercolordesc', 'theme_essential2', $alternativethemenumber);
        $default = $defaultalternativethemecolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // User theme hover colour setting.
        $name = 'theme_essential2/alternativethemehovercolor' . $alternativethemenumber;
        $title = get_string('alternativethemehovercolor', 'theme_essential2', $alternativethemenumber);
        $description = get_string('alternativethemehovercolordesc', 'theme_essential2', $alternativethemenumber);
        $default = $defaultalternativethemehovercolors[$alternativethemenumber - 1];
        $previewconfig = null;
        $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    $ADMIN->add('theme_essential2', $temp);
    
    /* Header Settings */
    $temp = new admin_settingpage('theme_essential2_header', get_string('headerheading', 'theme_essential2'));
    
    /* Course Menu Settings */
    $name = 'theme_essential2/mycoursesinfo';
    $heading = get_string('mycoursesinfo', 'theme_essential2');
    $information = get_string('mycoursesinfodesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Toggle courses display in custommenu.
    $name = 'theme_essential2/displaymycourses';
    $title = get_string('displaymycourses', 'theme_essential2');
    $description = get_string('displaymycoursesdesc', 'theme_essential2');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Set terminology for dropdown course list
    $name = 'theme_essential2/mycoursetitle';
    $title = get_string('mycoursetitle','theme_essential2');
    $description = get_string('mycoursetitledesc', 'theme_essential2');
    $default = 'course';
    $choices = array(
        'course' => get_string('mycourses', 'theme_essential2'),
        'unit' => get_string('myunits', 'theme_essential2'),
        'class' => get_string('myclasses', 'theme_essential2'),
        'module' => get_string('mymodules', 'theme_essential2')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Helplink type
    $name = 'theme_essential2/helplinktype';
    $title = get_string('helplinktype' , 'theme_essential2');
    $description = get_string('helplinktypedesc', 'theme_essential2');
    $default = 1;
    $choices = array(1 => get_string('email'),
                     2 => get_string('url'),
                     0 => get_string('none')
                    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Helplink
    $name = 'theme_essential2/helplink';
    $title = get_string('helplink', 'theme_essential2');
    $description = get_string('helplinkdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /* Social Network Settings */
    $temp->add(new admin_setting_heading('theme_essential2_social', get_string('socialheadingsub', 'theme_essential2'),
            format_text(get_string('socialdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // Website url setting.
    $name = 'theme_essential2/website';
    $title = get_string('website', 'theme_essential2');
    $description = get_string('websitedesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Facebook url setting.
    $name = 'theme_essential2/facebook';
    $title = get_string(        'facebook', 'theme_essential2');
    $description = get_string(      'facebookdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Flickr url setting.
    $name = 'theme_essential2/flickr';
    $title = get_string('flickr', 'theme_essential2');
    $description = get_string('flickrdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_essential2/twitter';
    $title = get_string('twitter', 'theme_essential2');
    $description = get_string('twitterdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_essential2/googleplus';
    $title = get_string('googleplus', 'theme_essential2');
    $description = get_string('googleplusdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_essential2/linkedin';
    $title = get_string('linkedin', 'theme_essential2');
    $description = get_string('linkedindesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Pinterest url setting.
    $name = 'theme_essential2/pinterest';
    $title = get_string('pinterest', 'theme_essential2');
    $description = get_string('pinterestdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Instagram url setting.
    $name = 'theme_essential2/instagram';
    $title = get_string('instagram', 'theme_essential2');
    $description = get_string('instagramdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // YouTube url setting.
    $name = 'theme_essential2/youtube';
    $title = get_string('youtube', 'theme_essential2');
    $description = get_string('youtubedesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Skype url setting.
    $name = 'theme_essential2/skype';
    $title = get_string('skype', 'theme_essential2');
    $description = get_string('skypedesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
 
    // VKontakte url setting.
    $name = 'theme_essential2/vk';
    $title = get_string('vk', 'theme_essential2');
    $description = get_string('vkdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /* Apps Settings */
    $temp->add(new admin_setting_heading('theme_essential2_mobileapps', get_string('mobileappsheadingsub', 'theme_essential2'),
            format_text(get_string('mobileappsdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));

    // Android App url setting.
    $name = 'theme_essential2/android';
    $title = get_string('android', 'theme_essential2');
    $description = get_string('androiddesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iOS App url setting.
    $name = 'theme_essential2/ios';
    $title = get_string('ios', 'theme_essential2');
    $description = get_string('iosdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // This is the descriptor for iOS Icons
    $name = 'theme_essential2/iosiconinfo';
    $heading = get_string('iosicon', 'theme_essential2');
    $information = get_string('iosicondesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // iPhone Icon.
    $name = 'theme_essential2/iphoneicon';
    $title = get_string('iphoneicon', 'theme_essential2');
    $description = get_string('iphoneicondesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPhone Retina Icon.
    $name = 'theme_essential2/iphoneretinaicon';
    $title = get_string('iphoneretinaicon', 'theme_essential2');
    $description = get_string('iphoneretinaicondesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPad Icon.
    $name = 'theme_essential2/ipadicon';
    $title = get_string('ipadicon', 'theme_essential2');
    $description = get_string('ipadicondesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // iPad Retina Icon.
    $name = 'theme_essential2/ipadretinaicon';
    $title = get_string('ipadretinaicon', 'theme_essential2');
    $description = get_string('ipadretinaicondesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $ADMIN->add('theme_essential2', $temp);
    
    $temp = new admin_settingpage('theme_essential2_frontpage', get_string('frontpageheading', 'theme_essential2'));
    
    $temp->add(new admin_setting_heading('theme_essential2_frontcontent', get_string('frontcontentheading', 'theme_essential2'),
            ''));
    
    // Toggle Frontpage Content.
    $name = 'theme_essential2/togglefrontcontent';
    $title = get_string('frontcontent', 'theme_essential2');
    $description = get_string('frontcontentdesc', 'theme_essential2');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential2');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential2');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential2');
    $dontdisplay = get_string('dontdisplay', 'theme_essential2');
    $default = 0;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Frontpage Content
    $name = 'theme_essential2/frontcontentarea';
    $title = get_string('frontcontentarea', 'theme_essential2');
    $description = get_string('frontcontentareadesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2_frontpageblocksheading';
    $heading = get_string('frontpageblocksheading', 'theme_essential2');
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Frontpage Block alignment.
    $name = 'theme_essential2/frontpageblocks';
    $title = get_string('frontpageblocks' , 'theme_essential2');
    $description = get_string('frontpageblocksdesc', 'theme_essential2');
    $left = get_string('left', 'theme_essential2');
    $right = get_string('right', 'theme_essential2');
    $default = 1;
    $choices = array(1 => $left, 0 => $right);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Toggle Frontpage Middle Blocks
    $name = 'theme_essential2/frontpagemiddleblocks';
    $title = get_string('frontpagemiddleblocks' , 'theme_essential2');
    $description = get_string('frontpagemiddleblocksdesc', 'theme_essential2');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential2');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential2');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential2');
    $dontdisplay = get_string('dontdisplay', 'theme_essential2');
    $default = 0;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
        

    /* Marketing Spot Settings */
    $temp->add(new admin_setting_heading('theme_essential2_marketing', get_string('marketingheadingsub', 'theme_essential2'),
            format_text(get_string('marketingdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // Toggle Marketing Spots.
    $name = 'theme_essential2/togglemarketing';
    $title = get_string('togglemarketing' , 'theme_essential2');
    $description = get_string('togglemarketingdesc', 'theme_essential2');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential2');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential2');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential2');
    $dontdisplay = get_string('dontdisplay', 'theme_essential2');
    $default = 1;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Marketing Spot Image Height.
    $name = 'theme_essential2/marketingheight';
    $title = get_string('marketingheight','theme_essential2');
    $description = get_string('marketingheightdesc', 'theme_essential2');
    $default = 100;
    $choices = array(50 => '50', 100 => '100', 150 => '150', 200 => '200', 250 => '250', 300 => '300');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    
    // This is the descriptor for Marketing Spot One.
    $name = 'theme_essential2/marketing1info';
    $heading = get_string('marketing1', 'theme_essential2');
    $information = get_string('marketinginfodesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Marketing Spot One.
    $name = 'theme_essential2/marketing1';
    $title = get_string('marketingtitle', 'theme_essential2');
    $description = get_string('marketingtitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1icon';
    $title = get_string('marketingicon', 'theme_essential2');
    $description = get_string('marketingicondesc', 'theme_essential2');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1image';
    $title = get_string('marketingimage', 'theme_essential2');
    $description = get_string('marketingimagedesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1content';
    $title = get_string('marketingcontent', 'theme_essential2');
    $description = get_string('marketingcontentdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential2');
    $description = get_string('marketingbuttontextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential2');
    $description = get_string('marketingbuttonurldesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing1target';
    $title = get_string('marketingurltarget' , 'theme_essential2');
    $description = get_string('marketingurltargetdesc', 'theme_essential2');
    $target1 = get_string('marketingurltargetself', 'theme_essential2');
    $target2 = get_string('marketingurltargetnew', 'theme_essential2');
    $target3 = get_string('marketingurltargetparent', 'theme_essential2');
    $default = '_blank';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // This is the descriptor for Marketing Spot Two.
    $name = 'theme_essential2/marketing2info';
    $heading = get_string('marketing2', 'theme_essential2');
    $information = get_string('marketinginfodesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Marketing Spot Two.
    $name = 'theme_essential2/marketing2';
    $title = get_string('marketingtitle', 'theme_essential2');
    $description = get_string('marketingtitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2icon';
    $title = get_string('marketingicon', 'theme_essential2');
    $description = get_string('marketingicondesc', 'theme_essential2');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2image';
    $title = get_string('marketingimage', 'theme_essential2');
    $description = get_string('marketingimagedesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2content';
    $title = get_string('marketingcontent', 'theme_essential2');
    $description = get_string('marketingcontentdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential2');
    $description = get_string('marketingbuttontextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential2');
    $description = get_string('marketingbuttonurldesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing2target';
    $title = get_string('marketingurltarget' , 'theme_essential2');
    $description = get_string('marketingurltargetdesc', 'theme_essential2');
    $target1 = get_string('marketingurltargetself', 'theme_essential2');
    $target2 = get_string('marketingurltargetnew', 'theme_essential2');
    $target3 = get_string('marketingurltargetparent', 'theme_essential2');
    $default = '_blank';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // This is the descriptor for Marketing Spot Three
    $name = 'theme_essential2/marketing3info';
    $heading = get_string('marketing3', 'theme_essential2');
    $information = get_string('marketinginfodesc', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Marketing Spot Three.
    $name = 'theme_essential2/marketing3';
    $title = get_string('marketingtitle', 'theme_essential2');
    $description = get_string('marketingtitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3icon';
    $title = get_string('marketingicon', 'theme_essential2');
    $description = get_string('marketingicondesc', 'theme_essential2');
    $default = 'star';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3image';
    $title = get_string('marketingimage', 'theme_essential2');
    $description = get_string('marketingimagedesc', 'theme_essential2');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3content';
    $title = get_string('marketingcontent', 'theme_essential2');
    $description = get_string('marketingcontentdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3buttontext';
    $title = get_string('marketingbuttontext', 'theme_essential2');
    $description = get_string('marketingbuttontextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3buttonurl';
    $title = get_string('marketingbuttonurl', 'theme_essential2');
    $description = get_string('marketingbuttonurldesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_essential2/marketing3target';
    $title = get_string('marketingurltarget' , 'theme_essential2');
    $description = get_string('marketingurltargetdesc', 'theme_essential2');
    $target1 = get_string('marketingurltargetself', 'theme_essential2');
    $target2 = get_string('marketingurltargetnew', 'theme_essential2');
    $target3 = get_string('marketingurltargetparent', 'theme_essential2');
    $default = '_blank';
    $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /* User Alerts */
    $temp->add(new admin_setting_heading('theme_essential2_alerts', get_string('alertsheadingsub', 'theme_essential2'),
            format_text(get_string('alertsdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // This is the descriptor for Alert One
    $name = 'theme_essential2/alert1info';
    $heading = get_string('alert1', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_essential2/enable1alert';
    $title = get_string('enablealert', 'theme_essential2');
    $description = get_string('enablealertdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_essential2/alert1type';
    $title = get_string('alerttype' , 'theme_essential2');
    $description = get_string('alerttypedesc', 'theme_essential2');
    $alert_info = get_string('alert_info', 'theme_essential2');
    $alert_warning = get_string('alert_warning', 'theme_essential2');
    $alert_general = get_string('alert_general', 'theme_essential2');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_essential2/alert1title';
    $title = get_string('alerttitle', 'theme_essential2');
    $description = get_string('alerttitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_essential2/alert1text';
    $title = get_string('alerttext', 'theme_essential2');
    $description = get_string('alerttextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // This is the descriptor for Alert Two
    $name = 'theme_essential2/alert2info';
    $heading = get_string('alert2', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_essential2/enable2alert';
    $title = get_string('enablealert', 'theme_essential2');
    $description = get_string('enablealertdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_essential2/alert2type';
    $title = get_string('alerttype' , 'theme_essential2');
    $description = get_string('alerttypedesc', 'theme_essential2');
    $alert_info = get_string('alert_info', 'theme_essential2');
    $alert_warning = get_string('alert_warning', 'theme_essential2');
    $alert_general = get_string('alert_general', 'theme_essential2');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_essential2/alert2title';
    $title = get_string('alerttitle', 'theme_essential2');
    $description = get_string('alerttitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_essential2/alert2text';
    $title = get_string('alerttext', 'theme_essential2');
    $description = get_string('alerttextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // This is the descriptor for Alert Three
    $name = 'theme_essential2/alert3info';
    $heading = get_string('alert3', 'theme_essential2');
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);
    
    // Enable Alert
    $name = 'theme_essential2/enable3alert';
    $title = get_string('enablealert', 'theme_essential2');
    $description = get_string('enablealertdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Type.
    $name = 'theme_essential2/alert3type';
    $title = get_string('alerttype' , 'theme_essential2');
    $description = get_string('alerttypedesc', 'theme_essential2');
    $alert_info = get_string('alert_info', 'theme_essential2');
    $alert_warning = get_string('alert_warning', 'theme_essential2');
    $alert_general = get_string('alert_general', 'theme_essential2');
    $default = 'info';
    $choices = array('info'=>$alert_info, 'error'=>$alert_warning, 'success'=>$alert_general);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Title.
    $name = 'theme_essential2/alert3title';
    $title = get_string('alerttitle', 'theme_essential2');
    $description = get_string('alerttitledesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Alert Text.
    $name = 'theme_essential2/alert3text';
    $title = get_string('alerttext', 'theme_essential2');
    $description = get_string('alerttextdesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $ADMIN->add('theme_essential2', $temp);

    /* Slideshow Widget Settings */
    $temp = new admin_settingpage('theme_essential2_slideshow', get_string('slideshowheading', 'theme_essential2'));
    $temp->add(new admin_setting_heading('theme_essential2_slideshow', get_string('slideshowheadingsub', 'theme_essential2'),
            format_text(get_string('slideshowdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));

    // Toggle Slideshow.
    $name = 'theme_essential2/toggleslideshow';
    $title = get_string('toggleslideshow' , 'theme_essential2');
    $description = get_string('toggleslideshowdesc', 'theme_essential2');
    $alwaysdisplay = get_string('alwaysdisplay', 'theme_essential2');
    $displaybeforelogin = get_string('displaybeforelogin', 'theme_essential2');
    $displayafterlogin = get_string('displayafterlogin', 'theme_essential2');
    $dontdisplay = get_string('dontdisplay', 'theme_essential2');
    $default = 1;
    $choices = array(1 => $alwaysdisplay, 2 => $displaybeforelogin, 3 => $displayafterlogin, 0 => $dontdisplay);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Number of slides.
    $name = 'theme_essential2/numberofslides';
    $title = get_string('numberofslides', 'theme_essential2');
    $description = get_string('numberofslides_desc', 'theme_essential2');
    $default = 4;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16'
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    // Hide slideshow on phones.
    $name = 'theme_essential2/hideontablet';
    $title = get_string('hideontablet' , 'theme_essential2');
    $description = get_string('hideontabletdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Hide slideshow on tablet.
    $name = 'theme_essential2/hideonphone';
    $title = get_string('hideonphone' , 'theme_essential2');
    $description = get_string('hideonphonedesc', 'theme_essential2');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide interval.
    $name = 'theme_essential2/slideinterval';
    $title = get_string('slideinterval', 'theme_essential2');
    $description = get_string('slideintervaldesc', 'theme_essential2');
    $default = '5000';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide Text colour setting.
    $name = 'theme_essential2/slidecolor';
    $title = get_string('slidecolor', 'theme_essential2');
    $description = get_string('slidecolordesc', 'theme_essential2');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Show caption below the image.
    $name = 'theme_essential2/slidecaptionbelow';
    $title = get_string('slidecaptionbelow' , 'theme_essential2');
    $description = get_string('slidecaptionbelowdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide button colour setting.
    $name = 'theme_essential2/slidebuttoncolor';
    $title = get_string('slidebuttoncolor', 'theme_essential2');
    $description = get_string('slidebuttoncolordesc', 'theme_essential2');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Slide button hover colour setting.
    $name = 'theme_essential2/slidebuttonhovercolor';
    $title = get_string('slidebuttonhovercolor', 'theme_essential2');
    $description = get_string('slidebuttonhovercolordesc', 'theme_essential2');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $numberofslides = get_config('theme_essential2', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {
        // This is the descriptor for Slide One
        $name = 'theme_essential2/slide'.$i.'info';
        $heading = get_string('slideno', 'theme_essential2', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_essential2', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);

        // Title.
        $name = 'theme_essential2/slide'.$i;
        $title = get_string('slidetitle', 'theme_essential2');
        $description = get_string('slidetitledesc', 'theme_essential2');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Image.
        $name = 'theme_essential2/slide'.$i.'image';
        $title = get_string('slideimage', 'theme_essential2');
        $description = get_string('slideimagedesc', 'theme_essential2');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide'.$i.'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Caption text.
        $name = 'theme_essential2/slide'.$i.'caption';
        $title = get_string('slidecaption', 'theme_essential2');
        $description = get_string('slidecaptiondesc', 'theme_essential2');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default, PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // URL.
        $name = 'theme_essential2/slide'.$i.'url';
        $title = get_string('slideurl', 'theme_essential2');
        $description = get_string('slideurldesc', 'theme_essential2');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // URL target.
        $name = 'theme_essential2/slide'.$i.'target';
        $title = get_string('slideurltarget' , 'theme_essential2');
        $description = get_string('slideurltargetdesc', 'theme_essential2');
        $target1 = get_string('slideurltargetself', 'theme_essential2');
        $target2 = get_string('slideurltargetnew', 'theme_essential2');
        $target3 = get_string('slideurltargetparent', 'theme_essential2');
        $default = '_blank';
        $choices = array('_self'=>$target1, '_blank'=>$target2, '_parent'=>$target3);
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    }

    $ADMIN->add('theme_essential2', $temp);
    
     /* Category Settings */
    $temp = new admin_settingpage('theme_essential2_categoryicon', get_string('categoryiconheading', 'theme_essential2'));
    $temp->add(new admin_setting_heading('theme_essential2_categoryicon', get_string('categoryiconheadingsub', 'theme_essential2'),
            format_text(get_string('categoryicondesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // Category Icons.
    $name = 'theme_essential2/enablecategoryicon';
    $title = get_string('enablecategoryicon', 'theme_essential2');
    $description = get_string('enablecategoryicondesc', 'theme_essential2');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // We only want to output category icon options if the parent setting is enabled
    if(get_config('theme_essential2', 'enablecategoryicon')) {
    
        // Default Icon Selector.
        $name = 'theme_essential2/defaultcategoryicon';
        $title = get_string('defaultcategoryicon', 'theme_essential2');
        $description = get_string('defaultcategoryicondesc', 'theme_essential2');
        $default = 'folder-open';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
    
        // Category Icons.
        $name = 'theme_essential2/enablecustomcategoryicon';
        $title = get_string('enablecustomcategoryicon', 'theme_essential2');
        $description = get_string('enablecustomcategoryicondesc', 'theme_essential2');
        $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
        
        if(get_config('theme_essential2', 'enablecustomcategoryicon')) {
        
            // This is the descriptor for Custom Category Icons
            $name = 'theme_essential2/categoryiconinfo';
            $heading = get_string('categoryiconinfo', 'theme_essential2');
            $information = get_string('categoryiconinfodesc', 'theme_essential2');
            $setting = new admin_setting_heading($name, $heading, $information);
            $temp->add($setting);
            
            // Get the default category icon.
            $defaultcategoryicon = get_config('theme_essential2', 'defaultcategoryicon');
            if(empty($defaultcategoryicon)) {
                $defaultcategoryicon = 'folder-open';
            }
        
            // Get all category IDs and their pretty names
            require_once($CFG->libdir. '/coursecatlib.php');
            $coursecats = coursecat::make_categories_list();
            
            // Go through all categories and create the necessary settings
            foreach($coursecats as $key => $value) {
            
                // Category Icons for each category.
                $name = 'theme_essential2/categoryicon';
                $title = $value;
                $description = get_string('categoryiconcategory', 'theme_essential2', array('category' => $value));
                $default = $defaultcategoryicon;
                $setting = new admin_setting_configtext($name.$key, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $temp->add($setting);
            }
            unset($coursecats);
        }
    }

    $ADMIN->add('theme_essential2', $temp);

    /* Analytics Settings */
    $temp = new admin_settingpage('theme_essential2_analytics', get_string('analyticsheading', 'theme_essential2'));
    $temp->add(new admin_setting_heading('theme_essential2_analytics', get_string('analyticsheadingsub', 'theme_essential2'),
            format_text(get_string('analyticsdesc' , 'theme_essential2'), FORMAT_MARKDOWN)));
    
    // Enable Analytics
    $name = 'theme_essential2/useanalytics';
    $title = get_string('useanalytics', 'theme_essential2');
    $description = get_string('useanalyticsdesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Google Analytics ID
    $name = 'theme_essential2/analyticsid';
    $title = get_string('analyticsid', 'theme_essential2');
    $description = get_string('analyticsiddesc', 'theme_essential2');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Clean Analytics URL
    $name = 'theme_essential2/analyticsclean';
    $title = get_string('analyticsclean', 'theme_essential2');
    $description = get_string('analyticscleandesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Track Admins
    $name = 'theme_essential2/analyticsadmin';
    $title = get_string('analyticsadmin', 'theme_essential2');
    $description = get_string('analyticsadmindesc', 'theme_essential2');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
        
    $ADMIN->add('theme_essential2', $temp);
