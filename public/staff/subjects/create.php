<?php
require_once("../../../private/initialize.php");

if(is_post_request()) {

    // Handle form values sent by new.php
    $subject = [];
    $subject['subject_name'] = isset($_POST['menuName']) ? $_POST['menuName'] : "";
    $subject['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $subject['visible'] = isset($_POST['visible']) ? "1" : "0";

    // Add subject to database
    $insertSubject = create_subject($subject);
    $newId = mysqli_insert_id($db);
    redirect_to(url_for('/staff/subjects/show.php?id='.$newId));

} else {
    redirect_to(url_for('/staff/subjects/new.php'));
}

?>