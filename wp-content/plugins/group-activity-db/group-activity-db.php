<?php
/**
 * @package GAF_DB
 * @version 1.0
 */
/*
Plugin Name: Group Activity Finder
Plugin URI: http://www.empowerbase.com
Description: A database for finding group activities for purposes such as ice breakers, team development, and diversity training
Author: Doug Walton
Version: 1.0
Author URI: http://www.empowerbase.com
*/
    // Defines

    // configuration
        require(dirname(__FILE__) . "/includes/gaf_config.php"); 
        require(dirname(__FILE__) . "/includes/gaf_helpers.php");

    // function that executes the main control 
    function gaf_search_func( $atts ){
        // render search form if no request method
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Debug statement: 
            // echo "<span style='background-color: green'>POST from : " . $_POST['formtype'] . "</span>";
            // determine what to do based on formtype of post
            switch ($_POST['formtype'])
            {
                // input received, search database
                case 'searchform' :
                    require("gaf_search.php");
                    break;
                // request to edit item, so get form
                case 'editform' :
                    $values = array ("title"=>"Edit");
                    gaf_render("gaf_edit_form.php", $values);
                    break; 
                // Update submission, make the update
                case 'updateform' :
                   require("gaf_update.php");
                   break;
            } 
        }
        // if nothing relevant, show the search form
        else
        {
            $values = array ("title"=>"Search");
            gaf_render("gaf_search_form.php", $values);
        }
            
        // if post (from search form) do search and show results

    }

    // Adds shortcode to call control loop from page
    add_shortcode( 'gaf_search', 'gaf_search_func' );

?>
