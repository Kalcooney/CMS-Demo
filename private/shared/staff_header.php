<?php
if (!isset($page_title)) { $page_title = 'Staff Dashboard'; }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CMC - <?php print h($page_title); ?></title>
        <link rel="stylesheet" media="all" href="<?php print url_for("/styles/styles.css"); ?>" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body id="staff-page">
        <header>
            <h1>CMC Dashboard</h1>
        </header>
        <div id="side-bar">
            <nav>
                <ul>
                    <li><span class="material-icons">home</span><a href="<?php print url_for('/staff/index.php');?>">Home</a></li>
                    <li><span class="material-icons">subject</span><a href="<?php print url_for('/staff/subjects/index.php');?>">Subjects</a></li>
                    <li><span class="material-icons">note</span><a href="<?php print url_for('/staff/pages/index.php');?>">Pages</a></li>
                </ul>
            </nav>
        </div>