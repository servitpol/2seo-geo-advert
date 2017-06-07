<?php

function ga_create_short( $atts ){
	
	global $wpdb;
	$table_name = $wpdb->prefix . "twoseo_ga";
	$name = $atts['name'];
	$select = "SELECT * FROM $table_name WHERE short_name = '$name'";
	$result_db = $wpdb->get_results($select);
	
	$ip = $_SERVER['REMOTE_ADDR'];
	include('sxgeo/SxGeo.php');
	$path = plugins_url();
	$SxGeo = new SxGeo($path.'/2seo-geo-advert/sxgeo/SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);
	$country = $SxGeo->getCountry($ip);

	foreach ($result_db as $short) {
		if($country == 'UA'){
			$short = htmlspecialchars_decode($short->script_out, ENT_QUOTES);
		} else {
			$short = htmlspecialchars_decode($short->script_out, ENT_QUOTES);
		}
	}
	
	return $short;

}

add_shortcode('ga_advert', 'ga_create_short');
