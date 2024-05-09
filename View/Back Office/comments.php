<?php
// Include necessary files and configurations
include_once "../../config.php";
include_once "../../Controller/CommentC.php"; 

// Create a new instance of the Comment controller
$commentC = new CommentC();

// Check if topic ID is provided
if (isset($_GET['topic_id'])) {
    $topic_id = $_GET['topic_id'];

    // Get comments for the specified topic from the database
    $comments = $commentC->getCommentsByTopic($topic_id);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Comments</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php require ('aside.php'); ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php require ('nav.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Comments</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="text-uppercase">Comment</th>
                      <th scope="col" class="text-uppercase">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($comments as $comment): ?>
                      <tr>
                        <td><?= $comment['commentContent']; ?></td>
                        <td> <form action="../../Controller/supprimer_comment.php" method="POST">
                            <input type="hidden" name="comment" value="<?= $comment['commentID']; ?>">
                            <input type="hidden" name="topic_id" value="<?= $comment['topicID']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require ('footer.php'); ?>
  </main>
  <!-- Core JS Files -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <!-- Custom Script -->

</body>

</html>
