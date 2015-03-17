<?php
require_once("$CFG->libdir/formslib.php");

class block_qmplink extends block_base {
	function init() {
		$this->title = get_string('pluginname', 'block_qmplink');
	}

	function applicable_formats() {
		return array('all' => true, 'mod' => false, 'tag' => false, 'my' => false);
	}

	function get_content() {
		global $CFG, $USER, $OUTPUT;

		//Is user staff or student
		if (isloggedin()){              // User must be logged in to access - but this acts as an error trap
			$useremail=$USER->email;    // Use the user email to determine user type - if not "student" then treat as staff

			$emailsubstrings=explode("@",$useremail);
			$emaildomainsubstrings=explode(".",$emailsubstrings[1]);
			$useremailtype=$emaildomainsubstrings[0];

			if ($useremailtype=="students") {
				$usertype="student";
			}else{
				$usertype="staff";
			}
		}else {
			$usertype="student";
		}

		$this->content = new stdClass();
		$this->content->text = '';

		/* Module identifier
		 * idnumber can be created as a more meaningful identifier than the current Gcodes
		 * e.g. idnumber CES[]ENG[]140H100AF[]G106769[]2 => Faculty[]School[]Subject[]Course[]Module[]Level
		 * --------------------------------------------------------------------------------------------- */
		$modulename = $this->page->course->shortname;
		$moduleidnumber = $this->page->course->idnumber;

		if ($moduleidnumber == '') {
			$url = '#';
		} else {
			$moduleidentifiers = explode("[]",$moduleidnumber);
			//Faculty
			if($moduleidentifiers[0] == "") {
				$faculty = "NOFACULTY";
			} else {
				$faculty=$moduleidentifiers[0];
			}

			//School
			if($moduleidentifiers[1] == "") {
				$school = "NOSCHOOL";
			} else {
				$school=$moduleidentifiers[1];
			}
			
			//Subject
			if($moduleidentifiers[2] == "") {
				$jacs_subject = "NOJACS";
			} else {
				$jacs_subject = $moduleidentifiers[2];
			}
			$subject = "null";
			
			//Course Code
			if($moduleidentifiers[3] == "") {
				$course = "NOCOURSE";
			} else {
				$course=$moduleidentifiers[3];
			}

			//Module Code
			// = $modulename =$moduleidentifiers[4] - not needed, just use $modulename

			//Levels
			$level=$moduleidentifiers[5];

			//VLE - new component to add to QMP URL
			$vle = "Mdl";
			
			//PickUps from visual sanity check of Quercus data
			if ($faculty == "FAT") {$faculty = "FCES";}
			if ($faculty == "HESAS") {$faculty = "FLSE"; $school = "SC_HSPP";}
			if ($level == "") {$level = "";}
			
			/* Which form identifier is needed
			 * Using SWITCH/CASE statements, set $formurl based on faculty or school value
			 * as extracted from the module idnumber key
			 * Set faculty formids first, then they are overiden by specific school ones if needed - e.g. nursing
			 * -------------------------------------------------------------------------------------------------- */
			switch ($faculty) {
				case "FBS": //Business and Social Science
					$qformid = "2016546457761276";
					$rformid = "200165464%7C57761276";
				break;

				case "FCI": //Creative Industries
					$qformid = "8589910298451199";
					$rformid = "858991002%7C98451199";
				break;

				case "FCES": //Computing Engineering and Science
					$qformid = "7471439772971316";
					$rformid = "74714397%7C72971316";
				break;

				case "FLSE": //Life Sciences and Education
					$qformid = "1972715357381289";
					$rformid = "19727153%7C57381289";

				break;

				default:
					$qformid = "1940484783392180";  //This is a test form in LCSS
					$rformid = "194004847%7C833921800";  //This is a test form in LCSS
				break;
			}
			/* School specific overrides for form ids - e.g. for Nursing
			 * None of these are currently set up for any modules at Caerleon/City so no form codes are available
			 * -------------------------------------------------------------------------------------------------- */
/*            switch ($school) {
				case "SHASS": //Existing UWN SHALL for testing
					$formid = "formx";
				break;

				case "NBS": //Existing UWN NBS for testing
					$formid = "formv";
				break;
			}
*/

			//User ID hash
			$salt= $CFG->passwordsaltmain;
			$userid = crypt($USER->username,$salt);

			//Dates for staff link
			$datefilter = "all";
			$startday="1";
			$startmonth="1";
			$startyear="1995";
			$endday=date("d");
			$endmonth=date("m");
			$endyear=date("Y");
			$module=$this->page->course->shortname;
			$qgroup="ME-".$module."_2014_v1";
			$rgroup="ME-".$module."_2014_v1";
			$userpass="ME-".$module."_2014_v1";

			//Character replacement - ideally this should be a separate function rather than doing the same thing repeatedly, but for now, this is a quick and dirty fix
			//Faculty, school, level and start dates are preset so will never have any of the replacement characters in them, so ignored for this quick and dirty fix
			//rgroup
			$rgroup=str_replace("0","00",$rgroup);
			$rgroup=str_replace("&","0&",$rgroup);
			$rgroup=str_replace("-","%2D",$rgroup);
			$rgroup=str_replace("_","%5F",$rgroup);
			//course
			$stucourse=$course;
			$course=str_replace("0","00",$course);
			$course=str_replace("&","0&",$course);
			$course=str_replace("-","%2D",$course);
			$course=str_replace("_","%5F",$course);
			//jacs
			$stujacs_subject=$jacs_subject;
			$jacs_subject=str_replace("0","00",$jacs_subject);
			$jacs_subject=str_replace("&","0&",$jacs_subject);
			$jacs_subject=str_replace("-","%2D",$jacs_subject);
			$jacs_subject=str_replace("_","%5F",$jacs_subject);
			//endday
			$endday=str_replace("0","00",$endday);
			$endday=str_replace("&","0&",$endday);
			$endday=str_replace("-","%2D",$endday);
			$endday=str_replace("_","%5F",$endday);
			//endmonth
			$endmonth=str_replace("0","00",$endmonth);
			$endmonth=str_replace("&","0&",$endmonth);
			$endmonth=str_replace("-","%2D",$endmonth);
			$endmonth=str_replace("_","%5F",$endmonth);
			//endyear
			$endyear=str_replace("0","00",$endyear);
			$endyear=str_replace("&","0&",$endyear);
			$endyear=str_replace("-","%2D",$endyear);
			$endyear=str_replace("_","%5F",$endyear);


			//Create URLs for links
			if (has_capability('moodle/course:update', context_course::instance($this->page->course->id))) { // for staff
				$baseurl = 'https://mereportingtest.southwales.ac.uk/Reportlet/ModuleSurvey?r=';
				$r = 'SU01100001201'.$rformid."015000001101101101101101101101101101101101".$rgroup."012010101%2D10101010101".$level."01".$faculty."010101".$jacs_subject."01010101".$vle."01".$datefilter."011010001".$startday."01".$startmonth."01".$startyear."01".$endday."01".$endmonth."01".$endyear."01";
				
				$time = strtotime("+2 hours");
				$expires = date('Y-m-d',$time).'T'.date('H:i:s', $time);
				$key = 'AZO85Lz5lXlI0qZcfR72WcK6ulhx99D1b5jwD0UUpdOvdV6sGh4gYHTIDk5VJaJqTVyvlv0c9Y8SL07bylqT9nCIWUOdWZ0bI7ABW8UgoyuR1rl8XbzbdzD1915neP5c';
				$auth = md5($expires.$r.$key);
				$auth2 = md5($auth.$key);

				$url = $baseurl.$r.'&expires='.$expires.'&auth='.$auth2;

			} else {  //for students
				$baseurl = 'https://qmptest.southwales.ac.uk/perception5/open.php?SESSION=';
				$url = $baseurl.$qformid."&Name=".$userid."&Group=".$qgroup."&S1=".$subject."&S2=".$level."&S3=".$faculty."&S4=".$school."&S5=".$stucourse."&S6=".$stujacs_subject."&S10=".$vle;
			}

		}

		//Create block content for display

		$this->content->text .= "<div class='qmplinkurl'>";
		if ($moduleidnumber == '') {
			$this->content->text .= "This module has no QMP Module Evaluation identifier code. Please check that this is a Quercus listed module and if so, please report this to the IT Helpdesk.";
		} else {
			if (has_capability('moodle/course:update', context_course::instance($this->page->course->id))) { // for staff
				$this->content->text .=$url;
				$this->content->text .= "<form id='UOG-Form' target='_blank' method='POST' action=".$url.">"; //no iframe set up on the page to receive the report as a target, so send it to a new blank page
					$this->content->text .= "<input type='hidden' name='name' value=".$userpass." id='UOG-Name'>";
					$this->content->text .= "<input type='hidden' name='Password' value=".$userpass." id='UOG-Password'>";
					$this->content->text .= "<input type='submit' name='modeval' value='Module Evaluation Report' style='width:75px; white-space: normal;'>";
				$this->content->text .= "</form>";
			} else {
				if ($usertype=="student" || $USER->email =="richard.oelmann@southwales.ac.uk") { //allows 'student' testing by Richard
//				if ($usertype=="student") {
					$this->content->text .= "<a href=\"$url\">".get_string('qmplink', 'block_qmplink')."</a>";
				} else {
					$url = "https://moduleevaluation.glam.ac.uk/q4/open.dll?SESSION=1940484783392180&Name=dda068a6304a569d&Group=a2ad115411024ebc";
					$this->content->text .= "Sorry, staff cannot access this questionnaire directly. However, you can complete a sample module evaluation questionnaire; answers won't be recorded against this module.<br /><a href=\"$url\"> Click here to complete a sample module evaluation questionnaire. </a>";
				}
			}
		}
		$this->content->text .= "</div>";
		$this->content->footer = "";

		// TESTING LINE TO DISPLAY EMAIL/USERTYPE        $this->content->footer .= "User Email: ".$useremail.";".$emailsubstrings[1].";".$useremailtype."</br>";
		// TESTING LINE TO DISPLAY MODULE IDENTIFIER				$this->content->footer .= "Faculty:".$faculty." School:".$school." Course:".$course." Module:".$modulename." Level:".$level." VLE:".$vle."</br>";
		// TESTING LINE TO DISPLAY URL 				$this->content->footer .= "URL: ".$url."</br>";

		//MESSAGES IF THERE ARE KNOWN ISSUES
/*
		if (has_capability('moodle/course:update', context_course::instance($this->page->course->id))) { // for staff
			$this->content->footer .= "<b>Module Evaluation Reporting:</b> - there is a known issue with the module evaluation tool which is affecting the staff view only on some modules. If you are encountering difficulties with accessing your report, you can request a copy of it through the <a href='http://www.southwales.ac.uk/customersupport'>IT Customer Support Team
		</a> who will arrange for your request to be actioned by the appropriate team. Your initial request should include the individual module code for each module that you require a report on.<br />Please note, this does NOT affect students' ability to complete the evaluation.";
		} else {
			$this->content->footer .= "If you are having problems with this link, please click <a href='http://celt.southwales.ac.uk/resources/me/'> here</a>";
		}
*/
/*        $this->content->text .= "This block has been temporarily disabled. We apologise for any inconvenience, it will be returned as soon as possible.";
		$this->content->text .= "</div>";
*/

		return $this->content;
	}

}

