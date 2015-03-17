<?php
    global $CFG; global $DB;   
        $content='';                                                 //makes sure the database is available
        $url=$CFG->wwwroot.'/my';
        $content .= html_writer::start_tag('a', array('href' => $url, 'id' =>'home'));
        $content .= "MyModules";
        $content .= html_writer::end_tag('a');
    echo $content;
    $category = $DB->get_record('course_categories',array('id'=>$COURSE->category));    
    $cats=explode("/",$category->path);                                         
    $countcats=sizeof($cats);                                                   
    $depthtodisplay=2;
    $catstodisplay=$countcats-$depthtodisplay;
    if ($catstodisplay<2){$catstodisplay=1;}
    for($counter=$catstodisplay;$counter<$countcats;$counter++){
        $catname = $DB->get_record("course_categories", array("id" => $cats[$counter]) );
        $content='';
        $url=$CFG->wwwroot.'/course/index.php?categoryid='.$catname->id;
        $content .= html_writer::start_tag('a', array('href' => $url, 'id' =>'Category'));
        if ($counter < ($countcats-1)){
            $content .= $catname->name;
        } else {
            $content .= $catname->name.' - '.substr($catname->description,0,50);
        }
        $content .= html_writer::end_tag('a');
        echo '<span class="arrow sep">&nbsp;</span>'.$content;
    }                                                                           //ends the loop
    
//TODO: Add course link on the end
        $content='';
        $url=$CFG->wwwroot.'/course/view.php?id='.$COURSE->id;
        $content .= html_writer::start_tag('a', array('href' => $url, 'id' =>'Course'));
        $content .= $COURSE->shortname;
        $content .= html_writer::end_tag('a');
        echo '<span class="arrow sep">&nbsp;</span>'.$content;
?>
