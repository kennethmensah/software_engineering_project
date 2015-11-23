<?php
//include_once 'header.php';
function draw_calendar_taskView($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('S','M','T','W','T','F','S');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
       
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        
	$days_in_this_week = 1;
	$day_counter = 0;

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            
                $date = $year."-".$month."-".$list_day;
         
		$calendar.= '<td class="calendar-day" '
                        . 'onmouseover="getDate('.$list_day.','
                                . ''.$month.','.$year.');">'
                        . '<div class="flip-container" ontouchstart="this.classList.toggle(hover);">';
			/* add in the day number */
			$calendar.= '<div class="flipper"><div class="front"><div class="day-number">'
                                . '<a href="taskView.php?date='.$date.'">'
                                .$list_day.'</a></div></div>'
                                . '<div class="back">'
                                . '<div class="daysTask" >Task </div> '
                                . '</div>'
                                . '</div>'
                                . '</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

function draw_calendar_taskAdd($month,$year){

        
    
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';


	/* table headings */
	$headings = array('S','M','T','W','T','F','S');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
       
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        
	$days_in_this_week = 1;
	$day_counter = 0;
	

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            
                $date = "".$list_day."-".$month."-".$year;
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div type="button" class="day-number" '
                                . 'onclick="display_date('.$list_day.','
                                . ''.$month.','.$year.');">'
                                .$list_day.'</div>';
                                

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;
       
	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

function date_year($y, $minus){
    $date_div = '<select name="y">';
    $year_calc = date("Y");
    
    $date_div.='<option value="'.$y.'"  selected="selected">'.$y.
                    '</option>';
    $year_calc -= $minus;

    for($year_menu = 0 ; $year_menu < 8; $year_menu++){

            $year_calc ++;
            $date_div.= '<option value="'.$year_calc.'" '
                    . ' onclick="changeCalendarYear(this.value)">'.$year_calc.
                    '</option>';

    }

    $date_div.= '</select>';
    return $date_div;
}

function date_month($m){
    $month = array('January', 'February' , 'March', 'April', 'May', 
        'June', 'July', 'August', 'September', 'October', 'November',
        'December');
    
    $mint = intval($m);
    
    
    $i = 1;
    
        $date_div= '<select name="m">';
    
    $date_div.='<option value="'.$m.'"  selected="selected">'.
            $month[--$mint].
                    '</option>';
    
    $j = 0;

    for($i ; $i < 13; $i++){

            
            $date_div.= '<option value="0'.$i.'" onclick="changeCalendarMonth(this.value)"'
                    . '>'.$month[$j++].
                    '</option>';

    }

    $date_div.= '</select>';
    return $date_div;
    
}

$cmd = $_REQUEST['cmd'];
switch ($cmd){
case 1:
    if (isset ($_REQUEST['m']) && isset ($_REQUEST['y'])) {
        $m = $_REQUEST['m'];
        $y = $_REQUEST['y'];
        $year_calc = $y;

        //echo $date_month = date_month($m);
        //echo $date_year = date_year($year_calc, 0);
        echo "<div><span id=month class=ti-arrow-circle-left onclick='previousMonth()'></span>"
        . "<span id=cal_mth>$m</span>"
        . "<span class=ti-arrow-circle-right onclick='nextMonth()'></span></div>";
        echo "<div><span id=year class=ti-arrow-circle-left onclick='previousYear()'></span>"
        . "<span id=cal_yr>$y</span>"
        . "<span class=ti-arrow-circle-right onclick='nextYear()'></span></div>";
        echo $calendar = draw_calendar_taskAdd($m,$y);
    }
    break;
case 2:
    if (isset ($_REQUEST['m']) && isset ($_REQUEST['y'])) {
        $m = $_REQUEST['m'];
        $y = $_REQUEST['y'];
        $year_calc = $y;

        //echo $date_month = date_month($m);
        //echo $date_year = date_year($year_calc, 0);
        echo '<div id=calendar_view>';
        echo "<div class='mth_div'><span id=month class=ti-arrow-circle-left onclick='previousMonth()'></span>"
        . "<span id=cal_mth> $m </span>"
        . "<span class=ti-arrow-circle-right onclick='nextMonth()'></span></div>";
        echo "<div class='mth_div'><span id=year class=ti-arrow-circle-left onclick='previousYear()'></span>"
        . "<span id=cal_yr> $y </span>"
        . "<span class=ti-arrow-circle-right onclick='nextYear()'></span></div>";
        echo $calendar = draw_calendar_taskView($m,$y);
        echo '</div>';
    }
    break;
    
}
?>
  

