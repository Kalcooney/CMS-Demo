<?php 
require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];

// Fetch data
$subject = find_subject($id);

if(is_post_request()) {

    // Handle submitted form values
    $subject = [];
    $subject['subject_name'] = isset($_POST['menuName']) ? $_POST['menuName'] : "";
    $subject['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $subject['visible'] = isset($_POST['visible']) ? "1" : "0";
    $subject["id"] = $id;

    // Update subject in database
    $updateSubject = update_subject($subject);

    if($updateSubject === true) {
      redirect_to(url_for('/staff/subjects/show.php?id='.$id));
    } else {
      $errors = $updateSubject;
    }

} else {
  // Fetch data
  $subject = find_subject($id);
}

// Find out how many subjects there are
$subjectSet = find_all_subjects();
$subjectCount = mysqli_num_rows($subjectSet);
mysqli_free_result($subjectSet);
?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Edit Subject</h2>
  <a class="back-button" href="<?php print url_for('/staff/subjects/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>

  <!-- Display any errors with the form output -->
  <?php echo display_errors($errors); ?>

  <form class="dashboard-form" action="<?php print url_for('/staff/subjects/edit.php?id='.h(u($id)));?>" method="post">
    <label for="menu-name">Menu Name: </label>
    <input type="text" name="menuName" value="<?php print h($subject['subject_name']); ?>" />
    <label for="position">Position: </label>
    <select name="position">
      <?php
        for($i=1; $i <= $subjectCount; $i++) {
          print "<option value='".$i."' ";
          // if position of subject is the same as i that option field is the default one
          if($subject["position"] == $i) {
            print "selected ";
          }
          print ">".$i."</option>";
        }
      ?>
    </select>
    <label class="no-break" for="visible">Visible: </label>
    <input type="checkbox" name="visible" <?php if ($subject['visible'] == "1") { print "checked"; } ?> />
    <button type="submit" name="editSubject">Save Changes</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>