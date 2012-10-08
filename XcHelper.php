<?php

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

class XcHelper
{
    static public function whatToDoToMeetRequirements()
    {
        echo '<div class="error"><p>Meet Requirements please</p></div>';
    }
}
