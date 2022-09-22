<?php

class Register extends Controller
{
   public function index()
   {
      if (isset($_SESSION['login_user'])) {
         if ($_SESSION['login_user'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }
      $this->view('register');
   }
   public function insert()
   {
      if (isset($_SESSION['login_user'])) {
         if ($_SESSION['login_user'] == TRUE) {
            header('Location: ' . $this->BASE_URL . "Home");
         }
      }

      $table = "user";
      $no_user = $_POST["HP"];
      $where = "no_user = '" . $no_user . "'";
      $do_count = $this->model('M_DB_1')->count_where($table, $where);

      if ($do_count > 0) {
         echo "Phone Number has been Registered!";
      } else {
         $table  = 'user';
         $pass = md5($_POST["password"]);
         $columns = 'no_user, nama_user, password, admin, privilege';
         $values = "'" . $_POST["HP"] . "','" . $_POST["nama"] . "','" . $pass . "',1,100";
         $do = $this->model('M_DB_1')->insertCols($table, $columns, $values);
         if ($do == TRUE) {
            if ($do <> 1) {
               echo "New Admin Registration Closed!";
            } else {
               echo 1;
            }
         } else {
            echo "Registration Failed!";
         }
      }
   }
}
