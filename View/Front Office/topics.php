<?php
// Include necessary files and configurations
include_once "../../config.php"; // Assuming this file contains database connection configuration
include_once "../../Controller/TopicC.php"; // Assuming this file contains the Topic controller

// Create a new instance of the Topic controller
$topicC = new TopicC();

// Get all topics from the database
$topicsData = $topicC->displayTopics("user"); // Assuming a function getAllTopics() retrieves all topics

// Convert topics data to array of objects
$topics = [];
foreach ($topicsData as $topic) {
    $topics[] = [
        'id' => $topic['id'],
        'topicTitle' => $topic['topicTitle'],
        'topicContent' => $topic['topicContent'],
        'image' => $topic['image'],
        'tags' => explode('-', $topic['tags']), // Assuming tags are stored as hyphen-separated string
        'views' => $topic['views'],
        'likes' => $topic['likes'],
        'commentsCount' => $topic['commentsCount'],
        'creationDate' => $topic['creationDate']
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Topics</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="forum.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Topics</h2>

    <!-- Search form -->
    <form id="searchForm" class="mb-3">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search topics">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Filter by tags -->
    <div class="form-group">
        <label for="tagSelect">Filter by Tags:</label>
        <select id="tagSelect" class="form-control">
            <option value="">All</option>
            <!-- Dynamically populate options using JavaScript -->
        </select>
    </div>

    <!-- Topic cards container -->
    <div id="topicCards" class="row">
        <!-- Topics will be dynamically loaded here -->
    </div>

    <!-- Pagination links -->
    <nav id="pagination" aria-label="Topics Pagination" class="d-flex justify-content-center mt-4">
        <!-- Pagination links will be dynamically loaded here -->
    </nav>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Sample topics data (replace with actual data)
    const topics = <?php echo json_encode($topics); ?>;
console.log(topics);
    // Function to display topics based on current page and search/filter criteria
    function displayTopics(page = 1, search = '', tag = '') {
        // Clear previous topics
        $('#topicCards').empty();

        // Filter topics based on search and tag
        let filteredTopics = topics.filter(topic => {
            // Search by title and content
            const matchSearch = topic.topicTitle.toLowerCase().includes(search.toLowerCase())
                || topic.topicContent.toLowerCase().includes(search.toLowerCase());
            // Filter by tag
            const matchTag = tag === '' || topic.tags.includes(tag);
            return matchSearch && matchTag;
        });

        // Paginate the filtered topics
        const itemsPerPage = 4;
        const startIndex = (page - 1) * itemsPerPage;
        const paginatedTopics = filteredTopics.slice(startIndex, startIndex + itemsPerPage);

        // Display paginated topics
        paginatedTopics.forEach(topic => {
            const cardHtml = `
                <div class="card topic-card">
                    <div class="card-body">
                        <img src="../Back Office/uploads/${topic.image}" alt="Topic Image">
                        <div class="topic-details">
                            <h5 class="card-title">${topic.topicTitle}</h5>
                            <p class="card-text">${topic.topicContent.length > 150 ? topic.topicContent.slice(0, 150) + '...' : topic.topicContent}</p>
                            <p>
                                ${topic.tags.map(tag => `<span class="tag">${tag}</span>`).join(' ')}
                            </p>
                            <p><i class="far fa-eye"></i> Views: ${topic.views}</p>
                            <p><i class="fas fa-arrow-up"></i> Upvotes: ${topic.likes}</p>
                            <p><i class="far fa-comments"></i> Comments: ${topic.commentsCount}</p>
                            <p>Posted ${getTimeElapsed(topic.creationDate)}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="topic.php?id=${topic.id}" class="btn btn-primary float-right">Read More</a>
                    </div>
                </div>`;
            $('#topicCards').append(cardHtml);
        });

         // Display pagination links
         displayPagination(page, filteredTopics.length, itemsPerPage);
    }

    // Function to display pagination links
    function displayPagination(currentPage, totalItems, itemsPerPage) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        let paginationHtml = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `
                <li class="page-item ${currentPage === i ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="displayTopics(${i})">${i}</a>
                </li>`;
        }
        $('#pagination').html(`<ul class="pagination">${paginationHtml}</ul>`);
    }

    // Function to calculate time elapsed since creation date
    function getTimeElapsed(creationDate) {
        const now = new Date();
        const createdAt = new Date(creationDate);
        const diff = Math.floor((now - createdAt) / (1000 * 60)); // Difference in minutes
        if (diff < 1) {
            return 'just now';
        } else if (diff < 60) {
            return diff + 'm ago';
        } else if (diff < 1440) {
            return Math.floor(diff / 60) + 'h ago';
        } else {
            return Math.floor(diff / 1440) + 'd ago';
        }
    }

    // Populate tag options
    function populateTags() {
        const tags = [...new Set(topics.flatMap(topic => topic.tags))];
        const tagSelect = $('#tagSelect');
        tags.forEach(tag => {
            tagSelect.append(`<option value="${tag}">${tag}</option>`);
        });
    }
    $(document).ready(function () {
    // Check if topics array is empty
    if (topics.length === 0) {
        console.log("Topics array is empty. Check PHP code to ensure data retrieval is successful.");
        return;
    }

    // Initial display of topics
    displayTopics();

    // Populate tag options
    populateTags();

    // Search form submission
    $('#searchForm').submit(function (event) {
        event.preventDefault();
        const searchInput = $('#searchInput').val();
        displayTopics(1, searchInput);
    });

    // Tag filter change
    $('#tagSelect').change(function () {
        const selectedTag = $(this).val();
        displayTopics(1, '', selectedTag);
    });
});


</script>
</body>
</html>
