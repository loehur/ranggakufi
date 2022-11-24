<?php
class Login extends Controller
{
   public function index()
   {
      if (isset($_SESSION['login_user'])) {
         if ($_SESSION['login_user'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         } else {
            $this->view('login');
         }
      } else {
         $this->view('login');
      }
   }

   public function cek_login()
   {
      if (isset($_SESSION['login_user'])) {
         if ($_SESSION['login_user'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }

      $tipe = $_POST["tipe"];

      switch ($tipe) {
         case 'admin':
            $where = "no_user = '" . $_POST["HP"] . "' AND password = '" . md5($_POST["PASS"]) . "' AND (privilege BETWEEN 100 AND 199)";
            $this->data_user = $this->model('M_DB_1')->get_where_row('user', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'admin';
               $dateTime = date('Y-m-d H:i:s');
               $set = "last_login = '" . $dateTime . "'";
               $this->model('M_DB_1')->update('user', $set, $where);
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1 && !isset($_POST['code'])) {
                  echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
               } elseif ($this->data_user['ga'] == 1 && isset($_POST['code'])) {
                  $secret = $this->data_user['ga_secret'];
                  require_once "library/GoogleAuthenticator.php";
                  $authenticator = new PHPGangsta_GoogleAuthenticator();
                  $tolerance = 0;
                  $code    = $_POST['code'];
                  $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                  if ($result) {
                     $this->login_success();
                  } else {
                     echo "PASS CODE Autentication Failed!";
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'management':
            $where = "no_user = '" . $_POST["HP"] . "' AND password = '" . md5($_POST["PASS"]) . "' AND (privilege BETWEEN 1 AND 99)";
            $this->data_user = $this->model('M_DB_1')->get_where_row('user', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'management';
               $dateTime = date('Y-m-d H:i:s');
               $set = "last_login = '" . $dateTime . "'";
               $this->model('M_DB_1')->update('user', $set, $where);
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1 && !isset($_POST['code'])) {
                  echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
               } elseif ($this->data_user['ga'] == 1 && isset($_POST['code'])) {
                  $secret = $this->data_user['ga_secret'];
                  require_once "library/GoogleAuthenticator.php";
                  $authenticator = new PHPGangsta_GoogleAuthenticator();
                  $tolerance = 0;
                  $code    = $_POST['code'];
                  $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                  if ($result) {
                     $this->login_success();
                  } else {
                     echo "PASS CODE Autentication Failed!";
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'staff':
            $where = "employee_id = '" . $_POST["HP"] . "' AND pass = '" . md5($_POST["PASS"]) . "'";
            $this->data_user = $this->model('M_DB_1')->get_where_row('master_staff', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'staff';
               $secret = $this->data_user['ga_secret'];
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1) {
                  if (strlen($secret) > 0) {
                     if (!isset($_POST['code'])) {
                        echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
                     } else {
                        require_once "library/GoogleAuthenticator.php";
                        $authenticator = new PHPGangsta_GoogleAuthenticator();
                        $tolerance = 0;
                        $code    = $_POST['code'];
                        $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                        if ($result) {
                           $this->login_success();
                        } else {
                           echo "PASS CODE Autentication Failed!";
                        }
                     }
                  } else {
                     echo 2;
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'cs':
            $where = "employee_id = '" . $_POST["HP"] . "' AND pass = '" . md5($_POST["PASS"]) . "'";
            $this->data_user = $this->model('M_DB_1')->get_where_row('master_cs', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'cs';
               $secret = $this->data_user['ga_secret'];
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1) {
                  if (strlen($secret) > 0) {
                     if (!isset($_POST['code'])) {
                        echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
                     } else {
                        require_once "library/GoogleAuthenticator.php";
                        $authenticator = new PHPGangsta_GoogleAuthenticator();
                        $tolerance = 0;
                        $code    = $_POST['code'];
                        $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                        if ($result) {
                           $this->login_success();
                        } else {
                           echo "PASS CODE Autentication Failed!";
                        }
                     }
                  } else {
                     echo 2;
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'qc':
            $where = "employee_id = '" . $_POST["HP"] . "' AND pass = '" . md5($_POST["PASS"]) . "'";
            $this->data_user = $this->model('M_DB_1')->get_where_row('master_qc', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'qc';
               $secret = $this->data_user['ga_secret'];
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1) {
                  if (strlen($secret) > 0) {
                     if (!isset($_POST['code'])) {
                        echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
                     } else {
                        require_once "library/GoogleAuthenticator.php";
                        $authenticator = new PHPGangsta_GoogleAuthenticator();
                        $tolerance = 0;
                        $code    = $_POST['code'];
                        $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                        if ($result) {
                           $this->login_success();
                        } else {
                           echo "PASS CODE Autentication Failed!";
                        }
                     }
                  } else {
                     echo 2;
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'tl':
            $where = "employee_id = '" . $_POST["HP"] . "' AND pass = '" . md5($_POST["PASS"]) . "'";
            $this->data_user = $this->model('M_DB_1')->get_where_row('master_tl', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'tl';
               $secret = $this->data_user['ga_secret'];
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1) {
                  if (strlen($secret) > 0) {
                     if (!isset($_POST['code'])) {
                        echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
                     } else {
                        require_once "library/GoogleAuthenticator.php";
                        $authenticator = new PHPGangsta_GoogleAuthenticator();
                        $tolerance = 0;
                        $code    = $_POST['code'];
                        $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                        if ($result) {
                           $this->login_success();
                        } else {
                           echo "PASS CODE Autentication Failed!";
                        }
                     }
                  } else {
                     echo 2;
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
         case 'om':
            $where = "employee_id = '" . $_POST["HP"] . "' AND pass = '" . md5($_POST["PASS"]) . "'";
            $this->data_user = $this->model('M_DB_1')->get_where_row('master_om', $where);
            if ($this->data_user) {
               $_SESSION['userTipe'] = 'om';
               $secret = $this->data_user['ga_secret'];
               $this->model('M_DB_1')->query("SET GLOBAL time_zone = '+07:00'");
               if ($this->data_user['ga'] == 1) {
                  if (strlen($secret) > 0) {
                     if (!isset($_POST['code'])) {
                        echo '<div><label>Authenticator Code</label><input type="text" name="code" class="form-control" required></div>';
                     } else {
                        require_once "library/GoogleAuthenticator.php";
                        $authenticator = new PHPGangsta_GoogleAuthenticator();
                        $tolerance = 0;
                        $code    = $_POST['code'];
                        $result  = $authenticator->verifyCode($secret, $code, $tolerance);
                        if ($result) {
                           $this->login_success();
                        } else {
                           echo "PASS CODE Autentication Failed!";
                        }
                     }
                  } else {
                     echo 2;
                  }
               } else {
                  $this->login_success();
               }
            } else {
               echo "Autentication Failed!";
            }
            break;
      }
   }

   public function login_success()
   {
      $_SESSION['login_user'] = TRUE;
      $this->parameter();
      echo 1;
   }

   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      header('Location: ' . $this->BASE_URL . "Home");
   }

   public function qr($id, $tipe)
   {
      $data = array("id" => $id, "tipe" => $tipe);
      $this->view('profil/qr', $data);
   }

   public function verify($secret, $id, $tipe)
   {
      if (isset($_POST['code'])) {
         require_once "library/GoogleAuthenticator.php";
         $authenticator = new PHPGangsta_GoogleAuthenticator();
         $tolerance = 0;
         $code    = $_POST['code'];

         $result  = $authenticator->verifyCode($secret, $code, $tolerance);
         if ($result) {
            switch ($tipe) {
               case "staff":
                  $table = "master_staff";
                  $where = "employee_id = '" . $id . "'";
                  break;
               case "cs":
                  $table = "master_cs";
                  $where = "employee_id = '" . $id . "'";
                  break;
               case "tl":
                  $table = "master_tl";
                  $where = "employee_id = '" . $id . "'";
                  break;
               case "om":
                  $table = "master_om";
                  $where = "employee_id = '" . $id . "'";
                  break;
               case "admin":
                  $table = "user";
                  $where = "id_user = '" . $id . "'";
                  break;
            }
            $set = "ga = 1, ga_secret = '" . $secret . "'";
            $this->model('M_DB_1')->update($table, $set, $where);
            echo 1;
         } else {
            echo "INVALID CODE!";
         }
      }
   }
}
