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
            $useremailtype=substr($useremail,-25,-17);
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

        /* Module identifier - 
		 * idnumber can be created as a more meaningful identifier than the current Gcodes
		 * e.g. idnumber CES[]ENG[]140H100AF[]Y1CC[]G106769 => Faculty[]School[]Course[]Context[]Module
		 * All faculties and schools given standard 3char short codes - see csv file in this block code
		 * --------------------------------------------------------------------------------------------- */
        $modulename = $this->page->course->shortname;
        $moduleidnumber = $this->page->course->idnumber;
		
        if ($moduleidnumber == '') {
            $url = '#';
        } else {            
            //Faculty
            $faculty = substr($moduleidnumber,0,3);
        
            //School
            $school = substr($moduleidnumber,5,3);
			
			//Levels
			$level = 1; //Levels are not set currently, ex-UWN modules use contexts which are different - this will need to be resolved at a strategic level before used

            /* Which form identifier is needed
             * Using SWITCH/CASE statements, set $formurl based on faculty or school value
             * as extracted from the module idnumber key
             * Set faculty formids first, then they are overiden by specific school ones if needed - e.g. nursing 
			 * -------------------------------------------------------------------------------------------------- */
            switch ($faculty) {
                case "FBS": //Business and Social Science
                    $qformid = "6439773507221186";
					$rformid = "64397735%7C7221186";
                break;
    
                case "FCI": //Creative Industries
                    $qformid = "3151985032494611";
					$rformid = "315198500%7C32494611";
                break;
    
                case "CES": //Computing Engineering and Science
                    $qformid = "2304356362547808";
					$rformid = "230043563%7C625478008";
                break;
    
                case "LSE": //Life Sciences and Education
                    $qformid = "3220758803511941";
					$rformid = "322007588%7C3511941";

                break;
                
                default:
                    $fqormid = "1220845518272973";  //This is a test form in LCSS
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
            
            //User permissions
//            $context = context_course::instance($this->page->course->id);
            
            //Dates for staff link
			$datefilter = "all";
            $startday="1";
            $startmonth="1";
            $startyear="1995";
            $endday=date("d");
            $endmonth=date("m");
            $endyear=date("Y");
			$module=$this->page->course->shortname;
			$rgroup="ME-".$module."_2013_v1";
			//$rgroup=$module;
			
			//Character replacement - ideally this should be a separate function ratehr than doing the same thing repeatedly, but for now, this is a quick and dirty fix
			//Faculty, school, levvel and start dates are preset so will never have any of the replacement characters in them, so ignored for this quick and dirty fix
			//rgroup
			$rgroup=str_replace("0","00",$rgroup);
			$rgroup=str_replace("&","0&",$rgroup);
			$rgroup=str_replace("-","%2D",$rgroup);
			$rgroup=str_replace("_","%5F",$rgroup);
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


			$userpass="ME-".$module."_2013_v1";
//			$userpass="ME-AA1S01_2013_v1";
// 			$rgroup="AA1S01_2013_v1";

            //Create URLs for links
            if (has_capability('moodle/course:update', context_course::instance($this->page->course->id))) { // for staff
                $baseurl = 'https://moduleevaluation.glam.ac.uk/em4/rlogin.asp?r=SU01100001201';
                $url = $baseurl.$rformid.'015000001101101101101101101101101101101101'.$rgroup.'012010101%2D101010101'.$school.'01'.$level.'01'.$faculty.'0101010101010101'.$datefilter.'011010001'.$startday.'01'.$startmonth.'01'.$startyear.'01'.$endday.'01'.$endmonth.'01'.$endyear.'01';
                
            } else {  //for students
                $baseurl = 'https://moduleevaluation.glam.ac.uk/q4/open.dll?session=';
                $url = $baseurl.$qformid.'&'.$modulename.'&'.$userid.'&'.$level.'&'.$faculty.'&'.$school;
            }

        }

        //Create block content for display

        $this->content->text .= "<div class='qmplinkurl'>";
		if (has_capability('moodle/course:update', context_course::instance($this->page->course->id))) { // for staff
			$this->content->text .= "<form id='UOG-Form' action=".$url." method='POST' target='_blank'>"; //no iframe set up on the page to receive the report as a target, so send it to a new blank page
				$this->content->text .= "<input type='hidden' name='name' value=".$userpass." id='UOG-Name'>";
				$this->content->text .= "<input type='hidden' name='Password' value=".$userpass." id='UOG-Password'>";
				$this->content->text .= "<input type='submit' name='modeval' value='Module Evaluation Report' style='width:75px; white-space: normal;'>";
			$this->content->text .= "</form>"; 
//Testing code from Darren			
/*			$this->content->text .='<form method="post" action="https://moduleevaluation.glam.ac.uk/em4/rlogin.asp?r=SU01%2D323430056501700911329%7C800914625015000001101101101101101101101101101101101ME%2DAF1S008%5F20012%5Fv1018010101%2D1010101010101GBS0101010101010101all0110100011011011995011701100012001301">';
			$this->content->text .='<input type="hidden" value="ME-AF1S08_2012_v1" name="name"/>';
			$this->content->text .='<input type="hidden" value="ME-AF1S08_2012_v1" name="Password"/>';
			$this->content->text .='<input type="submit" value="Click here to continue" />';
			$this->content->text .='</form>';
//end of testing code from Darren	*/		
		} else {
			if ($usertype=="student") {
				$this->content->text .= "<a href=\"$url\">".get_string('qmplink', 'block_qmplink')."</a>";
			} else {
				$this->content->text .= "Sorry, staff cannot access this questionnaire directly";
			}
		}	
        $this->content->text .= "</div>";
        $this->content->footer = "If this link fails, please contact Richard Oelmann in CDEL";
        
        return $this->content;
    }

}

