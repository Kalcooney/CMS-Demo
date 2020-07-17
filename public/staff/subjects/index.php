<?php 
require_once("../../../private/initialize.php");
?>

<?php

// Get all subjects
$subject_set = find_all_subjects();

?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="subjects listing">
    <h2>Subjects</h2>

    <div class="actions">
    <span>Actions: </span>
      <a class="action" href="<?php print url_for("/staff/subjects/new.php");?>">Create New Subject</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <tr>
          <td><?php print h($subject['id']); ?></td>
          <td><?php print h($subject['position']); ?></td>
          <td><?php print $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php print h($subject['subject_name']); ?></td>
          <td><a class="action" href="<?php print url_for("/staff/subjects/show.php?id=".h(u($subject['id'])));?>">View</a></td>
          <td><a class="action" href="<?php print url_for("/staff/subjects/edit.php?id=".h(u($subject['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?php print url_for("/staff/subjects/delete.php?id=".h(u($subject['id'])));?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($subject_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>