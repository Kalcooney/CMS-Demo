<?php 
require_once("../../../private/initialize.php");

// Find out how many pages there are
$pageSet = find_all_pages();
$pageCount = mysqli_num_rows($pageSet) + 1;
mysqli_free_result($pageSet);

// Get all subjects
$subjectSet = find_all_subjects();

$page = [];
$page["position"] = $pageCount;

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Create Page</h2>
  <a class="back-button" href="<?php print url_for('/staff/pages/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>
  
  <form class="dashboard-form" action="<?php print url_for('/staff/pages/create.php');?>" method="post">
    <label for="page-name">Page Name: </label>
    <input type="text" name="pageName" />
    <label for="subject-name">Subject Name: </label>
    <select name="subjectName">
      <option selected>Please select a subject...</option>
      <?php
          while ($subject = $subjectSet->fetch_assoc()) {
            print "<option value='".$subject['id']."'>".$subject['subject_name']."</option>";
          }
      ?>
    </select>
    <label for="position">Position: </label>
    <select name="position">
      <?php
          for($i=1; $i <= $pageCount; $i++) {
            print "<option value='".$i."' ";
            // if position of subject is the same as i that option field is the default one
            if($page["position"] == $i) {
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
