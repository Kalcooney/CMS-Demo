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

  if($insertSubject === true) {
      $newId = mysqli_insert_id($db);
      redirect_to(url_for('/staff/subjects/show.php?id='.$newId));
  } else {
      $errors = $insertSubject;
  }

}


// Find out how many subjects there are
$subjectSet = find_all_subjects();
$subjectCount = mysqli_num_rows($subjectSet) + 1;
mysqli_free_result($subjectSet);

$subject = [];
$subject["position"] = $subjectCount;

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Create Subject</h2>
  <a class="back-button" href="<?php print url_for('/staff/subjects/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>

  <?php echo display_errors($errors); ?>

  <form class="dashboard-form" action="<?php print url_for('/staff/subjects/new.php');?>" method="post">
    <label for="menu-name">Subject Name: </label>
    <input type="text" name="menuName" />
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
    <input type="checkbox" name="visible" />
    <button type="submit" name="createSubject">Create Subject</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
