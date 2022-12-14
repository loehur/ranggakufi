<?php
if (isset($data['pageInfo'])) {
  $title = $data['pageInfo']['title'];
} else {
  $title = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="<?= $this->ASSETS_URL ?>icon/logoCB.png">
  <title><?= $title ?> | CP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>css/ionicons.min.css">
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/adminLTE-3.1.0/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/select2/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>css/selectize.bootstrap3.min.css" rel="stylesheet" />

  <style>
    @font-face {
      font-family: 'Titillium Web';
      font-style: normal;
      font-weight: 400;
      font-display: swap;
      src: url('<?= $this->ASSETS_URL ?>font/titilium.woff2') format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    .content-wrapper {
      max-height: 100px;
      overflow: auto;
      display: inline-block;
    }

    html .table {
      font-family: 'Titillium Web', sans-serif;
    }

    html .content {
      font-family: 'Titillium Web', sans-serif;
    }

    html body {
      font-family: 'Titillium Web', sans-serif;
    }

    @media print {
      p div {
        font-family: 'Titillium Web', sans-serif;
        font-size: 14px;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini small">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link refresh" href="#">
            <span id="spinner" role="status" aria-hidden="true"></span>
            Synchrone
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= $this->BASE_URL ?>Login/logout" role="button">
            LogOut
          </a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <span class="btn btn-sm btn-secondary"><?= $this->nama_user . "<br><small>" . strtoupper($_SESSION['userTipe']) . "#" . $this->id_user . "#" . $this->admin . "-" . $this->privilege . "</small>"
                                                    ?><br><?= $this->userDVC ?></span>
          </div>
        </div>

        <nav>
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
              <a href="<?= $this->BASE_URL ?>" class="nav-link 
              <?= ($title == 'Home') ? 'active' : "" ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>

            <?php
            switch ($_SESSION['userTipe']) {
              case "admin":
              case "management":
              case "cs":
              case "staff":
              case "tl":
              case "om":
            ?>
                <li class="nav-item 
                <?php if (strpos($title, 'CS Problem') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
                  <a href="#" class="nav-link 
                <?php if (strpos($title, 'CS Problem') !== FALSE) {
                  echo 'active';
                } ?>">
                    <i class="nav-icon fas fa-exclamation-circle"></i>
                    <p>
                      CS Problem
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'CS Problem') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>CS_Problem/i/1" class="nav-link 
                    <?php if ($title == 'Delay Process - CS Problem') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Delay Process
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>CS_Problem/i/2" class="nav-link 
                    <?php if ($title == 'Delay Solved - CS Problem') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Delay Solved
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>CS_Problem/i/3" class="nav-link 
                    <?php if ($title == 'Delay Rejected - CS Problem') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Delay Rejected
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>CS_Problem/result" class="nav-link 
                    <?php if ($title == 'Delay Result - CS Problem') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Delay Result
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>CS_Problem/check_main" class="nav-link 
                    <?php if ($title == 'Delay Checking - CS Problem') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Delay Checking
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
            <?php
                break;
            } ?>

            <?php
            switch ($_SESSION['userTipe']) {
              case "admin":
              case "management":
              case "staff":
              case "tl":
              case "om":
              case "qc":
            ?>
                <li class="nav-item 
                <?php if (strpos($title, 'SP ') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
                  <a href="#" class="nav-link 
                <?php if (strpos($title, 'SP ') !== FALSE) {
                  echo 'active';
                } ?>">
                    <i class="nav-icon fas fa-envelope-open-text"></i>
                    <p>
                      Surat Peringatan
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'SP ') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>SP/i/1" class="nav-link 
                    <?php if ($title == 'SP - Active') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Active
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>SP/i/2" class="nav-link 
                    <?php if ($title == 'SP - Historical') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Historical
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item 
                <?php if (strpos($title, 'Relief') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
                  <a href="#" class="nav-link 
                <?php if (strpos($title, 'Relief') !== FALSE) {
                  echo 'active';
                } ?>">
                    <i class="nav-icon fas fa-pray"></i>
                    <p>
                      Relief
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'Relief') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>Relief" class="nav-link 
                    <?php if ($title == 'Relief - On Going') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          On going
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>Relief" class="nav-link 
                    <?php if ($title == 'Relief - Done') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Done
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
            <?php
                break;
            } ?>

            <li class="nav-item ">
              <a href="<?= $this->BASE_URL ?>WA_Check" class="nav-link 
              <?php if ($title == 'WA Check') : echo 'active';
              endif ?>">
                <i class="nav-icon fas fa-check-double"></i>
                <p>
                  Whatsapp Number Check
                </p>
              </a>
            </li>


            <li class="nav-item ">
              <a href="<?= $this->BASE_URL ?>Profil" class="nav-link 
              <?php if ($title == 'Profil') : echo 'active';
              endif ?>">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                  Profil
                </p>
              </a>
            </li>

            <li class="nav-header">DATA REPORT</li>
            <li class="nav-item 
                <?php if (strpos($title, 'Report - Hourly') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
              <a href="#" class="nav-link 
                <?php if (strpos($title, 'Report - Hourly') !== FALSE) {
                  echo 'active';
                } ?>">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                  Hourly
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'Report - Hourly') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                <li class="nav-item">
                  <a href="<?= $this->BASE_URL ?>Report_Hourly/trend_main" class="nav-link 
                    <?php if ($title == 'Report - Hourly Trend') {
                      echo 'active';
                    } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Trend
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= $this->BASE_URL ?>Report_Hourly/staff_tl_main" class="nav-link 
                    <?php if ($title == 'Report - Hourly Staff/TL') {
                      echo 'active';
                    } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Staff & TL/OM
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= $this->BASE_URL ?>Report_Hourly/om_main" class="nav-link 
                    <?php if ($title == 'Report - Hourly OM') {
                      echo 'active';
                    } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      OM
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- <div class="spinner-grow spinner-grow-sm" role="status"></div> Under Contruction... -->

            <li class="nav-item 
                <?php if (strpos($title, 'Report - Daily') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
              <a href="#" class="nav-link 
                <?php if (strpos($title, 'Report - Daily') !== FALSE) {
                  echo 'active';
                } ?>">
                <i class="nav-icon fas fa-calendar-day"></i>
                <p>
                  Daily
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'Report - Daily') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                <li class="nav-item">
                  <a href="<?= $this->BASE_URL ?>Report_Daily/trend_main" class="nav-link 
                    <?php if ($title == 'Report - Daily Trend') {
                      echo 'active';
                    } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Trend
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= $this->BASE_URL ?>Report_Daily/staff_tl_main" class="nav-link 
                  <?php if ($title == 'Report - Daily Staff/TL') {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Staff & TL/OM
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item ">
              <a href="<?= $this->BASE_URL ?>Report_Weekly/weekly_main" class="nav-link 
              <?php if ($title == 'Report - Weekly') : echo 'active';
              endif ?>">
                <i class="nav-icon fas fa-calendar-week"></i>
                <p>
                  Weekly
                </p>
              </a>
            </li>
            <li class="nav-item ">
              <a href="<?= $this->BASE_URL ?>Report_Monthly/monthly_main" class="nav-link 
              <?php if ($title == 'Report - Monthly') : echo 'active';
              endif ?>">
                <i class="nav-icon far fa-calendar"></i>
                <p>
                  Monthly
                </p>
              </a>
            </li>

            <?php if ($this->privilege == 100) { ?>
              <li class="nav-header">ADMIN PANEL</li>
              <li class="nav-item ">
                <a href="<?= $this->BASE_URL ?>Upload/upload_main" class="nav-link 
                  <?php if ($title == 'Upload') {
                    echo 'active';
                  } ?>">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>
                    Upload Data
                  </p>
                </a>
              </li>


              <li class="nav-item 
                <?php if (strpos($title, 'Raw') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
                <a href="#" class="nav-link 
                <?php if (strpos($title, 'Raw') !== FALSE) {
                  echo 'active';
                } ?>">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Raw Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'Raw') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/1" class="nav-link 
                    <?php if ($title == 'Raw Hourly') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Hourly
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/2" class="nav-link 
                    <?php if ($title == 'Raw Daily') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Daily
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/cs" class="nav-link 
                    <?php if ($title == 'Raw CS') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Customer Service
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/qc" class="nav-link 
                    <?php if ($title == 'Raw QC') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Quality Control
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/staff" class="nav-link 
                    <?php if ($title == 'Raw Staff') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/tl" class="nav-link 
                    <?php if ($title == 'Raw Team Leader') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Team Leader
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $this->BASE_URL ?>Raw_Data/i/om" class="nav-link 
                    <?php if ($title == 'Raw Operation Manager') {
                      echo 'active';
                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Operation Manager
                      </p>
                    </a>
                  </li>
                </ul>
              </li>


              <?php if ($this->admin == 1) { ?>
                <li class="nav-item ">
                  <a href="<?= $this->BASE_URL ?>User" class="nav-link 
                  <?php if ($title == 'User') {
                    echo 'active';
                  } ?>">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                      User
                    </p>
                  </a>
                </li>

                <li class="nav-item 
                <?php if (strpos($title, 'Upload List') !== FALSE) {
                  echo 'menu-is-opening menu-open';
                } ?>">
                  <a href="#" class="nav-link 
                <?php if (strpos($title, 'Upload List') !== FALSE) {
                  echo 'active';
                } ?>">
                    <i class="nav-icon fas fa-file-import"></i>
                    <p>
                      Upload List
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: 
                <?php if (strpos($title, 'Upload List') !== FALSE) {
                  echo 'block;';
                } else {
                  echo 'none;';
                } ?>">
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>Upload_List/i/1" class="nav-link 
                    <?php if ($title == 'Hourly - Upload List') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Hourly
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $this->BASE_URL ?>Upload_List/i/2" class="nav-link 
                    <?php if ($title == 'Daily - Upload List') {
                      echo 'active';
                    } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Daily
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper pt-2">
      <script src="<?= $this->ASSETS_URL ?>plugins/jquery/jquery.min.js"></script>
      <script src="<?= $this->ASSETS_URL ?>plugins/adminLTE-3.1.0/js/adminlte.js"></script>
      <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script>
        $(document).ready(function() {
          $("a.refresh").on('click', function() {
            $.ajax('<?= $this->BASE_URL ?>User/synchrone', {
              beforeSend: function() {
                $('span#spinner').addClass('spinner-border spinner-border-sm');
              },
              success: function(data, status, xhr) {
                location.reload(true);
              }
            });
          });
        });
      </script>