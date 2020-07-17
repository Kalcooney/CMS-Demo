<?php require_once("../../../private/initialize.php"); ?>

<?php

// Get all subjects
$page_set = find_all_pages();

?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="pages listing">
    <h2>Pages</h2>

    <div class="actions">
    <span>Actions: </span>
      <a class="action" href="<?php print url_for("/staff/pages/new.php");?>">Create New Page</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Subject Name</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Page Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
        <tr>
          <td><?php print h($page['id']); ?></td>
          <td><?php print h($page['subject_name']); ?></td>
          <td><?php print h($page['position']); ?></td>
          <td><?php print $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php print h($page['page_name']); ?></td>
          <td><a class="action" href="<?php print url_for("/staff/pages/show.php?id=".h(u($page['id'])));?>">View</a></td>
          <td><a class="action" href="<?php print url_for("/staff/pages/edit.php?id=".h(u($page['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?php print url_for("/staff/pages/delete.php?id=".h(u($page['id'])));?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($page_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>