<?php 
/**
file: edit_form.php
part of Group Activity Finder Wordpress Plug In
author: Doug Walton, dcwalton@gmail.com
date: December 5, 2015
description: presents the edit input form and calls gaf_update.php to process i
*/
 
    // configuration
    require(ABSPATH . "/wp-content/plugins/group-activity-db/includes/gaf_config.php"); 
    $sqlsearch = $wpdb->prepare("SELECT * FROM emp_gaf_activities WHERE ID = %d", $_POST['recordno']);
    
        // query it 

        $rows = $wpdb->get_results( $sqlsearch, ARRAY_A);
        if (count($rows) != 1)
        {
            echo "<p class = 'gaf warning'> Database error - too few or too many entries. </p>";
            $values = array ("title"=>"Search");
            gaf_render("gaf_search_form.php", $values);
        }
?>

<!--// display form-->
            <p class="gaf warning">Change fields as needed and click button to update<p>
            <form action="" name="editform" method="post">
            <input type = "hidden" name="formtype" value="updateform" />
                <fieldset>
                    <!--ID -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="ID">ID</label>
                        <input autocomplete="off" autofocus class="form-control" name="ID" value= "<?php echo $rows[0]["ID"]; ?>" type="text" maxlength="4" size="4" readonly />
                    </div>

                    <!--topic -->
                    <div class="gaf editfield">
            <label class="gaf" for="category">Topic </label>
            <select name = "category" id ="edit_topic">
                <option value = "Icebreaker" <?php echo (($rows[0]["topic"] == "Icebreaker") ? "selected='selected'":''); ?> >Icebreakers</option>
                <option value = "Team Building" <?php echo (($rows[0]["topic"] == "Team Building") ? "selected='selected'":''); ?> >Team Building</option>
                <option value = "Improve Creativity" <?php echo (($rows[0]["topic"] == "Improve Creativity") ? "selected='selected'":''); ?> >Improve Creativity</option>
                <option value = "Learning Review" <?php echo (($rows[0]["topic"] == "Learning Review") ? "selected='selected'":''); ?> >Learning Review</option>
                <option value = "Motivator" <?php echo (($rows[0]["topic"] == "Motivator") ? "selected='selected'":''); ?> >Motivators</option>
                <option value = "Diversity Training" <?php echo (($rows[0]["topic"] == "Diversity Training") ? "selected='selected'":''); ?> >Diversity Training</option>
                <option value = "Funny" <?php echo (($rows[0]["topic"] == "Funny") ? "selected='selected'":''); ?>>Funny and Movement</option>
            </select>
                    </div>

                    <!--tag -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="tag">Comma separated tags</label>
                        <input autocomplete="off" autofocus class="form-control" name="tag" value= "<?php echo $rows[0]["tag"]; ?>" type="text"/>
                    </div>
                    <!--Title -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="title">Title(max 70 char)</label>
                        <input id="editTitle" autocomplete="off" autofocus class="form-control" name="title" value= "<?php echo esc_attr($rows[0]["title"]); ?>"  maxlength="70" type="text"/>
                    </div>

                    <!--Min People-->
                    <div class="gaf editfield">
                        <label class="gaf label" for="minPeople">Min People</label>
                        <input id="editMinPeople" autocomplete="off" autofocus class="form-control" name="minPeople" value="<?php echo $rows[0]["minPeople"] ?>" type="text" maxlength="4"/>
                    </div>

                    <!--Max people -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="maxPeople">Maximum People</label>
                        <input id="editMaxPeople" autocomplete="off" autofocus class="form-control" name="maxPeople" value="<?php echo $rows[0]["maxPeople"] ?>" type="text" maxlength="4"/>
                    </div>
                    <!--groupMax -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="groupMax">Group Size Maximum</label>
                        <input autocomplete="off" autofocus class="form-control" name="groupMax" value="<?php echo $rows[0]["groupMax"] ?>" type="text" size="6" maxlength="6"/>
                    </div>
                    <!--absTime -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="absTime">Set Time Needed</label>
                        <input id="editAbsTime" autocomplete="off" autofocus class="form-control" name="absTime" value="<?php echo $rows[0]["absTime"] ?>" type="text" maxlength="4"/>
                    </div>
                    <!--ppTime -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="ppTime">Per Person Time</label>
                        <input id="editppTime" autocomplete="off" autofocus class="form-control" name="ppTime" value="<?php echo $rows[0]["ppTime"] ?>" type="text" maxlength="4"/>
                    </div>
                    <!--format -->
                    <div class="gaf editfield">
                    <label class="gaf label" for="format">Format</label>
                    <input type="radio" name="venue" value="FTF" <?php echo (($rows[0]["format"] == "FTF") ? "checked":''); ?>>Face to Face only<br>
                    <input type="radio" name="venue" value="online" <?php echo (($rows[0]["format"] == "online") ? "checked":''); ?>>Online only<br>
                    <input type="radio" name="venue" value="both" <?php echo ((($rows[0]["format"] != "FTF") && ($rows[0]["format"] != "online")) ? "checked":''); ?>>Both<br>
                    </div>
                    <!--items -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="items">Prepared Items Needed (separate with HTML li tags)</label>
                        <textarea rows="10" cols="35" name="items" maxlength="500" ><?php echo $rows[0]["items"]?></textarea>
                    </div>

                    <!--Description -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="description">Description</label>
                        <textarea rows="10" cols="35" name="description" maxlength="500" ><?php echo $rows[0]["description"]?></textarea>
                    </div>
                    <!--linkname -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="linkname">Filename</label>
                        <input id="editLink" autocomplete="off" autofocus class="form-control" name="linkname" value="<?php echo $rows[0]["linkname"] ?>" type="text" maxlength="80"/>
                    </div>
                    <!--downCount -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="downCount">Download Count</label>
                        <input autocomplete="off" autofocus class="form-control" name="downCount" value="<?php echo $rows[0]["downCount"] ?>" type="text" size ="4" maxlength="8"/>
                    </div>
                    <!--dev_note -->
                    <div class="gaf editfield">
                        <label class="gaf label" for="dev_note">Development Note</label>
                        <textarea rows="10" cols="35" name="dev_note" maxlength="500" ><?php echo $rows[0]["dev_note"]?></textarea>
                    </div>

                    <!--Button-->
                    <div class="gaf submit">
                        <input class="gaf subbutton"type="submit" value="Update!">
                    </div>
                    <div class="gaf cancel">
                        <input class="gaf cancelbutton"type="submit" formaction="http://www.empowerbase.com/index.php/group-activity-finder/" method="get" value="Cancel">
                    </div>
                </fieldset>
            </form>
