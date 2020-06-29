<?php 
require_once("../../../private/initialize.php");

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Create Subject</h2>

  <form class="dashboard-form" action="<?php print url_for('/staff/subjects/new.php');?>" method="post">
    <label for="menu-name">Menu Name: </label>
    <input type="text" name="menuName" />
    <label for="position">Position: </label>
    <select name="position">
      <option selected="selected">Please select an option...</option>
      <option value="1">1</option>
    </select>
    <label class="no-break" for="visible">Visible: </label>
    <input type="checkbox" name="visible" />
    <button type="submit" name="createPage">Create Page</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
