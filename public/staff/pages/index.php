<?php 
require_once("../../../private/initialize.php");

date_default_timezone_set('NZ-CHAT');
?>

<?php
  $pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'page_name' => 'Home'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'page_name' => 'Services'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'page_name' => 'About Us'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'page_name' => 'Contact Us'],
  ];
?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <div class="pages listing">
    <h2>Pages</h2>

    <div class="actions">
    <span>Actions: </span>
      <a class="action" href="">Create New Page</a>
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

      <?php foreach($pages as $page) { ?>
        <tr>
          <td><?php print h($page['id']); ?></td>
          <td><?php print h($page['position']); ?></td>
          <td><?php print $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php print h($page['page_name']); ?></td>
          <td><a class="action" href="<?php print url_for("/staff/pages/show.php?id=".h(u($page['id'])."&name=".u($page['page_name'])));?>">View</a></td>
          <td><a class="action" href="">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>