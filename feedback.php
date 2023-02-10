<?php include 'inc/header.php' ?>

<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqldel = 'DELETE FROM feedback';

?>
<h2>Past Feedback</h2>

<?php if (empty($feedback)) : ?>
  <p class="lead mt3">There is no feedback</p>
<?php endif; ?>

<?php foreach ($feedback as $item) : ?>
  <div class="card my-3 w-75 position-relative">
    <div class="position-absolute top-50 end-0 translate-middle-y">
      <input type="submit" class="btn btn-danger" name="delete" value="Delete">
    </div>
    <div class="card-body text-center">
      <?php echo $item['body']; ?>
      <div class="text-secondary mt-2">
        by <?php echo $item['name']; ?> on <?php echo $item['date']; ?>
      </div>
    </div>
  </div>

<?php endforeach; ?>


<?php include 'inc/footer.php' ?>