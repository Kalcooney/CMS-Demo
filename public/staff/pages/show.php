<?php
require_once("../../../private/initialize.php");

// Get ID from URL
$id = isset ($_GET['id']) ? $_GET['id'] : "1";

// Fetch data
$page = find_page($id);

?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="page listing">
    <h2>Page: <?php print $page["page_name"]; ?></h2>
    <a class="back-button" href="<?php print url_for('/staff/pages/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>
    <div class="entries">
        <span class="label">Page Name: </span><span><?php print $page['page_name'] ?></span><br>
        <span class="label">Subject Name: </span><span><?php print $page['subject_name'] ?></span><br>
        <span class="label">Position: </span><span><?php print $page['position'] ?> </span><br>
        <span class="label">Visible: </span><span><?php print ($page['visible'] == "1") ? "true" : "false"; ?></span><br>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>