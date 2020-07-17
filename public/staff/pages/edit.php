<?php 
require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

    // Handle submitted form values
    $page = [];
    $page['page_name'] = isset($_POST['pageName']) ? $_POST['pageName'] : "";
    $page['subject'] = isset($_POST['subjectName']) ? $_POST['subjectName'] : "";
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $page['visible'] = isset($_POST['visible']) ? "1" : "0";

    // Update page in database
    $updatePage = update_page($id, $page['subject'], $page['page_name'], $page['position'], $page['visible']);

    if($updatePage) {
      redirect_to(url_for('/staff/pages/show.php?id='.$id));
    }

} else {
  // Fetch data
  $page = find_page($id);

  // Find out how many pages there are
  $pageSet = find_all_pages();
  $pageCount = mysqli_num_rows($pageSet);
  mysqli_free_result($pageSet);

  // Get all subjects
  $subjectSet = find_all_subjects();

}
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Edit Page</h2>
  <a class="back-button" href="<?php print url_for('/staff/pages/index.php'); ?>"><span class="material-icons">arrow_back</span>Back to List</a>

  <form class="dashboard-form" action="<?php print url_for('/staff/pages/edit.php?id='.h(u($id)));?>" method="post">
    <label for="page-name">Page Name: </label>
    <input type="text" name="pageName" value="<?php print h($page['page_name']); ?>" />
    <label for="subject-name">Subject Name: </label>
    <select name="subjectName">
      <option selected>Please select a subject...</option>
      <?php
          while ($subject = $subjectSet->fetch_assoc()) {
            print "<option value='".$subject['id']."'";
            // if subject belongs to this page, make default option
            if ($subject['id'] == $page["subject_id"]) {
              print "selected ";
            }
            print ">".$subject['subject_name']."</option>";
          }
      ?>
    </select>
    <label for="position">Position: </label>
    <select name="position">
      <?php
        for($i=1; $i <= $pageCount; $i++) {
          print "<option value='".$i."' ";
          // if position of page is the same as i that option field is the default one
          if($page["position"] == $i) {
            print "selected ";
          }
          print ">".$i."</option>";
        }
      ?>
    </select>
    <label class="no-break" for="visible">Visible: </label>
    <input type="checkbox" name="visible" <?php if ($page['visible'] == "1") { print "checked"; } ?> />
    <button type="submit" name="editPage">Save Changes</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>