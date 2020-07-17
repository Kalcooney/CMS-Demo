<?php 
require_once("../../../private/initialize.php");

if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

    $deleteSubject = delete_subject($id);

    // Check if delete was successful
    if($deleteSubject) {
        redirect_to(url_for('/staff/subjects/index.php'));
    } else {
        print mysqli_error($db);
        db_disconnect($db);
        exit;
    }

} else {
    // Fetch data
    $subject = find_subject($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="content">
  <h2>Delete Subject</h2>

  <form class="dashboard-form" action="<?php print url_for('/staff/subjects/delete.php?id='.h(u($subject['id'])));?>" method="post">
    <p>Are you sure you want to delete this subject?</p>
    <strong class="item"><?php print h($subject['subject_name']); ?></strong>
    <button type="submit" name="deleteSubject">Confirm Delete</button>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>