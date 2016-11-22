<?php
/**
file: edit_form.php
part of Group Activity Finder Wordpress Plug In
author: Doug Walton, dcwalton@gmail.com
date: December 5, 2015
description: Builds the search string and presents the results
*/
    // configuration
    require(dirname(__FILE__) . "/includes/gaf_config.php"); 
    $filepath =  plugins_url() . "/group-activity-db/files/";
    $activities = array();
        // Condition flag: 
        // 0 = no search terms beyond category default, 
        // 1 - valid search terms, 
        $condition = 0;
        $sqlsearch = "";
        $messages = array();
        
    // Build $rows query string
    $sqlsearch = "";
    // Keyword Match to title or description
    if ($_POST["title"] != "")
    {
        $sqlterm = "%" . $_POST['title'] . "%";
//        $sqlsearch .= $wpdb->prepare("MATCH (title, items, description,tag) AGAINST (%s)", $sqlterm);
        $sqlsearch .= $wpdb->prepare("((title LIKE (%s)) OR (items LIKE (%s)) OR (description LIKE (%s)) OR (tag LIKE (%s)))", $sqlterm, $sqlterm, $sqlterm, $sqlterm);
        $condition = 1;
    }
    
    // Add time
    if ($_POST['time'] != "" && $_POST['people'] != "")
    {
        if (is_numeric($_POST['time']) && is_numeric($_POST['people']))    
        {
            if ($condition == 1)
                {
                    $sqlsearch .= " AND \n";
                }
            $sqlprep = $wpdb->prepare("(((ppTime * %d) + absTime) <= %d)", $_POST['people'],$_POST['time']);
            $sqlsearch .= $sqlprep;
            $condition = 1;
        }
        else
        {
            array_push($messages, "No time calculation: Invalid people or time values.");
        }
    }

    // Add people
    if ($_POST["people"] != "")
    {
        if (is_numeric($_POST["people"]))
        {
            if ($condition == 1)
            {
                $sqlsearch .= " AND \n";
            }
            $sqlprep = $wpdb->prepare("(minPeople <= %d AND maxPeople >= %d)", $_POST['people'],$_POST['people']);
            $sqlsearch .= $sqlprep;
            $condition = 1;
        }
        else
        {
            array_push($messages, "No people calculation: Invalid people value.");
        }
    }
    // Tag items - Not implemented due to design change but hold for future
//    if (!empty($_POST['taglist']))
//    {
//        if ($condition == 1)
//        {
//            $sqlsearch .= " AND \n";
//        }
//        foreach ($_POST['taglist'] as $tag)
//        {
//            $sqlprep = $wpdb->prepare("tag = %s", $tag);
//            $sqlsearch .= $sqlprep;
//            $condition = 1;
//        }
//    }
    // venue items
    if (isset($_POST["venue"]) && ($_POST["venue"] == "ftf" || $_POST["venue"] == "online"))
    {
        if ($condition == 1)
        {
            $sqlsearch .= " AND \n";
        }
        $sqlprep = $wpdb->prepare("format = %s", $_POST['venue']);
        $sqlsearch .= $sqlprep;
        $condition = 1;
    }
    // prep items
    if (isset($_POST["prep"]) && ($_POST["prep"] == 'no'))
    {
        if ($condition == 1)
        {
            $sqlsearch .= " AND \n";
        }
        $sqlprep = "items IS NULL";
        $sqlsearch .= $sqlprep;
        $condition = 1;
    }

    // Add category, which is required
    if (isset($_POST['category']) && $_POST['category'] != 'none')
    {
         if ($condition == 1)
        {
            $sqlsearch .= " AND \n";
        }
        $topic = $_POST['category'];
        $sqlprep = $wpdb->prepare(" (topic = %s)", $_POST['category']);
        $sqlsearch .= $sqlprep;
        $condition = 1;
        print("<p class = 'gaf head'><strong>Chosen Category:</strong> {$topic}</p>");
    }
    else
    {
        $topic = "Not Chosen";
        print("<p class = 'gaf head'><strong>Default Category:</strong> {$topic}</p>");
    }

    $sqlsearch = "SELECT * FROM emp_gaf_activities WHERE " . $sqlsearch;
    // print any warnings

    foreach ($messages as $message)
         {
         echo "<p class = 'gaf warning'>{$message} </p>";
         }

    // DEBUG 
    // echo $sqlsearch;
   
    // query it 
    $rows = $wpdb->get_results( $sqlsearch, ARRAY_A);
    
    // Print it out if there are results
    if ($rows != 0)
    {
        if ($condition == 1)
        {
            print("<table><thead>
                    <tr>
                    <th>Title</th>
                    <th>Est Time</th>
                    <th>Max People</th>
                    <th>Description</th>
                    <th>Action</th>
                    </tr>
                </thead>");
            foreach ($rows as $row)
            {
                $ppTime = $row["ppTime"];
                $numPeople = $_POST["people"];
                $setTime = $row["absTime"];
                $estTime = (($ppTime * $numPeople) + $setTime);
                global $activities;
                $activities = array(
                    "title" => $row["title"],
                    "estTime" => $estTime,
                    "maxPeople" => $row["maxPeople"],                
                    "description" => $row["description"],
                    "linkname" => $row["linkname"],
                    "ID" => $row["ID"]
                    );
                print("<tr>");
                print("<td>{$activities["title"]}</td>");
                print("<td>{$activities["estTime"]}</td>");
                print("<td>{$activities["maxPeople"]}</td>");
                print("<td>{$activities["description"]}</td>");
                print("<td>");
                    if (current_user_can('edit_pages'))
                      {
                        print("<form action = '' name='editform' method = 'post'>
                <input type = 'hidden' name='formtype' value='editform' />
                <input type = 'hidden' name='recordno' value='{$activities["ID"]}' />
                <button type='submit'>Edit</button>
                </form><br>");
                        }
                print("<a href=$filepath{$activities["linkname"]}>Download</a></td>");
                print("</tr>");
            }
             print("</table>");
        }

    }
    else
    // Nothing found 
    {
        echo "<p class = 'gaf warning'> Nothing found. </p>";
        $values = array ("title"=>"Search");
        gaf_render("gaf_search_form.php", $values);apologize($message);   
    }

?>
