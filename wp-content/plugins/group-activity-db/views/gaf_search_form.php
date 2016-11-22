<!--
file: gaf_search_form.php
part of Group Activity Finder Wordpress Plug In
author: Doug Walton, dcwalton@gmail.com
date: December 5, 2015
description: presents the search input form
-->
<!--Intro material-->
<p class="text-info">THIS TOOL IS IN TEST MODE. So be patient</P><p>To try it, enter some fields below and click button to search. Criteria cumulative. You must enter at least one criterion to search, but keep in mind too many may produce no results.</p>

<!--Start Form-->
<?php echo "<form action='' name = 'searchform' method='post'>";?>
<input type = "hidden" name="formtype" value="searchform" />
    <fieldset>
        <legend class="gaf">The Basics</legend>
        <div class="gaf">
        
            <!--Topic dropdown-->
            <label class="gaf" for="category">Primary Topic</label>
            <select name = "category" id ="category">
                <option value = "none">None</option>
                <option value = "Icebreaker">Icebreakers</option>
                <option value = "Team Building">Team Building</option>
                <option value = "Improve Creativity">Improve Creativity</option>
                <option value = "Learning Review">Learning Review</option>
                <option value = "Motivator">Motivators</option>
                <option value = "Diversity Training">Diversity Training</option>
                <option value = "Funny">Funny and Movement</option>
            </select>
        </div>
               
        <!--Max Time-->
        <div class="gaf">
            <label class="gaf" for="time">How many minutes do you have for the activity?</label>
            <input autocomplete="off" autofocus class="form-control" name="time" size="10" value ="5" placeholder="Enter Total Time Available" type="text" maxlength="10"/>
        </div>
        
        <!--Num people -->
        <div class="gaf">
            <label class="gaf" for="people">How many people will you involve?</label>
            <input autocomplete="off" autofocus class="form-control" name="people" placeholder="Enter 2 or more" value = "2" size="10" type="text" maxlength="10"/>
        </div>
    </fieldset> 
    <fieldset>
        <legend class="gaf">Secondary Criteria</legend>

            <!-- Keyword  -->
            <div class="gaf">
                <label class="gaf" for="title">Keyword(single word < 25 chars)</label>
                <input autocomplete="off" autofocus class="form-control" name="title" placeholder="Enter Keyword" type="text" maxlength="25"/>
                <!--  The special keywords are used in the database tag field to create a second layer of filtering-->
                <p class="gaf searchdesc">Special keywords can be used to filter out specfic items. The current ones are 
                <ul><li>newteam</li>
                <li>intactteam</li></ul></p>
            </div>
            
        <!--Tag dropdown (Not implemented due to design change but hold for possible future use-->
            <!--
            <div class="gaf">
                <label class="gaf" for="tag">Identify other characteristics</label>
                <input name= "taglist[]" type=checkbox value ="newteam">New Team</input>
                <input name= "taglist[]" type=checkbox value ="nocomfort">Out of Comfort Zone</input>
                <input name= "taglist[]" type=checkbox value ="ongoing">On Going Team</input>
            </div>
            -->

        <!--Venue-->
        <div class="gaf">
            <label class="gaf" for="venue">What is the venue?</label>
            <input type="radio" name="venue" value="ftf">Face to Face only<br>
            <input type="radio" name="venue" value="online">Online only<br>
            <input type="radio" name="venue" value="both">Not specified<br>
        </div>
        
        <!--Prep ok?-->
        <div class="gaf">
            <label class="gaf" for = "prep">Is advance preparation ok?</label>
            <input type="radio" name="prep" value="no">no  <input type="radio" name="prep" value="yes">yes<br>
        </div>
    </fieldset>        
        <!--Button-->
        <div class="gaf">
            <p></p>
            <input type=submit value="Find Them!">
        </div>

</form>

