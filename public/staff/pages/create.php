<?php
require_once("../../../private/initialize.php");

if(is_post_request()) {

    // Handle form values sent by new.php
    $page = [];
    $page['page_name'] = isset($_POST['pageName']) ? $_POST['pageName'] : "";
    $page['subject'] = isset($_POST['subjectName']) ? $_POST['subjectName'] : "";
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $page['visible'] = isset($_POST['visible']) ? "1" : "0";
    $page['content'] = "";

    // Add page to database
    $insertPage= create_page($page);
    $newId = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id='.$newId));

} else {
    redirect_to(url_for('/staff/pages/new.php'));
}

?>