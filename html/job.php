<?php 
  include 'includes/asession.php';
  include 'includes/format.php'; 
  $conn = $pdo->open();
  if(isset($_GET['key'])){
        $aid=$_GET['key'];
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE id=:aid");
        $stmt->execute(['aid'=>$aid]);
        $urow =  $stmt->fetch();
        $cid = $urow['cid'];
        $stmt = $conn->prepare("SELECT * FROM watu WHERE id=:cid");
        $stmt->execute(['cid'=>$cid]);
        $user =  $stmt->fetch();
        $imae = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
        if($urow['numrows']!=1){
            header('location: assingments');
            $_SESSION['error'] = 'You are prohibited from viewing the job';
        }
  }
  else{
		$_SESSION['error'] = 'Select job to view';
        header('location: assingments');
  }
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

    <title><?php echo $user['firstname'].' '.$user['lastname']?> - Client - Expert Writers</title>

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
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-icons.css" />
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
            <li class="menu-item">
              <a href="clients" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Clients">Clients</div>
              </a>
            </li>
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Assingments">Assingments</div>
              </a>

              <ul class="menu-sub">
                <?php
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=1 and cid !=0");
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
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=2 and cid !=0");
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
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=3 and cid !=0");
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
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM kazi WHERE status=4 and cid !=0");
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">EW /</span> 
                <?php 
                    $stmt = $conn->prepare("SELECT * FROM kazi WHERE id =".$aid." and cid =".$cid);
                    $stmt->execute();
                    $urow =  $stmt->fetch();
                    echo $urow['Title']
                                ?></h4>


                  <!-- HTML5 Inputs -->
                  <h6 class="text-muted"><?php
                            $conn = $pdo->open();
                            try{
                                $no = 1;
                                $stmt = $conn->prepare("SELECT * FROM kazi WHERE id =".$aid);
                                $stmt->execute();
                                foreach($stmt as $row){
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
                                        $stat
                                    ";
                                }
                            }
                            catch(PDOException $e){
                                echo $e->getMessage();
                            }  
                            $pdo->close();
                        ?> </h6>
                  <div class="nav-align-top mb-4">
                    <ul class="nav  nav-tabs nav-fill" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-justified-home"
                          aria-controls="navs-justified-home"
                          aria-selected="true"
                        >
                          <i class="tf-icons bx bx-pen"></i> Timeline
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-justified-profile"
                          aria-controls="navs-justified-profile"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-box"></i> Details
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-justified-messages"
                          aria-controls="navs-justified-messages"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-message-square"></i> Messages
                          <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">
                            <?php
                               $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM chat WHERE aid =".$aid." and cid =".$cid." and chec=0 and level=0");
                               $stmt->execute();     
                               $urow =  $stmt->fetch();
                               echo $urow['numrows']
                            ?>
                          </span>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                        <div class="list-group">
                              <?php
                               $stmt = $conn->prepare("SELECT * FROM kazi WHERE id =".$aid);
                               $stmt->execute();     
                               $pow =  $stmt->fetch();
                              ?>
                          <a
                            href="javascript:void(0);"
                            class="list-group-item list-group-item-action flex-column align-items-start active"
                          >
                            <div class="d-flex justify-content-between w-100">
                              <h6>Uploaded</h6>
                              <small>3 days ago</small>
                            </div>
                            <p class="mb-1">
                              The job's due date is <?php echo date('d M Y', strtotime($pow['Duetime'])).' at '.date('h.ia', strtotime($pow['Duetime']))?>.
                            </p>
                            <small>3 days 5h 30mins from now.</small>
                          </a>
                          <a
                            href="javascript:void(0);"
                            class="list-group-item list-group-item-action flex-column align-items-start"
                          >
                            <div class="d-flex justify-content-between w-100">
                              <h6>Quotation</h6>
                              <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">
                              <form method="POST" action="sq.php">
                                <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                          type="text"
                          class="form-control"
                          name="Amount"
                          placeholder="<?php echo $pow['Amount']?>"
                          value="<?php echo $pow['Amount']?>"
                          aria-label="Amount (to the nearest dollar)"
                        />
                        <span class="input-group-text">.00</span>
                        <input hidden value="<?php echo $aid?>" name="key" required id="key" type="text"/>
                        <button class="btn btn-secondary" type="submit" id="sq" name="sq">Submit Quotation</button>
                        <button class="btn btn-danger" type="reset" id="inputGroupFileAddon04">Reset</button>
                      </div>
                                </form>
                            </p>
                            <small>Paying details will be sent to client upon job completion.</small>
                          </a>
                        <?php 
                            if($pow['status']>1)
                                {
                                    echo '
                                      <a
                                        href="javascript:void(0);"
                                        class="list-group-item list-group-item-action flex-column align-items-start active"
                                      >
                                        <div class="d-flex justify-content-between w-100">
                                          <h6>Submission</h6>
                                          <small>3 days ago</small>
                                        </div>
                                        <form method="POST" action="sub.php"  enctype="multipart/form-data">
                                            <p class="mb-1">
                                                <div class="input-group">
                                                    <input
                                                        type="file"
                                                        class="form-control"
                                                        id="submissions"
                                                        name="submissions[]"
                                                        required
                                                        aria-label="Upload"
                                                        multiple
                                                    />
                                                    <input hidden value="'.$aid.'" name="aid" required id="aid" type="text"/>
                                                    <button class="btn btn-secondary" type="submit" name="subs" id="inputGroupFileAddon04">Submit Files to client</button>
                                                    <button class="btn btn-danger" type="reset">Discard</button>
                                                </div>
                                            </p>
                                        </form>
                                        <small>The files you upload will be submitted as your work done.</small>
                                      </a>
                                    ';
                                }
                        ?>
                        <?php 
                            if($pow['status']>2)
                                {
                                    echo '
                                      <a
                                        href="javascript:void(0);"
                                        class="list-group-item list-group-item-action flex-column align-items-start"
                                      >
                                        <div class="d-flex justify-content-between w-100">
                                          <h6>Payment</h6>
                                          <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">
                                          Payment amounting to USD '.$pow['Amount'].'.00 has been received.
                                        </p>
                                        <small>Check your paypal account '.$admin['enail'].' <span class="text-primary"><i class="bx bxl-paypal"></i></span> </small>
                                      </a>
                                    ';
                                }
                            ?>
                            <?php 
                            if($pow['status']>3)
                                {
                                    echo '
                                  <a
                                    href="javascript:void(0);"
                                    class="list-group-item list-group-item-action flex-column align-items-start active"
                                  >
                                    <div class="d-flex justify-content-between w-100">
                                        <h6>Review</h6>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">
                                      Your client has reviewed the work done.
                                    </p>
                                    <small>Your have received <span class="text-warning"><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star-half"></i></span></small>
                                  </a>
                                  <a
                                    href="javascript:void(0);"
                                    class="list-group-item list-group-item-action flex-column align-items-start"
                                  >
                                    <div class="d-flex justify-content-between w-100">
                                      <h6>Completion</h6>
                                      <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">
                                      The writing process for this job is done.
                                    </p>
                                    <small>Bravo <i class="bx bxs-happy text-warning"></i></small>
                                  </a>
                                  ';
                                }
                            ?>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="demo-inline-spacing mt-3">
                                <div class="list-group">
                                    <?php 
                                        $stmt = $conn->prepare("SELECT * FROM kazi WHERE id =".$aid." and cid =".$cid);
                                        $stmt->execute();
                                        $urow =  $stmt->fetch();
                                        $myra = explode(',', $urow['links']);
                                        function get_title($url){
                                                        $str = file_get_contents($url);
                                                        if(strlen($str)>0){
                                                            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                                                            preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
                                                            return $title[1];
                                                        }
                                                    }
                                                    
                                        $sub = $urow['Subject'];
                                        $stmt = $conn->prepare("SELECT subject as somo FROM subjects WHERE id =".$urow['Subject']);
                                        $stmt->execute();
                                        $sub =  $stmt->fetch();
                                        
                                        echo '
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Title</label>
                                                  <div class="col-sm-10 alert alert-info col-form-label" role="alert">'.$urow['Title'].'</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Subject</label>
                                                  <div class="col-sm-10 alert alert-dark" role="alert">'.$sub['somo'].'</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Time Posted</label>
                                                  <div class="col-sm-10 alert alert-info" role="alert">'.$urow['timeposted'].'</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Due Time</label>
                                                  <div class="col-sm-10 alert alert-dark" role="alert">'.$urow['Duetime'].'</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Status</label>
                                                  <div class="col-sm-10 alert alert-info" role="alert">'.$stat.'</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Amount</label>
                                                  <div class="col-sm-10 alert alert-dark" role="alert">'.$urow['Amount'].'.00 USD</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">External Links</label>
                                                  <div class="col-sm-10 alert alert-info" role="alert">';
                                                  foreach ($myra as $value) {
                                                    echo '<a target="_blank" href="'.$value.'">'.get_title(str_replace(' ', '', $value)).'</a><br/>';
                                                  }
                                                  echo '</div>
                                              </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Attached Files</label>
                                                  <div class="col-sm-10 alert d-flex flex-wrap alert-dark" id="icons-container" role="alert">
                                                        ';
                                                        $stmt = $conn->prepare("SELECT * FROM upload WHERE aid =".$aid);
                                                        $stmt->execute();
                                                        foreach($stmt as $row){
                                                            $path = $row['attachments'];
                                                            $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                            echo "
                                                                <a class='text-dark' target='_blank' href='docs/".$row['attachments']."'>
                                                                <div class='card icon-card cursor-pointer text-center mb-4 mx-2'>
                                                                    <div class='card-body'>
                                                            ";
                                                            if($extension=='mp3'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-music mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='wav'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-music mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='jpg'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-jpg mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='pdf'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-pdf mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='png'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-png mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='txt'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-txt mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='json'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-json mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='js'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-js mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='pdf'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-pdf mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='html'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-html mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='gif'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-gif mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='doc'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-doc mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='css'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-css mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='zip'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='rar'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='archive'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='mp4'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-video mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='mkv'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-video mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='xlsx'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-spreadsheet mb-2'></i>
                                                                ";
                                                            }
                                                            else{
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-file mb-2'></i>
                                                                ";
                                                            }
                                                            echo "
                                                                        <p class='icon-name text-capitalize text-truncate mb-0'>".$row['attachments']."</p>
                                                                    </div>
                                                                </div></a>
                                                            ";
                                                        }
                                                  ?>
                                                  </div>
                                              </div>
                                              <?php echo'
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Submitted Work</label>
                                                  <div class="col-sm-10 alert d-flex flex-wrap alert-dark" id="icons-container" role="alert">
                                                        ';
                                                        $stmt = $conn->prepare("SELECT * FROM subs WHERE aid =".$aid);
                                                        $stmt->execute();
                                                        foreach($stmt as $row){
                                                            $path = $row['submissions'];
                                                            $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                            echo "
                                                                <a class='text-dark' target='_blank' href='subs/".$row['submissions']."'>
                                                                <div class='card icon-card cursor-pointer text-center mb-4 mx-2'>
                                                                    <div class='card-body'>
                                                            ";
                                                            if($extension=='mp3'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-music mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='wav'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-music mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='jpg'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-jpg mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='pdf'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-pdf mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='png'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-png mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='txt'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-txt mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='json'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-json mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='js'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-js mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='pdf'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-pdf mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='html'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-html mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='gif'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-gif mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='doc'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-doc mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='css'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-css mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='zip'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='rar'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='archive'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bxs-file-archive mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='mp4'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-video mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='mkv'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-video mb-2'></i>
                                                                ";
                                                            }
                                                            elseif($extension=='xlsx'){
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-spreadsheet mb-2'></i>
                                                                ";
                                                            }
                                                            else{
                                                                echo"
                                                                <i class='bx bx-tada-hover bx-file mb-2'></i>
                                                                ";
                                                            }
                                                            echo "
                                                                        <p class='icon-name text-capitalize text-truncate mb-0'>".$row['submissions']."</p>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            ";
                                                        }
                                                  ?>
                                              </div>
                                        </div>
                                        
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                        <?php 
                            $stmt = $conn->prepare("SELECT * FROM kazi WHERE cid !=0 and id =".$aid);
                            $stmt->execute();
                            foreach($stmt as $yrow){
                                echo '
                                    <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-1 text-right">
                                                <p
                                                      data-bs-toggle="tooltip"
                                                      data-popup="tooltip-custom"
                                                      data-bs-placement="top"
                                                      class="avatar avatar-xs pull-up"
                                                      title="'.$user['firstname'].' '.$user['lastname'].'"
                                                >                            
                                                      <img src="'.$imae.'" alt="Avatar" class="rounded-circle" />
                                                </p> 
                                                  <small class="text-muted">'.date('d/M', strtotime($yrow['timeposted'])).'</small>
                                                  <small class="text-muted">'.date('h:ia', strtotime($yrow['timeposted'])).'</small>
                                            </div>
                                            <div class="col-1"></div>
                                            <div class="col-8 pull-right alert alert-dark" role="alert">'.$yrow['notes'].'</div>
                                            <hr/>
                                    </div>
                                ';
                            }
                        ?>
                        <?php 
                            $stmt = $conn->prepare("SELECT * FROM chat WHERE aid=:aid and cid=:cid");
                            $stmt->execute(['aid'=>$aid, 'cid'=>$cid]);
                            foreach($stmt as $yrow){
                                if($yrow['level']==0){
                                    echo '
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-1 text-right">
                                                <p
                                                      data-bs-toggle="tooltip"
                                                      data-popup="tooltip-custom"
                                                      data-bs-placement="top"
                                                      class="avatar avatar-xs pull-up"
                                                      title="'.$user['firstname'].' '.$user['lastname'].'"
                                                >                            
                                                      <img src="'.$imae.'" alt="Avatar" class="rounded-circle" />
                                                </p> 
                                                  <small class="text-muted">'.date('d/M', strtotime($yrow['time'])).'</small>
                                                  <small class="text-muted">'.date('h:ia', strtotime($yrow['time'])).'</small>
                                            </div>
                                            <div class="col-1"></div>
                                            <div class="col-8 pull-right alert alert-dark" role="alert">'.$yrow['message'].'</div>
                                            <hr/>
                                        </div>
                                    ';
                                }
                                else{
                                    $stmt = $conn->prepare("SELECT * FROM watu WHERE id =".$yrow['level']);
                                    $stmt->execute();
                                    $urow =  $stmt->fetch();
                                    $ima = (!empty($urow['photo'])) ? 'images/'.$urow['photo'] : 'images/profile.jpg';
                                    echo '
                                        <div class="row">
                                             <div class="col-1"></div>
                                            <div class="col-8 pull-right alert alert-primary" role="alert">'.$yrow['message'].'</div>
                                            <div class="col-1"></div>
                                            <div class="col-1 text-right">
                                                <p
                                                      data-bs-toggle="tooltip"
                                                      data-popup="tooltip-custom"
                                                      data-bs-placement="top"
                                                      class="avatar avatar-xs pull-up"
                                                      title="'.$urow['firstname'].' '.$urow['lastname'].'"
                                                >
                                                      <img src="'.$ima.'" alt="Avatar" class="rounded-circle" />
                                                </p> 
                                                <small class="text-muted">'.date('d/M', strtotime($yrow['time'])).'</small>
                                                <small class="text-muted">'.date('h:ia', strtotime($yrow['time'])).'</small>
                                            </div>
                                            <hr/>
                                        </div>
                                    ';
                                }
                            }
                        ?>
                        <form method="POST" action="jobchat.php">
                          <div class="input-group">
                            <input
                              type="text"
                              name="message"
                              id="message"
                              required
                              class="form-control"
                              placeholder="Type message to send to your client..."
                              aria-label="Type message to send to your client..."
                              aria-describedby="button-addon2"
                            />
                            <input hidden value="<?php echo $aid?>" name="key" required id="key" type="text"/>
                            <input hidden value="<?php echo $cid?>" name="cid" required id="cid" type="text"/>
                            <button class="btn btn-outline-primary" name="asschat" type="submit" id="button-addon2">Send</button>
                          </div>
                        </form>
                      </div>
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
                  <a href="./" target="_blank" class="footer-link fw-bolder">Expert Writers</a>
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
