<?php 
require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

    $deletePage = delete_page($id);

    // Check if delete was successful
    if($deletePage) {
        redirect_to(url_for('/staff/pages/index.php'));
    } else {
        print mysqli_error($db);
        db_disconnect($db);
        exit;
    }

} else {
    // Fetch data
    $page = find_page($id);
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Delete Page</h2>

  <form class="dashboard-form" action="<?php print url_for('/staff/pages/delete.php?id='.h(u($page['id'])));?>" method="post">
    <p>Are you sure you want to delete this page?</p>
    <strong class="item"><?php print h($page['page_name']); ?></strong>
    <button type="submit" name="deletePage">Confirm Delete</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>