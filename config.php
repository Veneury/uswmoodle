<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'uswmoodle27';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'R0e!m4nn';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://localhost/uswmoodle27';
$CFG->dataroot  = '/var/www/uswmoodle27data';
$CFG->admin     = 'admin';

$CFG->passwordsaltmain = 'zPVa):%QnN_Gvf7]s;a@TuK:';

$CFG->directorypermissions = 0777;

require_once(dirname(__FILE__) . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
