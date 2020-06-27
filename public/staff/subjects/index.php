<?php 
require_once("../../../private/initialize.php");

date_default_timezone_set('NZ-CHAT');
?>

<?php
  $subjects = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
  ];
?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="subjects listing">
    <h2>Subjects</h2>

    <div class="actions">
    <span>Actions: </span>
      <a class="action" href="">Create New Subject</a>
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

      <?php foreach($subjects as $subject) { ?>
        <tr>
          <td><?php print h($subject['id']); ?></td>
          <td><?php print h($subject['position']); ?></td>
          <td><?php print $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php print h($subject['menu_name']); ?></td>
          <td><a class="action" href="<?php print url_for("/staff/subjects/show.php?id=".h(u($subject['id'])));?>">View</a></td>
          <td><a class="action" href="">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>