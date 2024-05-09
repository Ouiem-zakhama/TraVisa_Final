<?php
// Include necessary files and configurations
include_once "../../config.php"; // Assuming this file contains database connection configuration
include_once "../../Controller/TopicC.php"; // Assuming this file contains the Topic controller

// Create a new instance of the Topic controller
$topicC = new TopicC();

// Get all topics from the database
$topics = $topicC->displayTopics("");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Argon Dashboard 2 by Creative Tim</title>
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
              <h6>Topics Table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="text-uppercase">Title</th>
                      <th scope="col" class="text-uppercase">Content</th>
                      <th scope="col" class="text-uppercase">Status</th>
                      <th scope="col" class="text-uppercase">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($topics as $topic): ?>
                      <tr>
                        <td><?= $topic['topicTitle']; ?></td>
                        <td>
                          <?= strlen($topic['topicContent']) > 10 ? substr($topic['topicContent'], 0, 20) . '...' : $topic['topicContent']; ?>
                        </td>
                        <td><?= $topic['status'] ?></td>
                        <td>
                          <form action="comments.php" method="GET">
                            <input type="hidden" name="topic_id" value="<?= $topic['id']; ?>">
                            <button type="submit" class="btn btn-info">View Comments</button>
                          </form>
                          <form action="../../Controller/supprimer_topic.php" method="POST">
                            <input type="hidden" name="topic" value="<?= $topic['id']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                          <?php if ($topic['status'] == "active"): ?>
                            <form action="../../Controller/disable_topic.php" method="POST">
                              <input type="hidden" name="topic_id" value="<?= $topic['id']; ?>">
                              <button type="submit" class="btn btn-primary">Deactivate</button>
                            </form>
                          <?php else: ?>
                            <form action="../../Controller/enable_topic.php" method="POST">
                              <input type="hidden" name="topic_id" value="<?= $topic['id']; ?>">
                              <button type="submit" class="btn btn-success">Activate</button>
                            </form>
                          <?php endif; ?>
                        </td>
                        </td>
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