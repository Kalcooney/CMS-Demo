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
 
?>