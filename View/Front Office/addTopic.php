<?php
// Include necessary files and configurations
include_once "../../config.php"; // Assuming this file contains database connection configuration
include_once "../../Controller/topicC.php"; // Assuming this file contains the Topic controller
include_once "../../Model/topic.php"; // Assuming this file contains the Topic controller

// Initialize variables
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set and not empty
    if (
        isset($_POST["topicTitle"]) &&
        isset($_POST["topicContent"]) &&
        isset($_POST["topicTags"])
    ) {
        if (
            !empty($_POST["topicTitle"]) &&
            !empty($_POST["topicContent"]) &&
            !empty($_POST["topicTags"])
        ) {
            // Process image upload if provided
            $imageName = ""; // Initialize image name variable
            if (isset($_FILES["topicImage"]) && $_FILES["topicImage"]["error"] === 0) {
                $imageTmpName = $_FILES["topicImage"]["tmp_name"];
                $imageExt = strtolower(pathinfo($_FILES["topicImage"]["name"], PATHINFO_EXTENSION));
                $allowedExts = array("jpg", "jpeg", "png");
                if (in_array($imageExt, $allowedExts)) {
                    $imageName = uniqid() . "." . $imageExt;
                    $imageDestination = "../Back Office/uploads/" . $imageName;
                    move_uploaded_file($imageTmpName, $imageDestination);
                } else {
                    $error = "Invalid image format. Only JPG, JPEG, and PNG files are allowed.";
                }
            }

            // Create a new instance of the Topic controller
            $topicC = new TopicC();

            // Get the tags from the form input and split them by comma
            $tags = $_POST["topicTags"];
            // Replace spaces with hyphens in tags
            $tags = str_replace(' ', '-', $tags);
            // Split the tags by comma
            $tagsArray = explode(',', $tags);
            // Remove empty tags
            $tagsArray = array_filter($tagsArray);

            // Create a new topic object
            $topic = new Topic(
                $_POST["topicTitle"],
                $_POST["topicContent"],
                1, // Assuming user ID is stored in session
                implode(',', $tagsArray), // Combine tags back into a string separated by commas
                $imageName // Image name
            );

            // Add the topic to the database
            $topicID = $topicC->addTopic($topic);

            // Redirect to a page showing the added topic (if needed)
            header("Location: topic.php?id=" . $topicID);
            exit();
        } else {
            $error = "Missing information";
        }
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Topic</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Topic</h2>
        <form action="addTopic.php" method="POST" enctype="multipart/form-data">
            <!-- Display error message if any -->
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="topicTitle">Topic Title</label>
                <input type="text" class="form-control" id="topicTitle" name="topicTitle" >
            </div>
            <div class="form-group">
                <label for="topicContent">Topic Content</label>
                <textarea class="form-control" id="topicContent" name="topicContent" rows="6" ></textarea>
            </div>
            <div class="form-group">
                <label for="topicTags">Tags</label>
                <input type="text" class="form-control" id="topicTags" name="topicTags" placeholder="Enter tags separated by commas">
            </div>
            <div class="form-group">
                <label for="topicImage">Upload Image</label>
                <input type="file" class="form-control-file" id="topicImage" name="topicImage">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
