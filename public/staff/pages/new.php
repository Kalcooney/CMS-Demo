<?php 
require_once("../../../private/initialize.php");

if(is_post_request()) {

  // Handle form values sent by new.php
  $page = [];
  $page['page_name'] = isset($_POST['pageName']) ? $_POST['pageName'] : "";
  $page['subject'] = isset($_POST['subjectName']) ? $_POST['subjectName'] : "";
  $page['position'] = isset($_POST['position']) ? $_POST['position'] : "";
  $page['visible'] = isset($_POST['visible']) ? "1" : "0";
  $page['content'] = "";

  $insertPage = create_page($page);

  // Add page to database
  if($insertPage === true) {
    $newId = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id='.$newId));
  } else {
      $errors = $insertPage;
  }
}

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
  
  <?php echo display_errors($errors); ?>

  <form class="dashboard-form" action="<?php print url_for('/staff/pages/new.php');?>" method="post">
    <label for="page-name">Page Name: </label>
    <input type="text" name="pageName" />
    <label for="subject-name">Subject Name: </label>
    <select name="subjectName">
      <option selected value="default">Please select a subject...</option>
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
