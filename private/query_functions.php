<?php

// Get all subjects from the database
function find_all_subjects() {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Get single subject
function find_subject($id) {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='".$id."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);

    // Free data
    mysqli_free_result($result);
    return $subject;
}

// Get all pages from the database
function find_all_pages() {
    global $db;
    $sql = "SELECT pages.id, subjects.subject_name, pages.position, pages.visible, pages.page_name FROM pages ";
    $sql .= "INNER JOIN subjects ON pages.subject_id = subjects.id ";
    $sql .= "ORDER BY subjects.subject_name ASC, pages.position ASC ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Create subject
function create_subject($subject) {
    global $db;
    $sql = "INSERT INTO subjects ";
    $sql .= "(subject_name, position, visible) ";
    $sql .= "VALUES ('".$subject['subject_name']."','".$subject['position']."','".$subject['visible']."')";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Update subject
function update_subject($id, $subjectName, $position, $visible) {
    global $db;
    $sql = "UPDATE subjects SET ";
    $sql .= "subject_name='".$subjectName."', ";
    $sql .= "position='".$position."', ";
    $sql .= "visible='".$visible."' ";
    $sql .= "WHERE id='".$id."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Delete a subject from the database
function delete_subject($id) {
    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='".$id."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Get single page
function find_page($id) {
    global $db;
    $sql = "SELECT pages.id, pages.subject_id, subjects.subject_name, pages.position, pages.visible, pages.page_name FROM pages ";
    $sql .= "INNER JOIN subjects ON pages.subject_id = subjects.id ";
    $sql .= "WHERE pages.id='".$id."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);

    // Free data
    mysqli_free_result($result);
    return $page;
}

// Create page
function create_page($page) {
    global $db;
    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, page_name, position, visible, content) ";
    $sql .= "VALUES ('".$page['subject']."','".$page['page_name']."','".$page['position']."','".$page['visible']."','".$page['content']."')";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Update page
function update_page($id, $subjectName, $pageName, $position, $visible) {
    global $db;
    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='".$subjectName."', ";
    $sql .= "page_name='".$pageName."', ";
    $sql .= "position='".$position."', ";
    $sql .= "visible='".$visible."' ";
    $sql .= "WHERE id='".$id."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Delete a page from the database
function delete_page($id) {
    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='".$id."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}


?>