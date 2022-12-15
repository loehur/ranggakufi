<?php

class Relief extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'relief';
   }

   public function index($mode = 1)
   {
      $view = 'relief/relief_main';
      $data = array();

      if ($mode == 2) {
         $pageInfo = ['title' => 'Relief - Done'];
         $whereMode = "om_check = 2 OR data_check <> 0 AND";
      } else {
         $pageInfo = ['title' => 'Relief - On Going'];
         $whereMode = "data_check = 0 AND om_check <> 2 AND";
      }

      if ($_SESSION['userTipe'] == "admin") {
         $where = $whereMode . " id_relief > 0 ORDER BY id_relief DESC";
      } elseif ($_SESSION['userTipe'] == "staff") {
         $where = $whereMode . " emp_id = '" . $this->id_user . "' ORDER BY id_relief DESC";
      } else {
         $where = $whereMode . " LOCATE(bucket, '" . $this->userDVC . "') > 0 ORDER BY id_relief DESC";
      }
      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'pageInfo' => $pageInfo]);
   }

   public function insert()
   {
      if ($_SESSION['userTipe'] != "staff") {
         echo "Account Forbidden";
         exit();
      }

      $loan_id = $_POST['loan_id'];
      $rep_amount = $_POST['rep_amount'];
      $date_ = $_POST['date_'];
      $emp_id = $this->id_user;
      $dpd = $_POST['dpd'];
      $bucket = $_POST['bucket'];
      $tl = $_POST['tl'];
      $om = $_POST['om'];
      $remark = $_POST['remark'];
      $waiver = $_POST['waiver'];
      $total_el = $_POST['4element'];

      $percen = ($waiver / $total_el) * 100;

      if ($percen >= 0 && $percen <= 30) {
         $percen = 30;
      } elseif ($percen > 30 && $percen <= 50) {
         $percen = 50;
      } else {
         $percen = 100;
      }

      if (strlen($emp_id) == 0) {
         echo "Employee ID Forbidden";
         exit();
      }

      $cols = 'unic, emp_id, date_, loan_id, bucket, om, tl, remark, repay_amount, dpd, waiver_amount, 4_el, percentage';
      $vals = "'" . $emp_id . $date_ . $rep_amount . "','" . $emp_id . "','" . $date_ . "','" . $loan_id . "','" . $bucket . "','" . $om . "','" . $tl . "','" . $remark . "'," . $rep_amount . "," . $dpd . "," . $waiver . "," . $total_el . "," . $percen;
      $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
      if ($query['errno'] == 0) {
         echo "1";
      } else {
         echo $query['error'];
      }
   }

   public function update($id, $st)
   {
      if (!isset($this->id_user) || strlen($this->id_user) == 0) {
         $this->index();
         exit();
      }

      $set = "om_date ='" . date('Y-m-d') . "', om_check =" . $st . ", om_approved = '" . $this->id_user . "'";
      $where = "id_relief = '" . $id . "'";
      $update = $this->model('M_DB_1')->update($this->table, $set, $where);
      if ($update['errno'] == 0) {
         $this->index();
      } else {
         print_r($update['error']);
      }
   }

   public function update_admin($id, $st)
   {
      if (!isset($this->id_user) || strlen($this->id_user) == 0) {
         $this->index();
         exit();
      }

      $set = "data_date ='" . date('Y-m-d') . "', data_check =" . $st . ", data_approved = '" . $this->id_user . "'";
      $where = "id_relief = '" . $id . "'";
      $update = $this->model('M_DB_1')->update($this->table, $set, $where);
      if ($update['errno'] == 0) {
         $this->index();
      } else {
         print_r($update['error']);
      }
   }

   public function cancel($id, $emp_id)
   {
      if ($this->id_user <> $emp_id) {
         $this->index();
         exit();
      }

      $where = "id_relief = '" . $id . "'";
      $delete = $this->model('M_DB_1')->delete_where($this->table, $where);
      if ($delete['errno'] == 0) {
         $this->index();
      } else {
         print_r($delete['error']);
      }
   }
}
