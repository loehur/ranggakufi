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

      $cols = 'unic, emp_id, date_, loan_id, bucket, om, tl, remark, repay_amount, dpd';
      $vals = "'" . $emp_id . $date_ . $rep_amount . "','" . $emp_id . "','" . $date_ . "','" . $loan_id . "','" . $bucket . "','" . $om . "','" . $tl . "','" . $remark . "'," . $rep_amount . "," . $dpd;
      $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
      if ($query['errno'] == 0) {
         echo "1";
      } else {
         echo $query['error'];
      }
   }

   public function update($id)
   {
      $f1 = $_POST['f1'];
      $f2 = $_POST['f2'];
      $f3 = $_POST['f3'];
      $f4 = $_POST['f4'];
      $f5 = $_POST['f5'];
      $f6 = $_POST['f6'];
      $rs = $_POST['resolve'];
      $set = "transaction_date='" . $f1 . "',delay_date='" . $f2 . "', due_date='" . $f3 . "',delay_date_resolved='" . $f4 . "', cs_remark='" . $f6 . "', repay_amount_cs ='" . $f5 . "', resolve ='" . $rs . "', cs_id ='" . $this->id_user . "'";
      $where = "id_cs_problem = '" . $id . "'";
      $this->model('M_DB_1')->update($this->table, $set, $where);
   }


   public function result()
   {
      $view = 'cs_problem/cs_problem_result';
      $data = array();
      $pageInfo = ['title' => 'Delay Result - CS Problem'];
      $where = "resolve = 1 ORDER BY loan_id DESC";
      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $data_result = $this->model('M_DB_1')->get("cs_problem_result");
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'data_result' => $data_result]);
   }
}
