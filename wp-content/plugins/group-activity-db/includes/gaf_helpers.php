<?php

    /**
     * helpers.php
     *
     * Functions derived from 
     * Harvard Computer Science 50
     * Problem Set 7
     *
     * Helper functions.
     */

    require_once(dirname(__FILE__) . "/gaf_config.php");

/**
* renders valid views (in view subdirectory)
* derived from Harvard CS50 pset7
*/
    function gaf_render($view, array $activities = array())
    {
        $viewURL = ABSPATH . "/wp-content/plugins/group-activity-db/views/" . $view;
        // if view exists, render it
        if (file_exists($viewURL))
        {
                require($viewURL);
            exit;
        }

        // else err
        else
        {     
            trigger_error("Invalid view: {$viewURL}", E_USER_ERROR);
        }
    }

/**
* Checks for a greater than 0 integer for form validation
*/
    function gaf_posint($check)
    {
        if (is_int($check) && $check >= 0)
            return true;
    }
/**
* Checks for a greater than zero number for form validation
*/
    function gaf_posnum($check)
    {
        if (is_numeric($check) && $check >= 0)
            return true;
    }

?>
