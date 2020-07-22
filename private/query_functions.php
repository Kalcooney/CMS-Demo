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
    $sql .= "WHERE id='".db_escape($db, $id)."'";
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

     // Validation check
     $errors = validate_subject($subject);

     if (!empty($errors)) {
         return $errors;
     }

    $sql = "INSERT INTO subjects ";
    $sql .= "(subject_name, position, visible) ";
    $sql .= "VALUES ('".db_escape($db, $subject['subject_name'])."', ".db_escape($db, $subject['position'])."','".db_escape($db, $subject['visible'])."')";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Update subject
function update_subject($subject) {
    global $db;

    // Validation check
    $errors = validate_subject($subject);

    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "subject_name='".db_escape($db, $subject['subject_name'])."', ";
    $sql .= "position='".db_escape($db, $subject['position'])."', ";
    $sql .= "visible='".db_escape($db, $subject['visible'])."' ";
    $sql .= "WHERE id='".db_escape($db, $subject['id'])."' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Delete a subject from the database
function delete_subject($id) {
    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='".db_escape($db, $id)."' ";
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
    $sql .= "WHERE pages.id='".db_escape($db, $id)."'";
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

      // Validation check
      $errors = validate_page($page);

      if (!empty($errors)) {
          return $errors;
      }

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, page_name, position, visible, content) ";
    $sql .= "VALUES ('".db_escape($db, $page['subject'])."','".db_escape($db, $page['page_name'])."','".db_escape($db, $page['position'])."','".db_escape($db, $page['visible'])."','".db_escape($db, $page['content'])."')";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Update page
function update_page($page) {
    global $db;

    // Validation check
    $errors = validate_page($page);

    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='".db_escape($db, $page['subject'])."', ";
    $sql .= "page_name='".db_escape($db, $page['page_name'])."', ";
    $sql .= "position='".db_escape($db, $page['position'])."', ";
    $sql .= "visible='".db_escape($db, $page['visible'])."' ";
    $sql .= "WHERE id='".db_escape($db, $page['id'])."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

// Delete a page from the database
function delete_page($id) {
    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='".db_escape($db, $id)."' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}


// Validate subject function
function validate_subject($subject) {
    $errors = [];

    // Subject Name
    if(is_blank($subject['subject_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['subject_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // Position
    // Make sure we are working with an integer
    $position_int = (int) $subject['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // Visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

// Validate page function
function validate_page($page) {
    $errors = [];

    // Page Name
    if(is_blank($page['page_name'])) {
        $errors[] = "Page Name cannot be blank.";
    } elseif (!has_length($page['page_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Page Name must be between 2 and 255 characters.";
    }

    // Check if page name is unique
    if((int) mysqli_num_rows(has_unique_page_menu_name($page['page_name'])) > 0) {
        $errors[] = "Page Name is not unique";
    }

    // Subject
    if(is_blank($page['subject'])) {
        $errors[] = "Subject cannot be blank.";
    } elseif ($page['subject'] == "default") {
        $errors[] = "Subject must be picked";
    }

    // Position
    // Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // Visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

// Check if page name is unique
function has_unique_page_menu_name($page) {
    global $db;

    $sql = "SELECT page_name ";
    $sql .= "FROM pages ";
    $sql .= "WHERE page_name='".db_escape($db, $page)."'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
}

?>