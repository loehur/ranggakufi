<?php

class Raw_Data extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->tableDaily = 'data_daily';
      $this->tableHourly = 'data_hourly';
   }

   public function i($raw)
   {
      $data = array();
      $view = "";
      $dataTanggal = array();
      $tb = "";
      switch ($raw) {
         case "1":
            $pageInfo = ['title' => 'Raw Hourly'];
            $view = 'data/data_raw_hourly';
            if (isset($_POST['d'])) {
               $today = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
               $todayHour = $_POST['Y'] . $_POST['m'] . $_POST['d'] . $_POST['h'];
               $dataTanggal = array('tanggal' => $_POST['d'], 'bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
               $where = "date_ LIKE '" . $today . "%' OR date_ = '" . $todayHour . "'";
               $data = $this->model('M_DB_1')->get_where($this->tableHourly, $where);
            }
            break;
         case "2":
            if (isset($_POST['d'])) {
               $today = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
               $dataTanggal = array('tanggal' => $_POST['d'], 'bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
            } else {
               $today = date('Y-m-d');
            }
            $where = "date_ LIKE '" . $today . "%'";
            $pageInfo = ['title' => 'Raw Daily'];
            $data = $this->model('M_DB_1')->get_where($this->tableDaily, $where);
            $view = 'data/data_raw_daily';
            break;
         case "tl":
            $pageInfo = ['title' => 'Raw Team Leader'];
            $tb = "master_tl";
            $order = "employee_name ASC";
            $data = $this->model('M_DB_1')->get_order($tb, $order);
            $view = 'data/data_employee';
            $tb = "master_tl";
            break;
         case "om":
            $pageInfo = ['title' => 'Raw Operation Manager'];
            $tb = "master_om";
            $order = "employee_name ASC";
            $data = $this->model('M_DB_1')->get_order($tb, $order);
            $view = 'data/data_employee';
            break;
         case "staff":
            $pageInfo = ['title' => 'Raw Staff'];
            $tb = "master_staff";
            $order = "employee_name ASC";
            $data = $this->model('M_DB_1')->get_order($tb, $order);
            $view = 'data/data_employee';
            break;
         case "cs":
            $pageInfo = ['title' => 'Raw CS'];
            $tb = "master_cs";
            $order = "employee_name ASC";
            $data = $this->model('M_DB_1')->get_order($tb, $order);
            $view = 'data/data_employee';
            break;
         case "qc":
            $pageInfo = ['title' => 'Raw QC'];
            $tb = "master_qc";
            $order = "employee_name ASC";
            $data = $this->model('M_DB_1')->get_order($tb, $order);
            $view = 'data/data_employee';
            break;
      }

      if (strlen($view) > 0) {
         $this->view('layout', ['pageInfo' => $pageInfo]);
         $this->view($view, ['data' => $data, 'dataTanggal' => $dataTanggal, 'tb' => $tb]);
      } else {
         require_once "app/Views/error/404.php";
      }
   }
}
