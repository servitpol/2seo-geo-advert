<?php

global $wpdb;
$table_name = $wpdb->prefix . "twoseo_ga";
	
if(isset($_POST['save'])){

	for($i = 0; $i < count($_POST['block_in']); $i++){
		$short = $_POST['short_name'][$i];
		$script_in = htmlspecialchars($_POST['block_in'][$i], ENT_QUOTES);
		$script_out = htmlspecialchars($_POST['block_out'][$i], ENT_QUOTES);
		
		$insert = "INSERT INTO " . $table_name . " (short_name, script_in, script_out) " . "VALUES ('" . $short . "', '" . $script_in . "', '" . $script_out . "') ON DUPLICATE KEY UPDATE short_name = VALUES(short_name), script_in = VALUES(script_in), script_out = VALUES(script_out)";
	    $results = $wpdb->query($insert);
	}
	
}

if(isset($_POST['delete'])){

	$delete = "DELETE FROM " . $table_name . " WHERE id = " . (int) $_POST['delete'] ;
	$results = $wpdb->query($delete);

}