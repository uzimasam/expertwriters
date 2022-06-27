<?php 
  include 'includes/asession.php';
  include 'includes/format.php'; 
?>
<?php 
  $today = date('Y-m-d');
  $tarehe = date('M d');
  $siku = date('l');
  $yesterday = date('Y-m-d',strtotime("-1 days"));
  $year = date('Y');
  if(isset($_GET['crd'])){
    $cid = $_GET['crd'];
  }
  else{
        $_SESSION['error'] = 'Select Client to view first';
        header('location: clients');
  }
  $conn = $pdo->open();
  $stmt = $conn->prepare("SELECT * FROM watu WHERE id=$cid");
  $stmt->execute();
  $crd =  $stmt->fetch();
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php echo $crd['firstname'].' '.$crd['lastname']?> - Client - Expert Writers</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
     <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
  
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="admin" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"
                    ></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"
                    ></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"
                    ></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Expert Writers</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="aprofile" class="menu-link">
                    <div data-i18n="Account">Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="anotifications" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="achangepassword" class="menu-link">
                    <div data-i18n="Connections">Change Password</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Layouts -->
            <li class="menu-item active open">
              <a href="clients" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Clients">Clients</div>
              </a>
            </li>
            <li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Assingments">Assingments</div>
              </a>

              <ul class="menu-sub">
                <?php
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=1");
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="pending-assingments" class="menu-link">
                                <div data-i18n="Pending">Pending</div>
                              </a>
                            </li>
                        ';
                    }
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=2");
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="in-progress-assingments" class="menu-link">
                                <div data-i18n="In-progress">In-progress</div>
                              </a>
                            </li>
                        ';
                    }
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=3");
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="submitted-assingments" class="menu-link">
                                <div data-i18n="Submitted">Submitted</div>
                              </a>
                            </li>
                        ';
                    }
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=4");
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="paid-assingments" class="menu-link">
                                <div data-i18n="Paid">Paid</div>
                              </a>
                            </li>
                        ';
                    }
                ?>
              </ul>
            </li>
            <li class="menu-item">
                <a href="transactions" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                    <div data-i18n="Transactions">Transactions</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="subjects" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-alt"></i>
                    <div data-i18n="Subjects">Subjects</div>
                </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                
                <!-- User -->
                <?php
                        if(isset($_SESSION['admin'])){
                            $image = (!empty($admin['photo'])) ? 'images/'.$admin['photo'] : 'images/profile.jpg';
                            echo '
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="'.$image.'" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="'.$image.'" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">'.$admin['firstname'].' '.$admin['lastname'].'</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="aprofile">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="admin.html">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Messages
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                            ';
                        }
                        else{
                            echo '
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link" href="javascript:void(0);">
                    <div class="avatar app-brand-logo demo">
                        <svg
                            width="25"
                            viewBox="0 0 25 42"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                            <defs>
                            <path
                                d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                id="path-1"
                            ></path>
                            <path
                                d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                id="path-3"
                            ></path>
                            <path
                                d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                id="path-4"
                            ></path>
                            <path
                                d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                id="path-5"
                            ></path>
                            </defs>
                            <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                    <mask id="mask-2" fill="white">
                                    <use xlink:href="#path-1"></use>
                                    </mask>
                                    <use fill="#696cff" xlink:href="#path-1"></use>
                                    <g id="Path-3" mask="url(#mask-2)">
                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                    </g>
                                    <g id="Path-4" mask="url(#mask-2)">
                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                    </g>
                                </g>
                                <g
                                    id="Triangle"
                                    transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                                >
                                    <use fill="#696cff" xlink:href="#path-5"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                </g>
                                </g>
                            </g>
                            </g>
                        </svg>
                    </div>
                  </a>
                </li>
                            ';
                        }
                    ?>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="content-wrapper">
            <!-- Content -->
            <?php
                    if(isset($_SESSION['error'])){
                        echo "
                            <div
                                class='bs-toast toast show dis fade toast-placement-ex top-50 start-50 translate-middle  bg-danger m-2'
                                role='alert'
                                aria-live='assertive'
                                aria-atomic='true'
                            >
                                <div class='toast-header'>
                                    <i class='bx bx-bell me-2'></i>
                                    <div class='me-auto fw-semibold'>Expert Writers</div>
                                    <small>Just now</small>
                                    <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                                </div>
                                <div class='toast-body'>".$_SESSION['error']."</div>
                            </div>
                        ";
                        unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['success'])){
                        echo "
                            <div
                                class='bs-toast toast show dis fade toast-placement-ex top-50 start-50 translate-middle  bg-success m-2'
                                role='alert'
                                aria-live='assertive'
                                aria-atomic='true'
                            >
                                <div class='toast-header'>
                                    <i class='bx bx-bell me-2'></i>
                                    <div class='me-auto fw-semibold'>Expert Writers</div>
                                    <small>Just now</small>
                                    <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                                </div>
                                <div class='toast-body'>".$_SESSION['success']."</div>
                            </div>
                        ";
                        unset($_SESSION['success']);
                    }
                ?>
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Clients /</span> <?php echo $crd['firstname'].' '.$crd['lastname']?></h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <form enctype="multipart/form-data" id="formAccountSettings" action="profile_edit.php" method="POST">
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                <?php 
                                    $imae = (!empty($crd['photo'])) ? 'images/'.$crd['photo'] : 'images/profile.jpg';
                                    echo' src="'.$imae.'"';
                                ?>
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                            />
                            <div class="button-wrapper">
                              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                              </label>
                              <input
                                  <input
                                  type="file"
                                  id="upload"
                                  class="account-file-input"
                                  hidden
                                  name="photo"
                                  accept="image/png, image/jpeg"
                                />
                              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                              </button>
                              <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 800K</p>
                            </div>
                          </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="firstname" class="form-label">First Name</label>
                                <input
                                  class="form-control"
                                  type="text"
                                  id="firstname"
                                  name="firstname"
                                  <?php echo' value="'.$crd['firstname'].'"';?>
                                  autofocus
                                />
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="lastname" id="lastname" 
                                  <?php echo' value="'.$crd['lastname'].'"';?>
                                />
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                  class="form-control"
                                  type="text"
                                  id="email"
                                  name="email"
                                  <?php echo' value="'.$crd['email'].'"';?>
                                  placeholder="Enter a valid email address"
                                />
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="timeZones" class="form-label">Timezone</label>
                                <select id="timeZones" class="select2 form-select">
                                  <option value="">Select Timezone</option>
                                  <option value="-12">(GMT-12:00) International Date Line West</option>
                                  <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                  <option value="-10">(GMT-10:00) Hawaii</option>
                                  <option value="-9">(GMT-09:00) Alaska</option>
                                  <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                  <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                  <option value="-7">(GMT-07:00) Arizona</option>
                                  <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                  <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                  <option value="-6">(GMT-06:00) Central America</option>
                                  <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                  <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                  <option value="-6">(GMT-06:00) Saskatchewan</option>
                                  <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                  <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                  <option value="-5">(GMT-05:00) Indiana (East)</option>
                                  <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                  <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                                </select>
                              </div>
                            </div>
                            <div class="mt-2">
                              <button name="ediht" class="btn btn-primary me-2">Save changes</button>
                              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /Account -->
                  </div>
                  <?php
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE cid =".$cid);
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                          <div class="card">
                            <h5 class="card-header">Client assingments</h5>
                            <div class="card-body">
                              <div class="table-responsive text-nowrap">
                                  <table class="table table-hover table-bordered">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Assingment Title</th>
                                        <th>Subject</th>
                                        <th>Due Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        ';$conn = $pdo->open();
                                            try{
                                                $no = 1;
                                                $stmt = $conn->prepare("SELECT * FROM kazi WHERE cid =".$cid);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                    $sub = $row['Subject'];
                                                    $stmt = $conn->prepare("SELECT subject as somo FROM subjects WHERE id =".$row['Subject']);
                                                    $stmt->execute();
                                                    $sub =  $stmt->fetch();
                                                    if($row['status']==1)
                                                        {
                                                            $stat = "<span class='badge bg-label-warning me-1'>Pending</span>";
                                                        }
                                                    if($row['status']==2)
                                                        {
                                                            $stat = "<span class='badge bg-label-primary me-1'>In Progress</span>";
                                                        }
                                                    if($row['status']==3)
                                                        {
                                                            $stat = "<span class='badge bg-label-info me-1'>Awaiting Payment</span>";
                                                        }
                                                    if($row['status']==4)
                                                        {
                                                            $stat = "<span class='badge bg-label-success me-1'>Complete</span>";
                                                        }
                                                    echo "
                                                        <tr>
                                                            <td>".$no++."</td>
                                                            <td><i class='fab fa-react fa-lg text-info me-3'></i> <strong>".$row['Title']."</strong></td>
                                                            <td>".$sub['somo']."</td>
                                                            <td>".$row['Duetime']." Hrs</td>
                                                            <td>".$stat."</td>
                                                            <td>
                                                                <div class='dropdown'>
                                                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                                        <i class='bx bx-dots-vertical-rounded'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu'>
                                                                        <a class='dropdown-item' href='job?key=".$row['id']."'>
                                                                            <i class='bx bx-check me-1'></i>
                                                                            View
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    ";
                                                }
                                            }
                                            catch(PDOException $e){
                                                echo $e->getMessage();
                                            }  
                                            $pdo->close();
                                        echo '
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        ';
                    }
                  ?>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  �
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  <a href="./" class="footer-link fw-bolder">Expert Writers</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
      <a
        href=""
        class="btn btn-danger btn-buy-now"
        >We Are Expert Writers</a
      >
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>
    <script src="../assets/js/pages-account-settings-account.js"></script>
    <script>
        $(".dis").delay(4200).fadeOut(400);
    </script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
