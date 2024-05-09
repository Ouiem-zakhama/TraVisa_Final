<?php
// Include necessary files and configurations
include_once "../../config.php";
include_once "../../Controller/TopicC.php";
include_once "../../Controller/CommentC.php";
include_once "../../Model/Comment.php";

// Create a new instance of the Topic controller
$topicC = new TopicC();
$commentC = new CommentC();

$loggedInUserId = 1;


// Check if topic ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $topicId = $_GET['id'];

    // Get topic details by ID
    $topic = $topicC->getTopicById($topicId);
    // Increment views count for this topic
    $topicC->incrementViews($topicId);
} else {
    // Redirect to an error page or homepage if topic ID is not provided
    header("Location: error.php");
    exit();
}

// Add comment logic
$commentAdded = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    $commentContent = $_POST['comment'];

    // Perform client-side validation
    if (strlen($commentContent) >= 4) {
        // Create a new instance of the Comment model
        $comment = new Comment($topicId, $commentContent, $loggedInUserId);

        // Add comment to the database
        $commentC->addComment($comment);
        $topicC->incrementCommentsCount($topicId);
        $commentAdded = true;

        // Redirect to the same page to prevent form resubmission
        header("Location: $_SERVER[PHP_SELF]?id=$topicId&commentAdded=true");
        exit();
    } else {
        // Comment does not meet the minimum length requirement
        $commentAdded = false;
    }
}


// Fetch comments for this topic from the database
$comments = $commentC->getCommentsByTopic($topicId);

// Function to calculate time difference
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic['topicTitle']; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="forum.css">


</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3><?php echo $topic['topicTitle']; ?></h3>
            </div>
            <div class="card-body">
                <img src="../Back Office/uploads/<?php echo $topic['image']; ?>" alt="Topic Image"
                    class="img-fluid mb-3">
                <p><?php echo $topic['topicContent']; ?></p>
            </div>
            <div class="card-footer">
                <button class="like-btn" id="likeBtn">
                    <i class="fas fa-arrow-up" style="color: black;"></i>
                    Upvote
                </button>
                <span class="like-count"><?php echo $topic['likes']; ?></span>
            </div>
        </div>

        <!-- Display comment form -->
        <div class="comment-box mt-4">
            <form action="" method="POST">
                <textarea class="form-control mb-2" name="comment" rows="3"
                    placeholder="Write your comment here..."></textarea>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$commentAdded): ?>
                    <div class="text-danger">Comment must have at least 4 characters.</div>
                <?php endif; ?>
                <button type="submit" class="btn btn-info"><i class="fas fa-comment"></i> Comment</button>
            </form>
        </div>

        <!-- Display comments -->
        <?php
        // Assuming $commentsPerPage and $currentPage are defined elsewhere
        $commentsPerPage = 4;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalComments = count($comments);
        $totalPages = ceil($totalComments / $commentsPerPage);
        $startIndex = ($currentPage - 1) * $commentsPerPage;
        $displayedComments = array_slice($comments, $startIndex, $commentsPerPage);
        ?>

        <div class="mt-4">
            <h4>Comments</h4>
            <?php if (!empty($displayedComments)): ?>
                <?php foreach ($displayedComments as $comment): ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="user_avatar.png" alt="User Avatar" class="mr-2"
                                    style="width: 40px; height: 40px; border-radius: 50%;">
                                <div>
                                    <div id="comment-<?php echo $comment['commentID']; ?>-content">
                                        <p><?php echo $comment['commentContent']; ?></p>
                                    </div>
                                    <div id="comment-<?php echo $comment['commentID']; ?>-edit" style="display: none;">
                                        <textarea class="form-control" id="edited-comment-<?php echo $comment['commentID']; ?>"
                                            rows="3"><?php echo $comment['commentContent']; ?></textarea>
                                    </div>
                                    <small class="text-muted">
                                        By: <?php echo $comment['author']; ?> •
                                        <?php echo time_elapsed_string($comment['creationDate']); ?>
                                    </small>
                                </div>
                            </div>
                            <?php if ($comment['author'] == $loggedInUserId): ?>
                                <div class="mt-3 d-flex">
                                    <form action="../../Controller/supprimer_comment.php" method="POST" class="mr-2">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment['commentID']; ?>">
                                        <input type="hidden" name="topic_id" value="<?php echo $topicId; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    <button class="btn btn-sm btn-primary edit-comment-btn"
                                        data-comment-id="<?php echo $comment['commentID']; ?>">Edit</button>
                                    <button class="btn btn-sm btn-success save-comment-btn"
                                        data-comment-id="<?php echo $comment['commentID']; ?>" style="display: none;">Save</button>
                                    <button class="btn btn-sm btn-danger cancel-comment-btn"
                                        data-comment-id="<?php echo $comment['commentID']; ?>"
                                        style="display: none;">Cancel</button>
                                </div>
                            <?php elseif ($topic['author'] == $loggedInUserId): ?>
                                <div class="mt-2 d-flex">
                                    <form action="../../Controller/supprimer_comment.php" method="POST" class="mr-2">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment['commentID']; ?>">
                                        <input type="hidden" name="topic_id" value="<?php echo $topicId; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Comments Pagination">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                    <a class="page-link"
                                        href="?id=<?php echo $topic['id']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>
        </div>


        <script>
            // Function to toggle between edit and view modes
            function toggleEditMode(commentId) {
                // Toggle display for comment content and edit form
                document.getElementById(`comment-${commentId}-content`).style.display = 'block';
                document.getElementById(`comment-${commentId}-edit`).style.display = 'none';

                // Toggle display for edit and save buttons
                document.querySelector(`button.edit-comment-btn[data-comment-id="${commentId}"]`).style.display = 'block';
                document.querySelector(`button.save-comment-btn[data-comment-id="${commentId}"]`).style.display = 'none';
                document.querySelector(`button.cancel-comment-btn[data-comment-id="${commentId}"]`).style.display = 'none';
            }

            // Function to cancel edit mode
            function cancelEditMode(commentId) {
                // Toggle display for comment content and edit form
                document.getElementById(`comment-${commentId}-content`).style.display = 'block';
                document.getElementById(`comment-${commentId}-edit`).style.display = 'none';

                // Reset the value of the edited comment content to the original content
                document.getElementById(`edited-comment-${commentId}`).value = '<?php echo $comment['commentContent']; ?>';

                // Toggle display for edit and save buttons
                document.querySelector(`button.edit-comment-btn[data-comment-id="${commentId}"]`).style.display = 'block';
                document.querySelector(`button.save-comment-btn[data-comment-id="${commentId}"]`).style.display = 'none';
                document.querySelector(`button.cancel-comment-btn[data-comment-id="${commentId}"]`).style.display = 'none';
            }

            // Attach event listeners to edit, save, and cancel buttons
            document.querySelectorAll('.edit-comment-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    // Toggle edit mode
                    document.getElementById(`comment-${commentId}-content`).style.display = 'none';
                    document.getElementById(`comment-${commentId}-edit`).style.display = 'block';
                    document.querySelector(`button.edit-comment-btn[data-comment-id="${commentId}"]`).style.display = 'none';
                    document.querySelector(`button.save-comment-btn[data-comment-id="${commentId}"]`).style.display = 'block';
                    document.querySelector(`button.cancel-comment-btn[data-comment-id="${commentId}"]`).style.display = 'block';
                });
            });

            document.querySelectorAll('.save-comment-btn').forEach(button => {
                button.addEventListener('click', function () {
                    console.log("Save button clicked"); // Add this line to check if the event listener is triggered
                    const commentId = this.getAttribute('data-comment-id');
                    const editedComment = document.getElementById(`edited-comment-${commentId}`).value;
                    console.log("Comment ID:", commentId); // Add this line to check if commentId is retrieved correctly
                    console.log("Edited comment:", editedComment); // Add this line to check if editedComment is retrieved correctly

                    // Perform AJAX request to update the comment in the database
                    fetch('../../Controller/update_comment.php', {
                        method: 'POST',
                        body: JSON.stringify({ commentId: commentId, editedComment: editedComment }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            // Update the comment content and toggle back to view mode
                            document.getElementById(`comment-${commentId}-content`).innerHTML = `<p>${editedComment}</p>`;
                            toggleEditMode(commentId);
                            // Show the edit button again
                            document.querySelector(`button.edit-comment-btn[data-comment-id="${commentId}"]`).style.display = 'block';
                        } else {
                            // Handle error
                            console.error('Error:', response.statusText);
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                });
            });

            document.querySelectorAll('.cancel-comment-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    cancelEditMode(commentId);
                });
            });
        </script>
        <script>
            // JavaScript to handle upvote button click
            document.getElementById('likeBtn').addEventListener('click', function () {
                // Send AJAX request to increment likes count
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Update the likes count on the page
                            var likeCountElement = document.querySelector('.like-count');
                            likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', '../../Controller/increment_likes.php'); // Replace 'increment_likes.php' with the actual PHP file
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('topicId=<?php echo $topicId; ?>');
            });
        </script>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>