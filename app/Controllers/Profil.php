<?php

class Profil extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
   }

   public function index()
   {
      $view = 'profil/profil_main';
      $data = array();
      $pageInfo = ['title' => 'Profil'];
      switch ($_SESSION['userTipe']) {
         case "staff":
            $table = "master_staff";
            $where = "employee_id = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
         case "cs":
            $table = "master_cs";
            $where = "employee_id = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
         case "qc":
            $table = "master_qc";
            $where = "employee_id = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
         case "tl":
            $table = "master_tl";
            $where = "employee_id = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
         case "om":
            $table = "master_om";
            $where = "employee_id = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
         case "admin":
         case "management":
            $table = "user";
            $where = "id_user = '" . $this->id_user . "'";
            $data_user = $this->model('M_DB_1')->get_where_row($table, $where);
            $data['ga'] = $data_user['ga'];
            break;
      }
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, $data);
   }

   public function removeGA()
   {
      $id = $_POST['id'];
      switch ($_SESSION['userTipe']) {
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
         case "management":
            $table = "user";
            $where = "id_user = '" . $id . "'";
            break;
      }
      $set = "ga = 0, ga_secret = ''";
      $this->model('M_DB_1')->update($table, $set, $where);
   }

   public function enDisGA($table)
   {
      $id = $_POST['id'];
      $val = $_POST['val'];

      switch ($table) {
         case "master_staff":
            $where = "employee_id = '" . $id . "'";
            break;
         case "master_cs":
            $where = "employee_id = '" . $id . "'";
            break;
         case "master_tl":
            $where = "employee_id = '" . $id . "'";
            break;
         case "master_om":
            $where = "employee_id = '" . $id . "'";
            break;
      }
      if ($val == 0) {
         $val = 1;
      } else {
         $val = 0;
      }

      $set = "ga = " . $val . ", ga_secret = ''";
      $this->model('M_DB_1')->update($table, $set, $where);
      echo $val;
   }
}
