<?php

class Relief extends Controller
{
   public $table;

   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'relief';
   }

   public function index($mode = 1)
   {
      $view = 'relief/relief_main';
      $data = [];
      $optDate = [];
      $period = "";

      if (!isset($_POST['st_week'])) {
         if (date("D") == "Mon") {
            $st_week = date("Y-m-d");
         } else {
            $st_week = date('Y-m-d', strtotime('last monday'));
         }
      } else {
         $st_week = $_POST['st_week'];
      }
      $en_week = date('Y-m-d', strtotime('+6 days', strtotime($st_week)));
      $period = $st_week;

      //WEEKS ===============================

      $startDate = "2022-12-12";

      if (date("D") == "Mon") {
         $lastSunday = date("Y-m-d");
      } else {
         $lastSunday = date('Y-m-d', strtotime('last monday'));
      }

      $no = 0;
      $startWeek = $lastSunday;
      $max = 10000;

      while ($no < $max) {
         $optDate[$no] = $startWeek;

         if ($startWeek > $startDate) {
            $startWeek = date('Y-m-d', strtotime('-7 days', strtotime($startWeek)));
            $no++;
         } else {
            break;
         }
      }

      //========================================================

      if ($mode == 2) {
         $pageInfo = ['title' => 'Relief - Done'];
         $whereMode = "(om_check = 2 OR data_check <> 0) AND request_date >= '" . $st_week . "' AND request_date <= '" . $en_week . "' AND";
      } else {
         $pageInfo = ['title' => 'Relief - On Going'];
         if (!isset($_POST['st_week'])) {
            $whereMode = "(data_check = 0 AND om_check <> 2) AND";
         } else {
            $whereMode = "(data_check = 0 AND om_check <> 2) AND request_date >= '" . $st_week . "' AND request_date <= '" . $en_week . "' AND";
         }
      }

      if ($_SESSION['userTipe'] == "admin") {
         if ($mode == 2) {
            $where = $whereMode . " id_relief > 0 ORDER BY id_relief DESC";
         } else {
            $where = $whereMode . " id_relief > 0 ORDER BY id_relief ASC";
         }
      } elseif ($_SESSION['userTipe'] == "staff") {
         $where = $whereMode . " emp_id = '" . $this->id_user . "' ORDER BY id_relief ASC";
      } elseif ($_SESSION['userTipe'] == "tl") {
         $where = $whereMode . " tl = '" . $this->id_user . "' ORDER BY id_relief ASC";
      } else {
         $where = $whereMode . " LOCATE(bucket, '" . $this->userDVC . "') > 0 ORDER BY id_relief ASC";
      }
      $data = $this->model('M_DB_1')->get_where($this->table, $where);

      //KUOTA
      $where = "(request_date >= '" . $st_week . "' AND request_date <= '" . $en_week . "') AND (data_check = 1) ORDER BY bucket ASC";
      $data_kuota = $this->model('M_DB_1')->get_where($this->table, $where);
      $s = [];
      foreach ($data_kuota as $d) {
         if ($d['percentage'] == 100) {
            if (isset($s[$d['tl']]['x100'])) {
               $s[$d['tl']]['x100'] += 1;
            } else {
               $s[$d['tl']]['x100'] = 1;
            }
            $s[$d['tl']]['dvs'] = $d['bucket'];
         }
      }

      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'period' => $period, 'pageInfo' => $pageInfo, 'optWeek' => $optDate, "mode" => $mode, "kuota" => $s]);
   }

   public function quota()
   {
      $view = 'relief/relief_quota';
      $data = array();


      if (date("D") == "Mon") {
         $start_date = date("Y-m-d");
      } else {
         $start_date = date('Y-m-d', strtotime('last monday'));
      }

      $period = $start_date . " to " . date("Y-m-d");
      $pageInfo = ['title' => 'Relief - Quota'];
      $where = "request_date >= '" . $start_date . "' AND data_check = 1 ORDER BY bucket ASC";

      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'period' => $period, 'pageInfo' => $pageInfo]);
   }


   public function insert()
   {
      if ($_SESSION['userTipe'] != "staff") {
         if ($_SESSION['userTipe'] != "tl") {
            echo "Account Forbidden";
            exit();
         }
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
      $vals = "'" . date('i') . "_" . $emp_id . $date_ . $rep_amount . "','" . $emp_id . "','" . $date_ . "','" . $loan_id . "','" . $bucket . "','" . $om . "','" . $tl . "','" . $remark . "'," . $rep_amount . "," . $dpd . "," . $waiver . "," . $total_el . "," . $percen;
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

      $set = "on_check = '', data_date ='" . date('Y-m-d') . "', data_check =" . $st . ", data_approved = '" . $this->id_user . "'";
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


   public function on_check($id, $id_user)
   {
      if (!isset($this->id_user) || strlen($this->id_user) == 0) {
         $this->index();
         exit();
      }

      $set = "on_check ='" . $id_user . "'";
      $where = "id_relief = '" . $id . "'";
      $update = $this->model('M_DB_1')->update($this->table, $set, $where);
      if ($update['errno'] == 0) {
         $this->index();
      } else {
         print_r($update['error']);
      }
   }
}
