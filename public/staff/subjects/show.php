<?php
require_once("../../../private/initialize.php");

// Get ID from URL
$id = isset ($_GET['id']) ? $_GET['id'] : "1";

// Fetch data
$subject = find_subject($id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="subject listing">
    <h2>Subject: <?php print $subject["subject_name"]; ?></h2>
    <a class="back-button" href="<?php print url_for('/staff/subjects/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>
    <div class="entries">
        <span class="label">Subject Name: </span><span><?php print $subject['subject_name'] ?></span><br>
        <span class="label">Position: </span><span><?php print $subject['position'] ?> </span><br>
        <span class="label">Visible: </span><span><?php print ($subject['visible'] == "1") ? "true" : "false"; ?></span><br>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>