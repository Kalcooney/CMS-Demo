<?php 
require_once("../../../private/initialize.php");

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

  <form class="dashboard-form" action="<?php print url_for('/staff/subjects/create.php');?>" method="post">
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
    <button type="submit" name="createPage">Create Page</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
