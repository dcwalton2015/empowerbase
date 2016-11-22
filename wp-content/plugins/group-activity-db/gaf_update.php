<?php
/**
file: edit_form.php
part of Group Activity Finder Wordpress Plug In
author: Doug Walton, dcwalton@gmail.com
date: December 5, 2015
description: process the record update and re-call's search page
*/

// Configuration
require(dirname(__FILE__) . "/includes/gaf_config.php"); 

// $data array for Wordpress Update
$updatevalues = array (
    'title' => $_POST["title"],
    'format' => $_POST["venue"],
    'items' => $_POST["items"],
    'description' => $_POST["description"],
    'linkname' => $_POST["linkname"],
    'dev_note' => $_POST["dev_note"]
    );

// only add the numeric values if they are valid numeric
    
    (gaf_posint(intval($_POST['minPeople'])) ? $updatevalues['minPeople'] = intval($_POST['minPeople']) : '');
    (gaf_posint(intval($_POST['maxPeople'])) ? $updatevalues['maxPeople'] = intval($_POST['maxPeople']) : '');
    (gaf_posint(intval($_POST['groupMax'])) ? $updatevalues['groupMax'] = intval($_POST['groupMax']) : '');
    (gaf_posnum($_POST['absTime']) ? $updatevalues['absTime'] = $_POST['absTime'] : '');
    (gaf_posnum($_POST['ppTime']) ? $updatevalues['ppTime'] = $_POST['ppTime'] : '');
    (gaf_posint(intval($_POST['downCount'])) ? $updatevalues['downCount'] = intval($_POST['downCount']) : '');

// DEBUG code
// foreach ($updatevalues as $keyvalue => $uvalue)
//    echo "<p>" . $keyvalue . ": " . $uvalue . "</p>";

// $where array for Wordpress Update
$whereline = array('ID' => $_POST['ID']);

// Update table, returns false or number of rows updated
$rows = $wpdb->update('emp_gaf_activities', $updatevalues, $whereline); 

// check for successful execution and pass back - might need to 
if ($rows == 1)
{
     echo "<p class = 'gaf success'> Update success! </p>";
     $values = array ("title"=>"Search");
     gaf_render("gaf_search_form.php", $values);
}
else
{
     echo "<p class = 'gaf warning'> Database error: " . $rows . " records updated. Invalid characters in fields.</p>";
     $values = array ("title"=>"Search");
     gaf_render("gaf_search_form.php", $values);
}
?>