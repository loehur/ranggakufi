<?php

class Relief extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'relief';
   }

   public function index()
   {
      $view = 'relief/relief_main';
      $data = array();

      $pageInfo = ['title' => 'Relief'];

      $where = "id_relief > 0";
      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'pageInfo' => $pageInfo]);
   }

   public function insert()
   {
      if ($_SESSION['userTipe'] != "staff") {
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

      $cols = 'unic, emp_id, date_, loan_id, bucket, om, tl, remark, repay_amount, dpd, waiver_amount';
      $vals = "'" . $emp_id . $date_ . $rep_amount . "','" . $emp_id . "','" . $date_ . "','" . $loan_id . "','" . $bucket . "','" . $om . "','" . $tl . "','" . $remark . "'," . $rep_amount . "," . $dpd . "," . $waiver;
      $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
      if ($query['errno'] == 0) {
         echo "1";
      } else {
         echo $query['error'];
      }
   }

   public function update($id, $st)
   {
      $set = "om_date ='" . date('Y-m-d') . "', om_check =" . $st . ", om_approved = '" . $this->id_user . "'";
      $where = "id_relief = '" . $id . "'";
      $update = $this->model('M_DB_1')->update($this->table, $set, $where);
      if ($update['errno'] == 0) {
         $this->index();
      } else {
         print_r($update['error']);
      }
   }
}
