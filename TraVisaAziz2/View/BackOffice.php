<?php
include "../Controller/userC.php";
$user = new userC();
$listUsers = $user->ListUsers(); 

$userController = new userC();

// Generate role statistics
$roleStatistics = $userController->generateRoleStatistics();

// Convert role statistics data to JSON format for JavaScript charting
$userCountByRoleJSON = json_encode($roleStatistics['user_count_by_role']);
$percentageDistributionByRoleJSON = json_encode($roleStatistics['percentage_distribution_by_role']);
$roleAggregationsJSON = json_encode($roleStatistics['role_aggregations']);
$roleComparisonsJSON = json_encode($roleStatistics['role_comparisons']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/LogoTravisa.png">
  <title>
    TraVisa by innovation
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
        target="_blank">
        <img src="./assets/img/Travisa/LogoTravisa.png" class="navbar-brand-img h-100" alt="main_logo" width="50" height="50">
        <span class="ms-1 font-weight-bold">TraVisa</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="./pages/dashboard.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/tables.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/billing.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/virtual-reality.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/rtl.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/profile.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-in.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-up.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
      data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="search" id="search" placeholder="Type here...">
             

            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">number of Users</p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                     
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder"></span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                     
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span> 
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Users</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold"></span>
              </p>
                <!-- Add button for adding a new user -->
                <button onclick="exportToPDF()">Export to PDF</button>
            <button class="btn btn-primary" id="addUserBtn">Add User</button>
           <!-- <input type="text" name="search" id="search" placeholder="Search..." />-->
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table align-items-center ">
                  <tbody>
                  <?php echo $listUsers; ?>
                  <div id="deleteConfirmation" class="popup">
                        <div class="popup-content">
                            <p>Are you sure you want to delete this user?</p>
                            <button id="confirmDelete">Yes</button>
                            <button id="cancelDelete">Cancel</button>
                        </div>
                    </div>
                    <div id="updatePopup" class="popup">
                    <div class="popup-content">
                        <span class="close" onclick="closeUpdatePopup()">&times;</span>
                        <h2>Update User</h2>
                        <form id="updateForm" action="updateUser.php" method="post">
                            <input type="hidden" id="userId" name="userId">
                            <div>
                                <label for="updateName">Name:</label>
                                <input type="text" id="updateName" name="updateName">
                                <div id="updateNameError" class="error-msg"></div>
                            </div>
                            <div>
                                <label for="updatePrenom">Prenom:</label>
                                <input type="text" id="updatePrenom" name="updatePrenom">
                                <div id="updatePrenomError" class="error-msg"></div>
                            </div>
                            <div>
                                <label for="updateEmail">Email:</label>
                                <input type="email" id="updateEmail" name="updateEmail">
                                <div id="updateEmailError" class="error-msg"></div>
                            </div>
                            <div>
                                <label for="updatePassword">Password:</label>
                                <input type="password" id="updatePassword" name="updatePassword">
                                <div id="updatePasswordError" class="error-msg"></div>
                            </div>
                            <div>
                                <label for="updateNumTel">Phone Number:</label>
                                <input type="tel" id="updateNumTel" name="updateNumTel">
                                <div id="updateNumTelError" class="error-msg"></div>
                            </div>
                            <div>
                                <label for="updateRole">Role:</label>
                                <select id="updateRole" name="updateRole">
                                    <option value="Admin">Admin</option>
                                    <option value="Client">Client</option>
                                </select>
                                <div id="updateRoleError" class="error-msg"></div>
                            </div>
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>
                            <!-- Pop-up for adding a new user -->
                            <div id="addUserPopup" class="popup">
                                <div class="popup-content">
                                    <span class="close" onclick="closeAddUserPopup()">&times;</span>
                                    <h2>Add User</h2>
                                    <form id="addUserForm" method="post" action="addUser.php">
                                        <label for="addUserId">User ID:</label>
                                        <input type="number" id="addUserId" name="addUserId" required>
                                        <div id="addUserIdError" class="error-msg"></div>

                                        <label for="nom">Nom:</label>
                                        <input type="text" id="nom" name="nom" required>
                                        <div id="nomError" class="error-msg"></div>

                                        <label for="prenom">Prénom:</label>
                                        <input type="text" id="prenom" name="prenom" required>
                                        <div id="prenomError" class="error-msg"></div>

                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required>
                                        <div id="emailError" class="error-msg"></div>

                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" required>
                                        <div id="passwordError" class="error-msg"></div>

                                        <label for="numTel">Num Tel:</label>
                                        <input type="number" id="numTel" name="numTel" required>
                                        <div id="numTelError" class="error-msg"></div>

                                        <label for="role">Role:</label>
                                        <select id="role" name="role" required>
                                            <option value="Admin">Admin</option>
                                            <option value="Client">Client</option>
                                        </select>
                                        <div id="roleError" class="error-msg"></div>

                                        <button type="submit">Add User</button>
                                    </form>
                                </div>
                              </div>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
              <div class="carousel-inner border-radius-lg h-100">
                <div class="carousel-item h-100 active" style="background-image: url('./assets/img/Travisa/jezael-melgoza-NiyRORf8d8I-unsplash\ 1.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-camera-compact text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Get started with Argon</h5>
                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('./assets/img/Travisa/Group\ 339.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                    <p>That’s my skill. I’m not really specifically talented at anything except for the ability to
                      learn.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('./assets/img/Travisa/juan-di-nella-ulhxvMjzI_4-unsplash\ 1.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-trophy text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Sales by Country</h6>
              </div>
            </div>
            
            <div style="width: 50%; margin: auto;">
        <!-- Display count of users by role as a bar chart -->
        <h2>Count of Users by Role</h2>
        <canvas id="userCountChart"></canvas>

        <!-- Display percentage distribution of users by role as a pie chart -->
        <h2>Percentage Distribution of Users by Role</h2>
        <canvas id="percentageDistributionChart"></canvas>

        <!-- Display role-based aggregations as a bar chart -->
        <h2>Role-based Aggregations</h2>
        <canvas id="roleAggregationsChart"></canvas>

        <!-- Display role-based comparisons as a bar chart -->
        <h2>Role-based Comparisons</h2>
        <canvas id="roleComparisonsChart"></canvas>
    </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Categories</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-mobile-button text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Devices</h6>
                      <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-tag text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                      <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-box-2 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                      <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-satisfied text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                      <span class="text-xs font-weight-bold">+ 430</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About
                    Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                    target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary"
              onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
            onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
            onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
          Download</a>
        <a class="btn btn-outline-dark w-100"
          href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
            data-icon="octicon-star" data-size="large" data-show-count="true"
            aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
            class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
            class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
                      
<style>
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Change background color */
    z-index: 9999;
    overflow: auto;
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px; /* Adjust width as needed */
    max-height: 80%; /* Limit the height of the pop-up */
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    text-align: center;
    overflow-y: auto; /* Enable vertical scrolling if needed */
}

.popup button {
    margin-top: 20px;
    padding: 10px 20px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease;
}

.popup button:hover {
    background: #0056b3;
}

.popup button.close {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px;
    color: #666;
    font-size: 18px;
    border: none;
    cursor: pointer;
}

.popup button.close:hover {
    color: #333;
}

.popup label {
    display: block;
    margin-bottom: 15px;
    color: #333;
    font-size: 18px;
}

.popup input[type="text"],
.popup input[type="email"],
.popup input[type="password"],
.popup input[type="number"],
.popup select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
    outline: none;
    background-color: #f9f9f9; /* Change input background color */
}

.popup .error-msg {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
}

  </style>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteConfirmation = document.getElementById('deleteConfirmation');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete = document.getElementById('cancelDelete');
    let userIdToDelete;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            userIdToDelete = this.getAttribute('data-id');
            deleteConfirmation.style.display = 'block';
        });
    });

    confirmDelete.addEventListener('click', function() {
        // If confirmed, submit the form
        if (userIdToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'deleteUser.php';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'userId';
            input.value = userIdToDelete;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
        deleteConfirmation.style.display = 'none';
    });

    cancelDelete.addEventListener('click', function() {
        deleteConfirmation.style.display = 'none';
    });
});


</script>

<script>
  function openUpdatePopup(userId, name, prenom, email, password, numTel, role) {
    console.log(userId, name, prenom, email, password, numTel, role);
    document.getElementById('userId').value = userId;
    document.getElementById('updateName').value = name;
    document.getElementById('updatePrenom').value = prenom;
    document.getElementById('updateEmail').value = email;
    document.getElementById('updatePassword').value = password;
    document.getElementById('updateNumTel').value = numTel;
    document.getElementById('updateRole').value = role;
    document.getElementById('updatePopup').style.display='block';
}




// Close the update pop-up
function closeUpdatePopup() {
    document.getElementById('updatePopup').style.display = 'none';
}

// Event listener for update buttons
document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.btn-update');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const prenom = this.getAttribute('data-prenom');
            const email = this.getAttribute('data-email');
            const password = this.getAttribute('data-password');
            const numTel = this.getAttribute('data-numTel');
            const role = this.getAttribute('data-role');

            openUpdatePopup(userId, name, prenom, email, password, numTel, role);
        });
    });
});
// Event listener for update buttons
document.addEventListener('DOMContentLoaded', function() {
        const updateForm = document.getElementById('updateForm');

        updateForm.addEventListener('submit', function(event) {
            // Validate form inputs here
            const updateName = document.getElementById('updateName').value;
            const updatePrenom = document.getElementById('updatePrenom').value;
            const updateEmail = document.getElementById('updateEmail').value;
            const updatePassword = document.getElementById('updatePassword').value;
            const updateNumTel = document.getElementById('updateNumTel').value;
            const updateRole = document.getElementById('updateRole').value;

            // Clear all previous error messages
            const errorFields = document.querySelectorAll('.error-msg');
            errorFields.forEach(function(errorField) {
                errorField.textContent = '';
            });

            // Example: Check if the updateName field is empty
            if (updateName.trim() === '') {
                document.getElementById('updateNameError').textContent = 'Name is required';
                event.preventDefault(); // Prevent form submission
            }

            // Validate updateName and updatePrenom fields (no numbers, at least two letters)
            const nameRegex = /^[A-Za-z]{2,}$/;
            if (!nameRegex.test(updateName)) {
                document.getElementById('updateNameError').textContent = 'Name must contain only letters and be at least two characters long';
                event.preventDefault(); // Prevent form submission
            }

            if (!nameRegex.test(updatePrenom)) {
                document.getElementById('updatePrenomError').textContent = 'Last name must contain only letters and be at least two characters long';
                event.preventDefault(); // Prevent form submission
            }

            // Validate updateEmail format
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(updateEmail)) {
                document.getElementById('updateEmailError').textContent = 'Invalid email address format';
                event.preventDefault(); // Prevent form submission
            }

            // Validate updateNumTel (8 digits)
            const numTelRegex = /^[0-9]{8}$/;
            if (!numTelRegex.test(updateNumTel)) {
                document.getElementById('updateNumTelError').textContent = 'Phone number must be 8 digits long';
                event.preventDefault(); // Prevent form submission
            }

            // Validate updateRole selection
            if (updateRole !== 'Admin' && updateRole !== 'Client') {
                document.getElementById('updateRoleError').textContent = 'Invalid role selection';
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>

<script>
  function closeAddUserPopup() {
    document.getElementById('addUserPopup').style.display = 'none';
}
    document.addEventListener('DOMContentLoaded', function() {
        const addUserBtn = document.getElementById('addUserBtn');
        const addUserPopup = document.getElementById('addUserPopup');

        addUserBtn.addEventListener('click', function() {
            addUserPopup.style.display = 'block';
        });

        const addUserForm = document.getElementById('addUserForm');
        addUserForm.addEventListener('submit', function(event) {
            // Validate form inputs here
            const userId = document.getElementById('addUserId').value;
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const numTel = document.getElementById('numTel').value;
            const role = document.getElementById('role').value;

            // Regular expressions for input validation
            const idRegex = /^\d{1,4}$/;
            const nameRegex = /^[a-zA-Z]{2,20}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^.{4,20}$/;
            const telRegex = /^\d{8}$/;

           // Check User ID
           if (!idRegex.test(userId)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('addUserIdError').textContent = 'User ID must be a number with between 1 and 4 digits';
            } else {
                document.getElementById('addUserIdError').textContent = ''; // Clear error message
            }

            // Check Nom
            if (!nameRegex.test(nom)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('nomError').textContent = 'Nom must contain only letters and be at least 2 characters long';
            } else {
                document.getElementById('nomError').textContent = ''; // Clear error message
            }

            // Check Prenom
            if (!nameRegex.test(prenom)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('prenomError').textContent = 'Prénom must contain only letters and be at least 2 characters long';
            } else {
                document.getElementById('prenomError').textContent = ''; // Clear error message
            }

            // Check Email
            if (!emailRegex.test(email)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('emailError').textContent = 'Invalid email format';
            } else {
                document.getElementById('emailError').textContent = ''; // Clear error message
            }

            // Check Password
            if (!passwordRegex.test(password)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('passwordError').textContent = 'Password must be at least 4 characters long';
            } else {
                document.getElementById('passwordError').textContent = ''; // Clear error message
            }

            // Check Num Tel
            if (!telRegex.test(numTel)) {
                event.preventDefault(); // Prevent form submission
                document.getElementById('numTelError').textContent = 'Num Tel must be a number with exactly 8 digits';
            } else {
                document.getElementById('numTelError').textContent = ''; // Clear error message
            }
        });
    });
</script>


<script>
  th = document.getElementsByTagName('th');

for(let c=0; c < th.length; c++){

    th[c].addEventListener('click',item(c))
}


function item(c){

    return function(){
      console.log(c)
      sortTable(c)
    }
}


function sortTable(c) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("UserTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[c];
      y = rows[i + 1].getElementsByTagName("TD")[c];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>

<script>
      const searchInput = document.getElementById("search");
      const rows = document.querySelectorAll("tbody tr");
      console.log(rows);
      searchInput.addEventListener("keyup", function (event) {
        const q = event.target.value.toLowerCase();
        rows.forEach((row) => {
          row.querySelector("td").textContent.toLowerCase().startsWith(q)
            ? (row.style.display = "table-row")
            : (row.style.display = "none");
        });
      });
    </script>

<script>
        function exportToPDF() {
            // Create new jsPDF instance
            const doc = new jsPDF();

            // Extract data from the HTML table
            const table = document.getElementById('UserTable');
            const rows = table.querySelectorAll('tr');
            const columns = ['ID', 'Nom', 'Prenom', 'Email', 'Password', 'NumTel', 'Role'];

            // Prepare data for PDF
            const data = [];
            rows.forEach((row) => {
                const rowData = [];
                row.querySelectorAll('td').forEach((cell) => {
                    rowData.push(cell.textContent.trim());
                });
                data.push(rowData);
            });

            // Add the table to the PDF
            doc.autoTable({
                head: [columns],
                body: data,
            });

            // Save the PDF
            doc.save('C:/amp64/www/Projets/TraVisaAziz/user_table.pdf');
        }
    </script>
 <script>
        // Parse role statistics data from PHP to JavaScript
        var userCountByRole = <?php echo $userCountByRoleJSON; ?>;
        var percentageDistributionByRole = <?php echo $percentageDistributionByRoleJSON; ?>;
        var roleAggregations = <?php echo $roleAggregationsJSON; ?>;
        var roleComparisons = <?php echo $roleComparisonsJSON; ?>;

        // Function to create a bar chart
        function createBarChart(elementId, data) {
            var ctx = document.getElementById(elementId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: data
            });
        }

        // Function to create a pie chart
        function createPieChart(elementId, data) {
            var ctx = document.getElementById(elementId).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: data
            });
        }

        // Create charts
        createBarChart('userCountChart', {
            labels: userCountByRole.map(row => row.role),
            datasets: [{
                label: 'Count of Users',
                data: userCountByRole.map(row => row.user_count),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        });

        createPieChart('percentageDistributionChart', {
            labels: percentageDistributionByRole.map(row => row.role),
            datasets: [{
                data: percentageDistributionByRole.map(row => row.percentage),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ]
            }]
        });

        createBarChart('roleAggregationsChart', {
            labels: roleAggregations.map(row => row.role),
            datasets: [{
                label: 'Total Phone Numbers',
                data: roleAggregations.map(row => row.total_phone_numbers),
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        });

        createBarChart('roleComparisonsChart', {
            labels: roleComparisons.map(row => row.role),
            datasets: [{
                label: 'Average Number of Phone Numbers',
                data: roleComparisons.map(row => row.avg_numTel),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        });
    </script>
</body>

</html>