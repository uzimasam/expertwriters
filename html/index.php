<?php 
  include 'includes/session.php';
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

    <title>Expert Writers</title>

    <meta name="description" content="online writing" />
    <meta name="keywords" content="Denvis Bookshop, Uzima Samuel, Zalego, Expert Writers, kenya">

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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>
  <?php
    $pid = '1';
    $naw = date('Y-m-d');
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM visitors WHERE vd=:naw AND pid=:pid");
    $stmt->execute(['naw'=>$naw, 'pid'=>$pid]);
    $vro = $stmt->fetch();
    if($vro['numrows'] != 1){
    $stmt = $conn->prepare("INSERT INTO visitors (vd, pid, visits) VALUES (:naw, :pid, :visits)");
    $stmt->execute(['naw'=>$naw, 'pid'=>$pid, 'visits'=>1]);
    }
    else{
        try{
            $stmt = $conn->prepare("SELECT * FROM visitors WHERE vd=:naw AND pid=:pid");
            $stmt->execute(['naw'=>$naw, 'pid'=>$pid]);
            foreach($stmt as $vro){
                $stmt = $conn->prepare("UPDATE visitors SET visits=visits+1 WHERE vid=:vid");
                $stmt->execute(['vid'=>$vro['vid']]);    
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="./" class="app-brand-link">
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
            <li class="menu-item active ">
              <a href="./" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>
            <?php
                        if(isset($_SESSION['user'])){
                            $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
                            echo '
                                <li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="profile" class="menu-link">
                    <div data-i18n="Account">Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="notifications" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="change-password" class="menu-link">
                    <div data-i18n="Connections">Change Password</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Account Settings">Assingments</div>
              </a>
              <ul class="menu-sub">
                            <li class="menu-item">
                              <a href="upload" class="menu-link">
                                <div data-i18n="Pending">Upload</div>
                              </a>
                            </li>
                        ';
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=2 AND cid=".$user['id']);
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="in-progress" class="menu-link">
                                <div data-i18n="In-progress">In-progress</div>
                              </a>
                            </li>
                        ';
                    }
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=3 AND cid=".$user['id']);
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="awaiting-payment" class="menu-link">
                                <div data-i18n="Submitted">Awaiting Payment</div>
                              </a>
                            </li>
                        ';
                    }
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=4 AND cid=".$user['id']);
                    $stmt->execute();
                    $su =  $stmt->fetch();
                    if($su['numrows']!=0){
                        echo'
                            <li class="menu-item">
                              <a href="done" class="menu-link">
                                <div data-i18n="Paid">Complete</div>
                              </a>
                            </li>
                        ';
                    }
                echo'
              </ul>
            </li>
                            ';
                        }
                        else{
                            echo '
            <li class="menu-item ">
              <a href="login" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Analytics">Log-In</div>
              </a>
            </li>
            <li class="menu-item ">
              <a href="register" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Analytics">Register</div>
              </a>
            </li>
                            ';
                        }
                    ?>
            
            <li class="menu-item">
              <a
                href="./"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="mailto:info@expertwriters.com"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Support">info@expertwriters.com</div>
              </a>
            </li>
            <li class="menu-item">
                <a
                    class="menu-link"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasBackdrop"
                    aria-controls="offcanvasBackdrop"
                >
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Subjects">Subjects</div>
                </a>
            <div
                class="offcanvas offcanvas-end"
                tabindex="-1"
                id="offcanvasBackdrop"
                aria-labelledby="offcanvasBackdropLabel"
            >
                <div class="offcanvas-header">
                <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Our Subjects</h5>
                <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                ></button>
                </div>
                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                <p class="text-center">
                    Our Expert writers display profeciency in the following areas.
                </p>
                <hr/>
                      <div class="demo-inline-spacing mt-3">
                        <ol class="list-group list-group-numbered">
                          <?php
                            $stmt = $conn->prepare("SELECT * FROM subjects WHERE id!=5 ORDER BY subject");
                            $stmt->execute();
                            foreach($stmt as $urow){
                                echo '
                                    <li class="list-group-item">'.$urow['subject'].'</li>
                                ';
                            }
                          ?>
                        </ol>
                      </div>
                <p>
                </p>
                <hr/>
                <?php
                    if(isset($_SESSION['user'])){
                        echo'
                            <a href="upload" type="button" class="btn btn-primary mb-2 d-grid w-100">Upload Assingment</a>
                            ';
                    }
                    else{
                        echo'
                            <a href="register" type="button" class="btn btn-primary mb-2 d-grid w-100">Register With Us</a>
                        ';
                    }
                ?>
                <button
                    type="button"
                    class="btn btn-outline-secondary d-grid w-100"
                    data-bs-dismiss="offcanvas"
                >
                    Cancel
                </button>
                </div>
            </div>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <div class="navbar-nav align-items-xl-center me-3 me-xl-0">
              <a class="nav-item nav-link px-0 me-xl-4" href="./">
                Home
              </a>
            </div>
            <div class="navbar-nav align-items-xl-center me-3 me-xl-0">
              <a class="nav-item nav-link px-0 me-xl-4" href="#about">
                About
              </a>
            </div>
            <!--<div class="navbar-nav align-items-xl-center me-3 me-xl-0">
              <a class="nav-item nav-link px-0 me-xl-4" href="#testimonials">
                Testimonials
              </a>
            </div>-->
                
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                <!-- User -->
                <?php
                        if(isset($_SESSION['user'])){
                            $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
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
                            <span class="fw-semibold d-block">'.$user['firstname'].' '.$user['lastname'].'</span>
                            <small class="text-muted">Client</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="profile">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="profile">
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

            <div class="container-xxl flex-grow-1 container-p-y">

              <!-- Examples -->
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card text-center h-100">
                    <img class="card-img-top" src="../assets/img/elements/f.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">We meet Deadlines</h5>
                      <p class="card-text">
                        We do deliver quality work and on time. Do not let no time be a hinderance to good grades
                      </p>
                      <p class="card-text">
                        Time is of essence. That's our guiding principe. 
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card text-center h-100">
                    <img class="card-img-top" src="../assets/img/elements/b.png" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Quality Grades</h5>
                      <p class="card-text">
                        As expert writers, we do value the quality of the work submitted. Be assured of grades A+
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card text-center h-100">
                    <img class="card-img-top" src="../assets/img/elements/d.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Pay via Paypal</h5>
                      <p class="card-text">
                        Issues with payment, worry not ;) <br>We have integrated our system to process paypal payments.</p><p class="card-text"> Our clients receive their work via email as soon as complete payment is received.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Examples -->
              <hr id="about" class="my-5" />

              <!-- Horizontal -->
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EW Home /</span> How it Works</h4>
              <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step One</h5>
                          <p class="card-text">
                            <a href="register">Register</a> with us on our website.
                          <br>
                            Ensure to submit your correct details as required on the <a href="register"> registration form</a>. After registration, check your email to activate your account.
                          </p>
                        </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step Two</h5>
                          <p class="card-text">
                            After activating your account, proceed to the <a href="login">login section</a> to access your account.
                            Loging in takes you to your <a href="profile">profile</a> where you can update your credentials.
                          </p>
                        </div>
                  </div>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step Three</h5>
                          <p class="card-text">
                            To<a href="upload"> upload assingments</a> with us, proceed to the <a href="upload">upload section</a>
                            Ensure you submit all correct details for the given assingment. An email will immediately be sent to you to confirm your upload.
                          </p>
                        </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step Four</h5>
                          <p class="card-text">
                            One of our expert writers, specialised in the particular subject of your assingment will send you a quotation.
                            Upon agreement, the writer is obliged to start working on your assingment.
                          </p>
                        </div>
                  </div>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step Five</h5>
                          <p class="card-text">
                            After the writer is done, the assingment is uploaded back to the system.
                          A prompt is immediately sent to your email notifying you that the job is done.
                          </p>
                        </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title">Step Six</h5>
                          <p class="card-text">
                            You now have to pay for the assingment via the details sent to your email. Upon payment, the work done is automatically sent to your email by the system.
                          </p>
                        </div>
                  </div>
                </div>
              </div>
              <!--/ Horizontal 
              <hr id="testimonials" class="my-5" />

               Style variation 
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EW Home /</span> Client Testimonials</h4>
              <div id="carouselExample" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                      <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                      <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">

              <div class="row">
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>Nice work..</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-secondary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Olives Matei in <cite title="Source Title">Kabarak University</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
              </div>
                      </div>
                      <div class="carousel-item">
                        
              <div class="row">
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-warning text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
              </div>
                      </div>
                      <div class="carousel-item">
                        
              <div class="row">
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-success text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-primary text-white text-center mb-3">
                    <div class="card-body">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
              </div>
                      </div>
                    </div>
                  </div>
              <!--/ Style variation --
            </div>
             Content -->
              <hr class="my-5" />

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Expert Writers</a>
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

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
  </body>
</html>
