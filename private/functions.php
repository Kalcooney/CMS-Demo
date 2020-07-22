<?php

// Add forward slash to links
function url_for($script_path) {
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }

    return WWW_ROOT . $script_path;
}

// urlencode
function u($string="") {
    return urlencode($string);
}

// rawurlencode
function raw_u($string="") {
    return rawurlencode($string);
}

// html special characters
function h($string="") {
    return htmlspecialchars($string);
}
 
// Handle 404 error
function error_404() {
    header($_SERVER["SERVER_PROTOCOL"]."404 Not Found");
    exit;
}

// Handle 500 error
function error_500() {
    header($_SERVER["SERVER_PROTOCOL"]."500 Internal Server Error");
    exit;
}

// Handle redirect
function redirect_to($location) {
    header("Location: ".$location);
    exit;
}

// Check if request is POST
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Check if request is GET
function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Display errors
function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
        $output .= "<div class='errors'>";
        $output .= "Please fix the following errors: ";
        $output .= "<ul>";
        foreach($errors as $error) {
            $output .= "<li>".h($error)."</li>";
        } 
        $output .= "</ul>";
        $output .= "</div>";
    }

    return $output;
}

?>