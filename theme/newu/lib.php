<?php

/**
 * get_performance_output() override get_peformance_info()
 *  in moodlelib.php. Returns a string
 * values ready for use.
 *
 * @return string
 */
function newu_performance_output($param) {
	
    $html = '<div class="performanceinfo"><ul>';
	if (isset($param['realtime'])) $html .= '<li><a class="red" href="#"><var>'.$param['realtime'].' secs</var><span>Load Time</span></a></li>';
	if (isset($param['memory_total'])) $html .= '<li><a class="orange" href="#"><var>'.display_size($param['memory_total']).'</var><span>Memory Used</span></a></li>';
    if (isset($param['includecount'])) $html .= '<li><a class="blue" href="#"><var>'.$param['includecount'].' Files </var><span>Included</span></a></li>';
    if (isset($param['dbqueries'])) $html .= '<li><a class="purple" href="#"><var>'.$param['dbqueries'].' </var><span>DB Read/Write</span></a></li>';
    $html .= '</ul></div>';

    return $html;
}

/**
 * Makes our changes to the CSS
 *
 * @param string $css
 * @param theme_config $theme
 * @return string
 */
function newu_process_css($css, $theme) {
global $USER;

    if (!empty($theme->settings->backgroundcolor)) {
        $backgroundcolor = $theme->settings->backgroundcolor;
    } else {
        $backgroundcolor = null;
    }
    $css = newu_set_backgroundcolor($css, $backgroundcolor);
    
    if (!empty($theme->settings->logourl)) {
        $logourl = $theme->settings->logourl;
    } else {
        $logourl = null;
    }
    $css = newu_set_logourl($css, $logourl);
    
    if (!empty($theme->settings->menubackgroundcolor)) {
        $menubackgroundcolor = $theme->settings->menubackgroundcolor;
    } else {
        $menubackgroundcolor = null;
    }
    $css = newu_set_menubackgroundcolor($css, $menubackgroundcolor);

    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = newu_set_customcss($css, $customcss);

    if (!empty($USER->profile['background'])) {
        $userbackground = $USER->profile['background'];
    } else {
        $userbackground = null;
    }
    $css = newu_set_userbackground($css, $userbackground);
    
    if (!empty($USER->profile['fontcolour'])) {
        $userfontcolour = $USER->profile['fontcolour'];
    } else {
        $userfontcolour = null;
    }
    $css = newu_set_userfontcolour($css, $userfontcolour);
    
    if (!empty($USER->profile['linkcolour'])) {
        $userlinkcolour = $USER->profile['linkcolour'];
    } else {
        $userlinkcolour = null;
    }
    $css = newu_set_userlinkcolour($css, $userlinkcolour);    

    return $css;
}

/**
 * Sets the background colour variable in CSS
 *
 * @param string $css
 * @param mixed $backgroundcolor
 * @return string
 */
function newu_set_backgroundcolor($css, $backgroundcolor) {
    $tag = '[[setting:backgroundcolor]]';
    $replacement = $backgroundcolor;
    if (is_null($replacement)) {
        $replacement = '#be0f34';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function newu_set_logourl($css, $logourl) {
    global $OUTPUT;
    $tag = '[[setting:logourl]]';
    if (is_null($logourl)) {
        $replacement = $OUTPUT->pix_url('usw1', 'theme'); //Default image
    }
    else {
        $protocol = '://';
        $ntp = strpos($logourl, $protocol); // Check to see if a networking protocol is used
        if($ntp === false) { // No networking protocol used
            $relative = '/';
            $rel = strpos($logourl, $relative); // Check to see if a relative path is used
            if($rel !== 0) { // Doesn't start with a slash
                $replacement = $OUTPUT->pix_url("$logourl", 'theme'); // Using Moodle output
            } else {
                $replacement = $logourl;
            }
        } else {
            $replacement = $logourl;
        }
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the menu background colour variable in CSS
 *
 * @param string $css
 * @param mixed $menubackgroundcolor
 * @return string
 */
function newu_set_menubackgroundcolor($css, $menubackgroundcolor) {
    $tag = '[[setting:menubackgroundcolor]]';
    $replacement = $menubackgroundcolor;
    if (is_null($replacement)) {
        $replacement = '#c4002e';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the user defined background colour variable in CSS
 *
 * @param string $css
 * @param mixed $userbackground
 * @return string
 */
function newu_set_userbackground($css, $userbackground) {
    $tag = '[[setting:userbackground]]';
    $replacement = $userbackground;
    if (is_null($replacement)) {
        $replacement = '#fff';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the user defined font colour variable in CSS
 *
 * @param string $css
 * @param mixed $userfontcolour
 * @return string
 */
function newu_set_userfontcolour($css, $userfontcolour) {
    $tag = '[[setting:userfontcolour]]';
    $replacement = $userfontcolour;
    if (is_null($replacement)) {
        $replacement = '#212121';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the user defined link colour variable in CSS
 *
 * @param string $css
 * @param mixed $userlinkcolour
 * @return string
 */
function newu_set_userlinkcolour($css, $userlinkcolour) {
    $tag = '[[setting:userlinkcolour]]';
    $replacement = $userlinkcolour;
    if (is_null($replacement)) {
        $replacement = '#1D8AC3';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the custom css variable in CSS
 *
 * @param string $css
 * @param mixed $customcss
 * @return string
 */
function newu_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Adds the JavaScript for the edit buttons to the page.
 *
 * The edit buttoniser is a YUI moodle module that is located in
 *     theme/newu/yui/editbuttons/editbuttons.js
 *
 * @param moodle_page $page 
 */
function newu_initialise_editbuttons(moodle_page $page) {
    $page->requires->string_for_js('edit', 'moodle');
    $page->requires->yui_module('moodle-theme_newu-editbuttons', 'M.theme_newu.initEditButtons');
}

function newu_initialise_awesomebar(moodle_page $page) {
    $page->requires->yui_module('moodle-theme_newu-awesomebar', 'M.theme_newu.initAwesomeBar');
}

function newu_require_course_login($courseorid, $autologinguest = true, $cm = NULL, $setwantsurltome = true, $preventredirect = true) {
    global $CFG, $SITE;
    $issite = (is_object($courseorid) and $courseorid->id == SITEID)
          or (!is_object($courseorid) and $courseorid == SITEID);
    if ($issite && !empty($cm) && !($cm instanceof cm_info)) {
        // note: nearly all pages call get_fast_modinfo anyway and it does not make any
        // db queries so this is not really a performance concern, however it is obviously
        // better if you use get_fast_modinfo to get the cm before calling this.
        if (is_object($courseorid)) {
            $course = $courseorid;
        } else {
            $course = clone($SITE);
        }
        $modinfo = get_fast_modinfo($course);
        $cm = $modinfo->get_cm($cm->id);
    }
    if (!empty($CFG->forcelogin)) {
        // login required for both SITE and courses
        newu_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);

    } else if ($issite && !empty($cm) and !$cm->uservisible) {
        // always login for hidden activities
        newu_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);

    } else if ($issite) {
              //login for SITE not required
        if ($cm and empty($cm->visible)) {
            // hidden activities are not accessible without login
            newu_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
        } else if ($cm and !empty($CFG->enablegroupmembersonly) and $cm->groupmembersonly) {
            // not-logged-in users do not have any group membership
            newu_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
        } else {
            // We still need to instatiate PAGE vars properly so that things
            // that rely on it like navigation function correctly.
            if (!empty($courseorid)) {
                if (is_object($courseorid)) {
                    $course = $courseorid;
                } else {
                    $course = clone($SITE);
                }
                if ($cm) {
                    if ($cm->course != $course->id) {
                        throw new coding_exception('course and cm parameters in require_course_login() call do not match!!');
                    }
                }
            }
            return;
        }

    } else {
        // course login always required
        newu_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
    }
}

function newu_require_login($courseorid = NULL, $autologinguest = true, $cm = NULL, $setwantsurltome = true, $preventredirect = false) {
    global $CFG, $SESSION, $USER, $FULLME, $DB;

    // setup global $COURSE, themes, language and locale
    if (!empty($courseorid)) {
        if (is_object($courseorid)) {
            $course = $courseorid;
        } else if ($courseorid == SITEID) {
            $course = clone($SITE);
        } else {
            $course = $DB->get_record('course', array('id' => $courseorid), '*', MUST_EXIST);
        }
        if ($cm) {
            if ($cm->course != $course->id) {
                throw new coding_exception('course and cm parameters in require_login() call do not match!!');
            }
            // make sure we have a $cm from get_fast_modinfo as this contains activity access details
            if (!($cm instanceof cm_info)) {
                // note: nearly all pages call get_fast_modinfo anyway and it does not make any
                // db queries so this is not really a performance concern, however it is obviously
                // better if you use get_fast_modinfo to get the cm before calling this.
                $modinfo = get_fast_modinfo($course);
                $cm = $modinfo->get_cm($cm->id);
            }
        }
    } else {
        // do not touch global $COURSE via $PAGE->set_course(),
        // the reasons is we need to be able to call require_login() at any time!!
        $course = $SITE;
        if ($cm) {
            throw new coding_exception('cm parameter in require_login() requires valid course parameter!');
        }
    }

    // If the user is not even logged in yet then make sure they are
    if (!isloggedin()) {
        if ($autologinguest and !empty($CFG->guestloginbutton) and !empty($CFG->autologinguests)) {
            if (!$guest = get_complete_user_data('id', $CFG->siteguest)) {
                // misconfigured site guest, just redirect to login page
                redirect(get_login_url());
                exit; // never reached
            }
            $lang = isset($SESSION->lang) ? $SESSION->lang : $CFG->lang;
            complete_user_login($guest);
            $USER->autologinguest = true;
            $SESSION->lang = $lang;
        } else {
            //NOTE: $USER->site check was obsoleted by session test cookie,
            //      $USER->confirmed test is in login/index.php
            if ($preventredirect) {
                throw new require_login_exception('You are not logged in');
            }

            if ($setwantsurltome) {
                // TODO: switch to PAGE->url
                $SESSION->wantsurl = $FULLME;
            }
            if (!empty($_SERVER['HTTP_REFERER'])) {
                $SESSION->fromurl  = $_SERVER['HTTP_REFERER'];
            }
            redirect(get_login_url());
            exit; // never reached
        }
    }

    // loginas as redirection if needed
    if ($course->id != SITEID and session_is_loggedinas()) {
        if ($USER->loginascontext->contextlevel == CONTEXT_COURSE) {
            if ($USER->loginascontext->instanceid != $course->id) {
                print_error('loginasonecourse', '', $CFG->wwwroot.'/course/view.php?id='.$USER->loginascontext->instanceid);
            }
        }
    }

    // check whether the user should be changing password (but only if it is REALLY them)
    if (get_user_preferences('auth_forcepasswordchange') && !session_is_loggedinas()) {
        $userauth = get_auth_plugin($USER->auth);
        if ($userauth->can_change_password() and !$preventredirect) {
            $SESSION->wantsurl = $FULLME;
            if ($changeurl = $userauth->change_password_url()) {
                //use plugin custom url
                redirect($changeurl);
            } else {
                //use moodle internal method
                if (empty($CFG->loginhttps)) {
                    redirect($CFG->wwwroot .'/login/change_password.php');
                } else {
                    $wwwroot = str_replace('http:','https:', $CFG->wwwroot);
                    redirect($wwwroot .'/login/change_password.php');
                }
            }
        } else {
            print_error('nopasswordchangeforced', 'auth');
        }
    }

    // Check that the user account is properly set up
    if (user_not_fully_set_up($USER)) {
        if ($preventredirect) {
            throw new require_login_exception('User not fully set-up');
        }
        $SESSION->wantsurl = $FULLME;
        redirect($CFG->wwwroot .'/user/edit.php?id='. $USER->id .'&amp;course='. SITEID);
    }

    // Make sure the USER has a sesskey set up. Used for CSRF protection.
    sesskey();

    // Do not bother admins with any formalities
    if (is_siteadmin()) {
        return;
    }

    // Fetch the system context, the course context, and prefetch its child contexts
    $sysctx = get_context_instance(CONTEXT_SYSTEM);
    $coursecontext = get_context_instance(CONTEXT_COURSE, $course->id, MUST_EXIST);
    if ($cm) {
        $cmcontext = get_context_instance(CONTEXT_MODULE, $cm->id, MUST_EXIST);
    } else {
        $cmcontext = null;
    }

    // make sure the course itself is not hidden
    if ($course->id == SITEID) {
        // frontpage can not be hidden
    } else {
        if (is_role_switched($course->id)) {
            // when switching roles ignore the hidden flag - user had to be in course to do the switch
        } else {
            if (!$course->visible and !has_capability('moodle/course:viewhiddencourses', $coursecontext)) {
                // originally there was also test of parent category visibility,
                // BUT is was very slow in complex queries involving "my courses"
                // now it is also possible to simply hide all courses user is not enrolled in :-)
                if ($preventredirect) {
                    throw new require_login_exception('Course is hidden');
                }
                notice(get_string('coursehidden'), $CFG->wwwroot .'/');
            }
        }
    }

    // is the user enrolled?
    if ($course->id == SITEID) {
        // everybody is enrolled on the frontpage

    } else {
        if (session_is_loggedinas()) {
            // Make sure the REAL person can access this course first
            $realuser = session_get_realuser();
            if (!is_enrolled($coursecontext, $realuser->id, '', true) and !is_viewing($coursecontext, $realuser->id) and !is_siteadmin($realuser->id)) {
                if ($preventredirect) {
                    throw new require_login_exception('Invalid course login-as access');
                }
                echo $OUTPUT->header();
                notice(get_string('studentnotallowed', '', fullname($USER, true)), $CFG->wwwroot .'/');
            }
        }

        // very simple enrolment caching - changes in course setting are not reflected immediately
        if (!isset($USER->enrol)) {
            $USER->enrol = array();
            $USER->enrol['enrolled'] = array();
            $USER->enrol['tempguest'] = array();
        }

        $access = false;

        if (is_viewing($coursecontext, $USER)) {
            // ok, no need to mess with enrol
            $access = true;

        } else {
            if (isset($USER->enrol['enrolled'][$course->id])) {
                if ($USER->enrol['enrolled'][$course->id] == 0) {
                    $access = true;
                } else if ($USER->enrol['enrolled'][$course->id] > time()) {
                    $access = true;
                } else {
                    //expired
                    unset($USER->enrol['enrolled'][$course->id]);
                }
            }
            if (isset($USER->enrol['tempguest'][$course->id])) {
                if ($USER->enrol['tempguest'][$course->id] == 0) {
                    $access = true;
                } else if ($USER->enrol['tempguest'][$course->id] > time()) {
                    $access = true;
                } else {
                    //expired
                    unset($USER->enrol['tempguest'][$course->id]);
                    $USER->access = remove_temp_roles($coursecontext, $USER->access);
                }
            }

            if ($access) {
                // cache ok
            } else if (is_enrolled($coursecontext, $USER, '', true)) {
                // active participants may always access
                // TODO: refactor this into some new function
                $now = time();
                $sql = "SELECT MAX(ue.timeend)
                          FROM {user_enrolments} ue
                          JOIN {enrol} e ON (e.id = ue.enrolid AND e.courseid = :courseid)
                          JOIN {user} u ON u.id = ue.userid
                         WHERE ue.userid = :userid AND ue.status = :active AND e.status = :enabled AND u.deleted = 0
                               AND ue.timestart < :now1 AND (ue.timeend = 0 OR ue.timeend > :now2)";
                $params = array('enabled'=>ENROL_INSTANCE_ENABLED, 'active'=>ENROL_USER_ACTIVE,
                                'userid'=>$USER->id, 'courseid'=>$coursecontext->instanceid, 'now1'=>$now, 'now2'=>$now);
                $until = $DB->get_field_sql($sql, $params);
                if (!$until or $until > time() + ENROL_REQUIRE_LOGIN_CACHE_PERIOD) {
                    $until = time() + ENROL_REQUIRE_LOGIN_CACHE_PERIOD;
                }

                $USER->enrol['enrolled'][$course->id] = $until;
                $access = true;

                // remove traces of previous temp guest access
                if(function_exists('remove_temp_course_roles')) {
                    if ($coursecontext->instanceid !== SITEID) {
                        remove_temp_course_roles($coursecontext);
                    }
                } else {
                    $USER->access = remove_temp_roles($coursecontext, $USER->access);
                }

            } else {
                $instances = $DB->get_records('enrol', array('courseid'=>$course->id, 'status'=>ENROL_INSTANCE_ENABLED), 'sortorder, id ASC');
                $enrols = enrol_get_plugins(true);
                // first ask all enabled enrol instances in course if they want to auto enrol user
                foreach($instances as $instance) {
                    if (!isset($enrols[$instance->enrol])) {
                        continue;
                    }
                    // Get a duration for the guestaccess, a timestamp in the future or false.
                    $until = $enrols[$instance->enrol]->try_autoenrol($instance);
                    if ($until !== false) {
                        $USER->enrol['enrolled'][$course->id] = $until;
                        $USER->access = remove_temp_roles($coursecontext, $USER->access);
                        $access = true;
                        break;
                    }
                }
                // if not enrolled yet try to gain temporary guest access
                if (!$access) {
                    foreach($instances as $instance) {
                        if (!isset($enrols[$instance->enrol])) {
                            continue;
                        }
                        // Get a duration for the guestaccess, a timestamp in the future or false.
                        $until = $enrols[$instance->enrol]->try_guestaccess($instance);
                        if ($until !== false) {
                            $USER->enrol['tempguest'][$course->id] = $until;
                            $access = true;
                            break;
                        }
                    }
                }
            }
        }

        if (!$access) {
            if ($preventredirect) {
                throw new require_login_exception('Not enrolled');
            }
            $SESSION->wantsurl = $FULLME;
            redirect($CFG->wwwroot .'/enrol/index.php?id='. $course->id);
        }
    }

    // Check visibility of activity to current user; includes visible flag, groupmembersonly,
    // conditional availability, etc
    if ($cm && !$cm->uservisible) {
        if ($preventredirect) {
            throw new require_login_exception('Activity is hidden');
        }
        redirect($CFG->wwwroot, get_string('activityiscurrentlyhidden'));
    }
}


class newu_expand_navigation extends global_navigation {

    /** @var array */
    protected $expandable = array();

    /**
     * Constructs the navigation for use in AJAX request
     */
    public function __construct($page, $branchtype, $id) {
        $this->page = $page;
        $this->cache = new navigation_cache(NAVIGATION_CACHE_NAME);
        $this->children = new navigation_node_collection();
        $this->branchtype = $branchtype;
        $this->instanceid = $id;
        $this->initialise();
    }
    /**
     * Initialise the navigation given the type and id for the branch to expand.
     *
     * @param int $branchtype One of navigation_node::TYPE_*
     * @param int $id
     * @return array The expandable nodes
     */
    public function initialise() {
        global $CFG, $DB, $SITE;

        if ($this->initialised || during_initial_install()) {
            return $this->expandable;
        }
        $this->initialised = true;

        $this->rootnodes = array();
        $this->rootnodes['site']      = $this->add_course($SITE);
        $this->rootnodes['mycourses'] = $this->add(get_string('mycourses'), new moodle_url('/my'), self::TYPE_ROOTNODE, null, 'mycourses');
        $this->rootnodes['courses'] = $this->add(get_string('courses'), null, self::TYPE_ROOTNODE, null, 'courses');
        
        if(function_exists('enrol_user_sees_own_courses')) {
            // Determine if the user is enrolled in any course.
            $enrolledinanycourse = enrol_user_sees_own_courses();

            if ($enrolledinanycourse) {
                $this->rootnodes['mycourses']->isexpandable = true;
                if ($CFG->navshowallcourses) {
                    // When we show all courses we need to show both the my courses and the regular courses branch.
                    $this->rootnodes['courses']->isexpandable = true;
                }
            } else {
                $this->rootnodes['courses']->isexpandable = true;
            }
        }
        
        $this->expand($this->branchtype, $this->instanceid);
    }

    public function expand($branchtype, $id) {
        global $CFG, $DB, $PAGE;
        static $newu_expanded_courses = array();
        // Branchtype will be one of navigation_node::TYPE_*
        switch ($branchtype) {
            case self::TYPE_ROOTNODE :
                if ($id === 'mycourses') {
                    $this->rootnodes['mycourses']->isexpandable = true;
                    $this->load_courses_enrolled();
                } else if ($id === 'courses') {
                    $this->rootnodes['courses']->isexpandable = true;
                    $this->load_courses_other();
                }
                break;
            case self::TYPE_CATEGORY :
                $this->load_all_categories($id);
                $limit = 20;
                if (!empty($CFG->navcourselimit)) {
                    $limit = (int)$CFG->navcourselimit;
                }
                $courses = $DB->get_records('course', array('category' => $id), 'sortorder','*', 0, $limit);
                foreach ($courses as $course) {
                    $this->add_course($course);
                }
                break;
            case self::TYPE_COURSE :
                $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
                try {
                    if(!array_key_exists($course->id, $newu_expanded_courses)) {
                        $coursenode = $this->add_course($course);
                        $this->page->set_context(get_context_instance(CONTEXT_COURSE, $course->id));
                        $this->add_course_essentials($coursenode, $course);
                        if ($PAGE->course->id == $course->id && (!method_exists($this, 'format_display_course_content') || $this->format_display_course_content($course->format))) {
                            newu_require_course_login($course);
                            $newu_expanded_courses[$course->id] = $this->load_course_sections($course, $coursenode);
                        }
                    }
                } catch(require_login_exception $rle) {
                    $coursenode = $this->add_course($course);
                }
                break;
            case self::TYPE_SECTION :
                $sql = 'SELECT c.*, cs.section AS sectionnumber
                        FROM {course} c
                        LEFT JOIN {course_sections} cs ON cs.course = c.id
                        WHERE cs.id = ?';
                $course = $DB->get_record_sql($sql, array($id), MUST_EXIST);
                try {
                    $this->page->set_context(get_context_instance(CONTEXT_COURSE, $course->id));
                    if(!array_key_exists($course->id, $newu_expanded_courses)) {
                        $coursenode = $this->add_course($course);
                        $this->add_course_essentials($coursenode, $course);
                        $newu_expanded_courses[$course->id] = $this->load_course_sections($course, $coursenode);
                    }
                    if (empty($newu_expanded_courses[$course->id])) {
                        // 2.4 compat - load_course_sections no longer returns the list of sections
                        $sectionnodes = array();
                        foreach ($coursenode->children as $node) {
                            if($node->type != self::TYPE_SECTION) continue;
                            $section = new stdClass();
                            $section->sectionnode = $node;
                            $sectionnodes[] = $section;
                        }
                        $newu_expanded_courses[$course->id] = $sectionnodes;
                    }
                    $sections = $newu_expanded_courses[$course->id];
                    if(method_exists($this,'generate_sections_and_activities')) {
                        list($sectionarray, $activities) = $this->generate_sections_and_activities($course);
                        if (!array_key_exists($course->sectionnumber, $sections)) break;
                        $section = $sections[$course->sectionnumber];
                        if (is_null($section) || is_null($section->sectionnode)) break;
                        $activitynodes = $this->load_section_activities($section->sectionnode, $course->sectionnumber, $activities);
                    } else {
                        // pre-Moodle 2.1
                        $activitynodes = $this->load_section_activities($sections[$course->sectionnumber]->sectionnode, $course->sectionnumber, get_fast_modinfo($course));
                    }
                    foreach ($activitynodes as $id=>$node) {
                        // load all section activities now
                        $cm_stub = new stdClass();
                        $cm_stub->id = $id;
                        $this->load_activity($cm_stub, $course, $node);
                    }
                } catch(require_login_exception $rle) {
                    $coursenode = $this->add_course($course);
                }
                break;
            case self::TYPE_ACTIVITY :
                // Now expanded above, as part of the section expansion
                break;
            default:
                throw new Exception('Unknown type');
                return $this->expandable;
        }
        $this->find_expandable($this->expandable);
        return $this->expandable;
    }
    /**
     * They've expanded the 'my courses' branch.
     */
    protected function load_courses_enrolled() {
        global $DB;
        $courses = enrol_get_my_courses();
        if ($this->show_my_categories(true)) {
            // OK Actually we are loading categories. We only want to load categories that have a parent of 0.
            // In order to make sure we load everything required we must first find the categories that are not
            // base categories and work out the bottom category in thier path.
            $categoryids = array();
            foreach ($courses as $course) {
                $categoryids[] = $course->category;
            }
            $categoryids = array_unique($categoryids);
            list($sql, $params) = $DB->get_in_or_equal($categoryids);
            $categories = $DB->get_recordset_select('course_categories', 'id '.$sql.' AND parent <> 0', $params, 'sortorder, id', 'id, path');
            foreach ($categories as $category) {
                $bits = explode('/', trim($category->path,'/'));
                $categoryids[] = array_shift($bits);
            }
            $categoryids = array_unique($categoryids);
            $categories->close();

            // Now we load the base categories.
            list($sql, $params) = $DB->get_in_or_equal($categoryids);
            $categories = $DB->get_recordset_select('course_categories', 'id '.$sql.' AND parent = 0', $params, 'sortorder, id');
            foreach ($categories as $category) {
                $this->add_category($category, $this->rootnodes['mycourses']);
            }
            $categories->close();
        } else {
            foreach ($courses as $course) {
                $this->add_course($course, false, self::COURSE_MY);
            }
        }
    }

    /**
     * They've expanded the general 'courses' branch.
     */
    protected function load_courses_other() {
        $this->load_all_courses();
    }

    public function get_expandable() {
        return $this->expandable;
    }
}

class newu_dummy_page extends moodle_page {
    /**
     * REALLY Set the main context to which this page belongs.
     * @param object $context a context object, normally obtained with get_context_instance.
     */
    public function set_context($context) {
        if ($context === null) {
            // extremely ugly hack which sets context to some value in order to prevent warnings,
            // use only for core error handling!!!!
            if (!$this->_context) {
                $this->_context = get_context_instance(CONTEXT_SYSTEM);
            }
            return;
        }
        $this->_context = $context;
    }
}
