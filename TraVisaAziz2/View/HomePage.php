<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Display the user's name
if (isset($_SESSION['name'])) {
    echo 'Welcome, ' . $_SESSION['name'] . '!'; // Display the user's name
} else {
    echo 'Welcome!'; // Display a default welcome message if the name is not set
}

// Other content of the homepage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">

    <script src="../script.js" defer></script>
    <title>Document</title>
</head>
<body>
    <main class="content">
        <header id="header">
            <div class="header-content">
                <nav class="navbar">
                    <div class="logo">
                        <img src="../image/LogoTravisa.png" alt=" logo ">
                    </div>
                    <div class="Menu">
                        <a href="">Home</a>
                        <a href="">Destinations</a>
                        <a href="">Trips</a>
                        <a href="">Activities</a>
                    </div>
                    <div class="Authen">
                        <div class="authen-btns">
                            <form action="signup.php"><button type="submit" class="signup">Signup</button></form>
                            <form action="login.php"><button class="login">Login</button></form>
                        </div>
                    </div>
                </nav>

            </div>
        </header>
        <main id="Main">
            <div class="parts">
                <div class="part part1">
                    
                    <div class="part1-text">
                        <h1 style="color:#86BBD8;">Explore. <h1 style="color:#EDAA51;"> Discover </h1>. <h1 style="color: #86BBD8;">Experience</h1>.</h1>
                        <h5 style="text-align: center;">We're not just another website; we're your passport to extraordinary experiences. Whether you seek the serene beauty of secluded beaches, the thrill of vibrant city life, or the tranquility of untouched landscapes, we curate journeys that awaken your spirit of adventure.</h5>
                        <button class="book-now-btn">Book your trip now</button>

                        
                    </div>
                </div>
                <div class="part part2">
                    <div class="part2-text">
                            <h1 style="color: #86BBD8;">Most Popular Destinations</h1>
                    </div>
                    <div class="part2-BoxLayout">
                        <div class="pt2 box21">
                            <div class="box-cont">
                                <div>
                                    <img src="" alt="">
                                </div>
                                <div>
                                    <h5></h5>
                                    <p></p>
                                </div>
                                <div>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                        <div class="pt2 box22">
                            <div class="box-cont">
                                <div>
                                    <img src="" alt="">
                                </div>
                                <div>
                                    <h5></h5>
                                    <p></p>
                                </div>
                                <div>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                        <div class="pt2 box23">
                            <div class="box-cont">
                                <div>
                                    <img src="" alt="">
                                </div>
                                <div>
                                    <h5></h5>
                                    <p></p>
                                </div>
                                <div>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="part part3">
                    <div class="part3-text">

                    </div>
                    <div class="part3-BoxLayout">
                        <div class="pt3 box31">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="pt3 box32">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="pt3 box33">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="pt3 box34">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="pt3 box35">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="pt3 box36">
                            <div>
                                <img src="" alt="">
                            </div>
                            <div>
                                <h4></h4>
                                <div>
                                    <img src="" alt="">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="part part4">
                    <div class="part4-text">
                        <h1></h1>
                        <h5></h5>
                    </div>
                    <div class="part4-BoxLayout">
                        <div class="pt4FeedBack">
                            <div class="feedback-image">
                                <img src="" alt="">
                            </div>
                            <div class="feedback-description">
                                <h5></h5>
                                <div>
                                    <div>
                                        <h3></h3>
                                    </div>
                                    <div>
                                        <div>
                                            <button></button>
                                            <button></button>
                                            <button></button>
                                            <button></button>
                                            <button></button>
                                        </div>
                                        <h5></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button>></button>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer">
            <div class="footer-part1">
                <div class="footer-logo">
                    <img src="" alt="">
                </div>
                <div class="footer-social">
                    <div></div>
                    <div>
                        <a href=""><img src="" alt=""></a>
                        <a href=""><img src="" alt=""></a>
                        <a href=""><img src="" alt=""></a>
                        <a href=""><img src="" alt=""></a>
                    </div>
                </div>
                <div class="footer-menu">
                    <a href=""></a>
                    <a href=""></a>
                    <a href=""></a>
                </div>
                <div class="footer-legal">
                    <a href=""></a>
                    <a href=""></a>
                </div>
                <div class="footer-contact">
                    <h3></h3>
                    <h3></h3>
                    <select name="EN" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="footer-part2">
                <h6></h6>
            </div>
        </footer>
    </main>
</body>
</html>