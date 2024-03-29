<?php // $Id: version.php,v 1.3 2012-11-02 09:14:47 vf Exp $
/**
 * Code fragment to define the version of magtest
 * This fragment is called by moodle_needs_upgrading() and /admin/index.php
 *
 * @author 
 * @version $Id: version.php,v 1.3 2012-11-02 09:14:47 vf Exp $
 * @package magtest
 **/

$module->version  = 2012103100;  // The current module version (Date: YYYYMMDDXX)
$module->requires = 2012062500;  // Requires this Moodle version
$module->cron     = 0;           // Period for cron to check this module (secs)
$module->component = 'mod_magtest';   // Full name of the plugin (used for diagnostics)
$module->maturity = MATURITY_RC;
$module->release = '2.3.0 (Build 2012103100)';


