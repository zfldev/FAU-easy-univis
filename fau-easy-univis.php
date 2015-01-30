<?php
/*
Plugin Name: FAU-easy-UnivIS
Plugin URI: https://www.zfl.fau.de/
Description: Erstellt einen shortcode [univis] welcher univis Links zu Veranstaltungen der FAU immer auf dem aktuellen Stand haelt. Dazu einfach den Teil hinter sem= mit dem [univis] ersetzen. Also z.B. http://univis.uni-erlangen.de/form?__s=2&dsc=anew/tlecture&tdir=philos/1&anonymous=1&ref=tlecture&sem=[univis]
Author: Johannes B. Hartmann
Author URI: https://www.zfl.fau.de/
Version: 1.1
Min WP Version: 4.0
Max WP Version: 4.0.1
*/

/**
	 * Perform text replacements for the shortcode [univis]
	 *
	 * Every univis Link of univis.fau.de is ending with an number which represent the today day 
	 * Today 10 of September 2013 is = 958, if this number is becoming older than 5 days an error message will appear
	 * This function is calculating the univis-day before today, it shout be used in a link like this:
	 * http://univis.uni-erlangen.de/form?__s=2&dsc=anew/tlecture&tdir=philos/1&anonymous=1&ref=tlecture&sem=2013w&__e=[univis]
	 *
	 * Erstellt einen shortcode [univis] welcher univis Links der FAU immer auf dem aktuellen Stand haelt.
	 * http://univis.uni-erlangen.de/form?__s=2&dsc=anew/tlecture&tdir=philos/1&anonymous=1&ref=tlecture&sem=[univis]
	 * Dazu einfach den Teil hinter sem= mit dem shortcode ersetzen.
	 */
	 
function easy_univis_link($atts, $content = null) {
	extract(shortcode_atts(array(
        'dayoffset' => '0',
    ), $atts));

	// Aktueller Monat und Jahr ermitteln
	$todays_month = date('n');
	$todays_year = date('Y');
	
	// Berechnet variablen fuer Semster
	if ( ( $todays_month >= 3 ) AND ( $todays_month <= 7 ) )
	{
		// Fall: Sommersemster von Maerz bis Juli
		$sem = 's';
		$year = $todays_year;
	}
	elseif ( ( $todays_month >= 1 ) AND ( $todays_month <= 2 ) )
	{
		// Fall: Wintersemester Januar und Februar im neuem Jahr => Jahr minus 1 und w
		$sem = 'w';
		$year = $todays_year - 1;
	}
	else
	{ 
		// Fall: Wintersemester August bis Dezember
		$sem = 'w';
		$year = $todays_year;
	}
	
	// Berechnet den aktuellen Univis Tag minus einen Tag
	$start_date = "25.10.2013";
	ereg ("([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})", $start_date, $tmp);
	$tage = time() - mktime(0, 0, 0, $tmp[2],$tmp[1], $tmp[3]);
	$univisdate = round($tage/(60*60*24));
  	
   	return $year.$sem.'&__e='.$univisdate;
}
add_shortcode('univisall', 'easy_univis_link');
add_shortcode('univis', 'easy_univis_link');