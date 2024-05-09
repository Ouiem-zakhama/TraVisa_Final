<?php
// Include necessary files and configurations
include_once "../../config.php"; // Assuming this file contains database connection configuration
include_once "../../Controller/TopicC.php"; // Assuming this file contains the Topic controller

// Create a new instance of the Topic controller
$topicC = new TopicC();

// Get the author's ID (you need to replace this with the actual author's ID)
$authorId = 1; // Example author ID, replace with the actual ID

// Get topics posted by the author from the database
$topics = $topicC->getTopicsByAuthor($authorId); // Assuming a function getTopicsByAuthor() retrieves topics posted by a specific author
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Topics</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="forum.css">

</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">My Topics</h2>
        <?php foreach ($topics as $topic): ?>
            <div class="card topic-card">
                <div class="card-body">
                    <img src="../Back Office/uploads/<?php echo $topic["image"]; ?>" alt="Topic Image">
                    <div class="topic-details">
                        <h5 class="card-title"><?php echo $topic["topicTitle"]; ?></h5>
                        <p class="card-text">
                            <?php echo strlen($topic["topicContent"]) > 150 ? substr($topic["topicContent"], 0, 150) . '...' : $topic["topicContent"]; ?>
                        </p>
                        <p>
                            <?php
                            $tags = explode('-', $topic["tags"]);
                            foreach ($tags as $tag) {
                                echo '<span class="tag">' . $tag . '</span>';
                            }
                            ?>
                        </p>
                        <p>
                            <i class="far fa-eye"></i> Views: <?php echo $topic["views"]; ?>
                        </p>
                        <p>
                            <i class="fas fa-arrow-up"></i> Upvotes: <?php echo $topic["likes"]; ?>
                        </p>
                        <p>
                            <i class="far fa-comments"></i> Comments: <?php echo $topic["commentsCount"]; ?>
                        </p>
                        <p>
                            <?php
                            // Calculate time elapsed since the topic was posted
                            $now = new DateTime();
                            $createdAt = new DateTime($topic["creationDate"]);
                            $interval = $now->diff($createdAt);

                            // Format the time elapsed
                            if ($interval->d > 0) {
                                echo "Posted " . $interval->format("%ad ago");
                            } elseif ($interval->h > 0) {
                                echo "Posted " . $interval->format("%hh ago");
                            } else {
                                echo "Posted " . $interval->format("%im ago");
                            }
                            ?>
                        </p>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="topic.php?id=<?php echo $topic["id"]; ?>" class="btn btn-primary float-right mr-2">Read
                        More</a>
                    <a href="edit_topic.php?id=<?php echo $topic["id"]; ?>" class="btn btn-primary float-right mr-2">Edit</a>

                    <form action="../../Controller/supprimer_topic.php" method="POST">
                        <input type="hidden" name="topic_id" value="<?php echo $topic["id"]; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>