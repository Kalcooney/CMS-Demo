<?php
require_once("../../../private/initialize.php");

date_default_timezone_set('NZ-CHAT');

// Get ID and Name from URL
$id = isset ($_GET['id']) ? $_GET['id'] : "1";
$name = isset ($_GET['name']) ? $_GET['name'] : "Unknown";
?>

<?php $page_title = $name; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
    <h2>Pages</h2>
    <?php print "Name: ".h($name)."<br>"; ?>
    <?php print "ID: ".h($id); ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>