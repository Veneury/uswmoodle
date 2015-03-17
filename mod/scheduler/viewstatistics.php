<?php

/**
 * Statistics report for the scheduler
 *
 * @package    mod
 * @subpackage scheduler
 * @copyright  2011 Henning Bostelmann and others (see README.txt)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

// a function utility for sorting stat results
function byName($a, $b){
    return strcasecmp($a[0],$b[0]);
}

// precompute groups in case partial popuation is considered by grouping

$groups = groups_get_all_groups($COURSE->id, 0, $cm->groupingid);
$usergroups = array_keys($groups);

// Display navigation tabs.

$taburl = new moodle_url('/mod/scheduler/view.php', array('id' => $scheduler->cmid));
echo $output->teacherview_tabs($scheduler, $taburl, $subpage);

//display correct type of statistics by request

$attendees = $scheduler->get_possible_attendees($usergroups);

switch ($subpage) {
    case 'overall':
        $sql = '
            SELECT
            COUNT(DISTINCT(a.studentid))
            FROM
            {scheduler_slots} s,
            {scheduler_appointment} a
            WHERE
            s.id = a.slotid AND
            s.schedulerid = ? AND
            a.attended = 1
            ';
        $attended = $DB->count_records_sql($sql, array($scheduler->id));

        $sql = '
            SELECT
            COUNT(DISTINCT(a.studentid))
            FROM
            {scheduler_slots} s,
            {scheduler_appointment} a
            WHERE
            s.id = a.slotid AND
            s.schedulerid = ? AND
            a.attended = 0
            ';
        $registered = $DB->count_records_sql($sql, array($scheduler->id));

        $sql = '
            SELECT
            COUNT(DISTINCT(s.id))
            FROM
            {scheduler_slots} s
            LEFT JOIN
            {scheduler_appointment} a
            ON
            s.id = a.slotid
            WHERE
            s.schedulerid = ? AND
            s.teacherid = ? AND
            a.attended IS NULL
            ';
        $freeowned = $DB->count_records_sql($sql, array($scheduler->id, $USER->id));

        $sql = '
            SELECT
            COUNT(DISTINCT(s.id))
            FROM
            {scheduler_slots} s
            LEFT JOIN
            {scheduler_appointment} a
            ON
            s.id = a.slotid
            WHERE
            s.schedulerid = ? AND
            s.teacherid != ? AND
            a.attended IS NULL
            ';
        $freenotowned = $DB->count_records_sql($sql, array($scheduler->id, $USER->id));

        $allattendees = ($attendees) ? count($attendees) : 0 ;

        $str = '<h3>'.get_string('attendable', 'scheduler').'</h3>';
        $str .= '<strong>'.get_string('attendablelbl', 'scheduler').'</strong>: ' . $allattendees . '<br/>';
        $str .= '<h3>'.get_string('attended', 'scheduler').'</h3>';
        $str .= '<strong>'.get_string('attendedlbl', 'scheduler').'</strong>: ' . $attended . '<br/><br/>';
        $str .= '<h3>'.get_string('unattended', 'scheduler').'</h3>';
        $str .= '<strong>'.get_string('registeredlbl', 'scheduler').'</strong>: ' . $registered . '<br/>';
        $str .= '<strong>'.get_string('unregisteredlbl', 'scheduler').'</strong>: ' . ($allattendees - $registered - $attended) . '<br/>'; //BUGFIX
        $str .= '<h3>'.get_string('availableslots', 'scheduler').'</h3>';
        $str .= '<strong>'.get_string('availableslotsowned', 'scheduler').'</strong>: ' . $freeowned . '<br/>';
        $str .= '<strong>'.get_string('availableslotsnotowned', 'scheduler').'</strong>: ' . $freenotowned . '<br/>';
        $str .= '<strong>'.get_string('availableslotsall', 'scheduler').'</strong>: ' . ($freeowned + $freenotowned) . '<br/>';

        echo $OUTPUT->box($str);

        break;
    case 'studentbreakdown':
        //display the amount of time each student has received

        if (!empty($attendees)) {
        	$table = new html_table();
            $table->head  = array (get_string('student', 'scheduler'), get_string('duration', 'scheduler'));
            $table->align = array ('LEFT', 'CENTER');
            $table->width = '70%';
            $table->data = array();
            $sql = '
                SELECT
                a.studentid,
                SUM(s.duration) as totaltime
                FROM
                {scheduler_slots} s,
                {scheduler_appointment} a
                WHERE
                s.id = a.slotid AND
                a.studentid > 0 AND
                s.schedulerid = ?
                GROUP BY
                a.studentid
                ';
            if ($statrecords = $DB->get_records_sql($sql, array($scheduler->id))) {
                foreach($statrecords as $aRecord){
                    $table->data[] = array (fullname($attendees[$aRecord->studentid]), $aRecord->totaltime); // BUGFIX
                }

                uasort($table->data, 'byName');
            }
            echo html_writer::table($table);
        }
        else{
            echo $OUTPUT->box(get_string('nostudents', 'scheduler'), 'center', '70%');
        }
        break;
    case 'staffbreakdown':
        //display break down by member of staff
        $sql = '
            SELECT
            s.teacherid,
            SUM(s.duration) as totaltime
            FROM
            {scheduler_slots} s
            LEFT JOIN
            {scheduler_appointment} a
            ON
            a.slotid = s.id
            WHERE
            s.schedulerid = ? AND

            a.studentid IS NOT NULL
            GROUP BY
            s.teacherid
            ';
        if ($statrecords = $DB->get_records_sql($sql, array($scheduler->id))) {
        	$table = new html_table();
            $table->width = '70%';
            $table->head  = array (s($scheduler->get_teacher_name()), get_string('cumulatedduration', 'scheduler'));
            $table->align = array ('LEFT', 'CENTER');
            foreach($statrecords as $aRecord){
                $aTeacher = $DB->get_record('user', array('id'=>$aRecord->teacherid));
                $table->data[] = array (fullname($aTeacher), $aRecord->totaltime);
            }
            uasort($table->data, 'byName');
            echo html_writer::table($table);
        }
        break;
    case 'lengthbreakdown':
        //display by number of atendees to one member of staff
        $sql = '
            SELECT
            s.starttime,
            COUNT(*) as groupsize,
            MAX(s.duration) as duration
            FROM
            {scheduler_slots} s
            LEFT JOIN
            {scheduler_appointment} a
            ON
            a.slotid = s.id
            WHERE
            a.studentid IS NOT NULL AND
            schedulerid = ?
            GROUP BY
            s.starttime
            ORDER BY
            groupsize DESC
            ';
        if ($groupslots = $DB->get_records_sql($sql, array($scheduler->id))){
        	$table = new html_table();
            $table->head  = array (get_string('duration', 'scheduler'), get_string('appointments', 'scheduler'));
            $table->align = array ('LEFT', 'CENTER');
            $table->width = '70%';

            $durationcount = array();
            foreach($groupslots as $slot) {
                if (array_key_exists($slot->duration, $durationcount)) {
                    $durationcount[$slot->duration] ++;
                } else {
                    $durationcount[$slot->duration] = 1;
                }
            }
            foreach ($durationcount as $key => $duration) {
                $table->data[] = array ($key, $duration);
            }
            echo html_writer::table($table);
        }
        break;
    case 'groupbreakdown':
        //display by number of atendees to one member of staff
        $sql = "
            SELECT
            s.starttime,
            COUNT(*) as groupsize,
            MAX(s.duration) as duration
            FROM
            {scheduler_slots} s
            LEFT JOIN
            {scheduler_appointment} a
            ON
            a.slotid = s.id
            WHERE
            a.studentid IS NOT NULL AND
            schedulerid = ?
            GROUP BY
            s.starttime
            ORDER BY
            groupsize DESC
            ";
        if ($groupslots = $DB->get_records_sql($sql,array($scheduler->id))){
        	$table = new html_table();
            $table->head  = array (get_string('groupsize', 'scheduler'), get_string('occurrences', 'scheduler'), get_string('cumulatedduration', 'scheduler'));
            $table->align = array ('LEFT', 'CENTER', 'CENTER');
            $table->width = '70%';
            $grouprows = array();
            foreach($groupslots as $aGroup){
                if (!array_key_exists($aGroup->groupsize, $grouprows)){
                    $grouprows[$aGroup->groupsize] = new stdClass();
                    $grouprows[$aGroup->groupsize]->occurrences = 0;
                    $grouprows[$aGroup->groupsize]->duration = 0;
                }
                $grouprows[$aGroup->groupsize]->occurrences++;
                $grouprows[$aGroup->groupsize]->duration += $aGroup->duration;
            }
            foreach(array_keys($grouprows) as $aGroupSize){
                $table->data[] = array ($aGroupSize,$grouprows[$aGroupSize]->occurrences, $grouprows[$aGroupSize]->duration);
            }
            echo html_writer::table($table);
        }
}
echo '<br/>';
echo $OUTPUT->continue_button("$CFG->wwwroot/mod/scheduler/view.php?id=".$cm->id);
/// Finish the page
echo $OUTPUT->footer($course);
exit;
