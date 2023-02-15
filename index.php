<?php include 'inc/header.php'; ?>
<?php

if (isset($_SESSION["name"]) && isset($_SESSION['id'])) {
} else {
  header("Location: login.php");
}
?>


<img src="/php-crash-course/feedback/img/logo.png" class="w-25 mb-3" alt="">
<h2><?php echo 'Welcome ' . $_SESSION["name"] . ', '; ?></h2>
<p class="lead text-center">Leave feedback for Traversy Media</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75" method="POST" id="form">
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <input type="hidden" id="user_id" value="<?php echo $_SESSION['id'] ?>">
    <textarea class="form-control" id="body" placeholder="Enter your feedback"></textarea>
  </div>
  <div class="feedback" id="success">
  </div>
  <div class="mb-3">
    <input type="submit" value="Send" class="btn btn-dark w-100" id="feedback_submit">
  </div>
</form>

<script>
  $(document).ready(function() {
    $('#feedback_submit').on('click', function() {
      $('#feedback_submit').attr("disabled", "disabled");
      var body = $('#body').val();
      var user_id = $('#user_id').val();
      if (body != '') {
        $.ajax({
          url: "insert.php",
          type: "POST",
          data: {
            body: body,
            user_id: user_id
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $("#feedback_submit").removeAttr("disabled");
              $('#form').find('textarea').val('');
              $("#success").html('data added successfully!');

            } else if (dataResult.statusCode == 201) {
              alert('error occured!');
            }
          },
          error: function(xhr, status, error) {
            alert(error);
          }
        });
      } else {
        alert('please fill all field!');
      }
    });
  });
</script>


<?php include 'inc/footer.php'; ?>