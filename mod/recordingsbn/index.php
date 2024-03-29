<?php
/**
 * View and administrate BigBlueButton playback recordings
 *
 * @package   mod_recordingsbn
 * @author    Jesus Federico  (jesus [at] blindsidenetworks [dt] com)
 * @copyright 2011-2014 Blindside Networks Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = required_param('id', PARAM_INT);   // course

if (! $course = $DB->get_record('course', array('id' => $id))) {
    error('Course ID is incorrect');
}

require_course_login($course);

if ( $CFG->version < '2013111800' ) {
    //This is valid before v2.6
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
} else {
    //This is valid after v2.6
    $context = context_module::instance($cm->id);
}


/// Print the header

$PAGE->set_url('/mod/recordingsbn/index.php', array('id' => $id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

// Output starts here
echo $OUTPUT->header();

/// Get all the appropriate data

if (! $recordingsbns = get_all_instances_in_course('recordingsbn', $course)) {
    echo $OUTPUT->heading(get_string('norecordingsbns', 'recordingsbn'), 2);
    echo $OUTPUT->continue_button("view.php?id=$course->id");
    echo $OUTPUT->footer();
    die();
}

/// Print the list of instances (your module will probably extend this)

$timenow  = time();
$strname  = get_string('name');
$strweek  = get_string('week');
$strtopic = get_string('topic');

$table = new html_table();
if ($course->format == 'weeks') {
    $table->head  = array ($strweek, $strname);
    $table->align = array ('center', 'left');
} else if ($course->format == 'topics') {
    $table->head  = array ($strtopic, $strname);
    $table->align = array ('center', 'left', 'left', 'left');
} else {
    $table->head  = array ($strname);
    $table->align = array ('left', 'left', 'left');
}

foreach ($recordingsbns as $recordingsbn) {
    if (!$recordingsbn->visible) {
        //Show dimmed if the mod is hidden
        $link = '<a class="dimmed" href="view.php?id='.$recordingsbn->coursemodule.'">'.format_string($recordingsbn->name).'</a>';
    } else {
        //Show normal if the mod is visible
        $link = '<a href="view.php?id='.$recordingsbn->coursemodule.'">'.format_string($recordingsbn->name).'</a>';
    }

    if ($course->format == 'weeks' or $course->format == 'topics') {
        $table->data[] = array ($recordingsbn->section, $link);
    } else {
        $table->data[] = array ($link);
    }
}

echo $OUTPUT->heading(get_string('modulenameplural', 'recordingsbn'), 2);
print_table($table);

/// Finish the page

echo $OUTPUT->footer();
