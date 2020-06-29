<?php 
require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$menuName = "";
$position = "";
$visible = "";

if(is_post_request()) {

    // Handle form values sent by new.php

    $menuName = isset($_POST['menuName']) ? $_POST['menuName'] : "";
    $position = isset($_POST['position']) ? $_POST['position'] : "";
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "";

    print "Form parameters<br>";
    print "Menu Name: ".$menuName."<br>";
    print "Position: ".$position."<br>";
    print "Visible: ".$visible."<br>";
}
?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Edit Page</h2>

  <form class="dashboard-form" action="<?php print url_for('/staff/pages/edit.php?id='.h(u($id)));?>" method="post">
    <label for="menu-name">Menu Name: </label>
    <input type="text" name="menuName" value="<?php print $menuName; ?>" />
    <label for="position">Position: </label>
    <select name="position">
      <option selected="selected">Please select an option...</option>
      <option <?php if($position == "1") { print "selected='selected'"; } ?> value="1">1</option>
    </select>
    <label class="no-break" for="visible">Visible: </label>
    <input type="checkbox" name="visible" <?php if($visible == "on") { print "checked"; } ?>/>
    <button type="submit" name="editPage">Edit Page</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
