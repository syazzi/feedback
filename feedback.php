<?php include 'inc/header.php' ?>

<?php
if (isset($_SESSION["name"]) && isset($_SESSION["id"])) {
  $sql = 'SELECT * FROM feedback';
  $result = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $userSql = 'SELECT * FROM users';
  $userResult = mysqli_query($conn, $userSql);
  $userFeedback = mysqli_fetch_all($userResult, MYSQLI_ASSOC);


  // var_dump($user_result["name"]);


  if (isset($_POST['delete'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $sqldel = 'DELETE FROM feedback WHERE id =' . $delete_id;

    if (mysqli_query($conn, $sqldel)) {
      header('Location: feedback.php');
    } else {
      echo 'ERROR: ' . mysqli_error($conn);
    }
  }
} else {
  header("Location: login.php");
}

?>
<h2>Past Feedback</h2>

<?php if (empty($feedback)) : ?>
  <p class="lead mt3">There is no feedback</p>
<?php endif; ?>

<?php foreach ($feedback as $item) : ?>
  <div class="card my-3 w-75 position-relative">
    <form class="position-absolute top-50 end-0 translate-middle-y" method="POST">
      <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
      <input type="hidden" name="user_id" value="<?php echo $item['user_id']; ?>">
      <?php if($_SESSION['id'] === $item['user_id']): ?>
        <input type="submit" class="btn btn-danger" name="delete" value="Delete">
      <?php endif;?>
      
    </form>
    <div class="card-body text-center">
      <?php echo $item['body']; ?>

      <?php foreach ($userFeedback as $user) : ?>
        <?php if ($user['id'] == $item['user_id']) : ?>
          <div class="text-secondary mt-2">
            by <?php echo $user['name']; ?> on <?php echo $item['date']; ?>
          </div>
        <?php endif; ?>

      <?php endforeach; ?>
    </div>
  </div>

<?php endforeach; ?>


<?php include 'inc/footer.php' ?>