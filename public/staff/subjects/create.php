<?php
require_once("../../../private/initialize.php");

if(is_post_request()) {

    // Handle form values sent by new.php

    $menuName = isset($_POST['menuName']) ? $_POST['menuName'] : "";
    $position = isset($_POST['position']) ? $_POST['position'] : "";
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "";

    print "Form parameters<br>";
    print "Menu Name: ".$menuName."<br>";
    print "Position: ".$position."<br>";
    print "Visible: ".$visible."<br>";
} else {
    redirect_to(url_for('/staff/subjects/new.php'));
}

?>