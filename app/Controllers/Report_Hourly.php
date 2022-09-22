<?php

class Report_Hourly extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->tableDaily = 'data_daily';
      $this->tableHourly = 'data_hourly';
   }

   public function trend_main()
   {
      $pageInfo = ['title' => 'Report - Hourly Trend'];
      $view = 'report_hourly/hourly_trend_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function trend_data($label, $base)
   {
      $view = 'report_hourly/hourly_trend_data';
      $date = $_POST['Y'] . $_POST['m'] . $_POST['d'];
      $cols = 'date_, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount))*100 AS repRate';

      if ($label <> 'om') {
         $where = "date_ LIKE '" . $date . "%' AND " . $label . " = '" . $base . "' GROUP BY date_";
      } else {
         $omDvs = explode("->", $base);
         $idOM = $omDvs[0];
         $dvcOM = $omDvs[1];
         $where = "date_ LIKE '" . $date . "%' AND om = '" . $idOM . "' AND ticket_category = '" . $dvcOM . "' GROUP BY date_";
      }

      $data = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      $dateEOD = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
      $cols = 'AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount))*100 AS repRate';

      if ($label <> 'om') {
         $where = "date_ LIKE '" . $dateEOD . "%' AND " . $label . " = '" . $base . "' GROUP BY date_";
      } else {
         $where = "date_ LIKE '" . $dateEOD . "%' AND om = '" . $idOM . "' AND ticket_category = '" . $dvcOM . "' GROUP BY date_";
      }
      $dataEOD = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);

      if ($label <> 'ticket_category') {
         if ($label == 'om') {
            foreach ($this->dEmp as $a) {
               if ($a['employee_id'] == $idOM) {
                  $base = $a['employee_name'] . " @" . $dvcOM;
               }
            }
         } else {
            foreach ($this->dEmp as $a) {
               if ($a['employee_id'] == $base) {
                  $base = $a['employee_name'];
               }
            }
         }
      }

      $this->view($view, ['data' => $data, 'dataEOD' => $dataEOD, 'label' => $base]);
   }

   public function option_list()
   {
      $date = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
      $tipe = $_POST['tipe'];

      if ($tipe == "om") {
         $cols = $tipe . ", CONCAT(" . $tipe . ",' -> ',ticket_category) as n" . $tipe;
         $where = "date_ LIKE '" . $date . "%' GROUP BY om, ticket_category";
      } else {
         $cols = $tipe;
         $where = "date_ LIKE '" . $date . "%' GROUP BY " . $tipe;
      }


      $list = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      $newList = array();
      foreach ($list as $b) {
         switch ($tipe) {
            case "tl":
               $opt = $b[$tipe];
               foreach ($this->dEmp as $a) {
                  if ($a['employee_id'] == $b[$tipe]) {
                     $newList[$opt] = $a['employee_name'];
                  }
               }
               break;
            case "om":
               $omDvs = explode(" -> ", $b['nom']);
               $idOM = $omDvs[0];
               $dvcOM = $omDvs[1];
               foreach ($this->dEmp as $a) {
                  if ($a['employee_id'] == $idOM) {
                     $newList[$b['nom']] = $a['employee_name'] . " -> " . $dvcOM;
                  }
               }
               break;
            case "ticket_category":
               $opt = $b[$tipe];
               $newList[$opt] = $opt;
               break;
         }
      }
      echo json_encode($newList);
   }

   public function staff_tl_main()
   {
      $pageInfo = ['title' => 'Report - Hourly Staff/TL'];
      $view = 'report_hourly/hourly_stafftl_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function staff_tl($mode, $base, $id)
   {
      $dvc = $_POST['dvc'];
      $hour = $_POST['h'];
      if ($hour == "eod") {
         $date = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
         switch ($mode) {
            case "1":
               $view = 'report_hourly/hourly_stafftl_om';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY avgTRA DESC";
               }
               $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
               $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' GROUP BY om" . $order;
               break;
            case "2":
               $view = 'report_hourly/hourly_stafftl_tl';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY avgTRA DESC";
               }
               if ($base == "om") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' AND om = '" . $id . "' GROUP BY tl" . $order;
               } else {
                  $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' GROUP BY tl" . $order;
               }
               $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
               break;
            case "3":
               $view = 'report_hourly/hourly_stafftl_staff';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY total_repay_amount DESC";
               }
               if ($base == "om") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' AND om = '" . $id . "' GROUP BY employee_id" . $order;
               } elseif ($base == "tl") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' AND tl = '" . $id . "' GROUP BY employee_id" . $order;
               } else {
                  $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $date . "%' GROUP BY employee_id" . $order;
               }
               $cols = 'employee_id, assign_to, tl, om, SUM(allocated_amount) as allocated_amount, SUM(total_repay_amount) as total_repay_amount, (total_repay_amount/allocated_amount) AS repRate';
               break;
         }
      } else {
         $date = $_POST['Y'] . $_POST['m'] . $_POST['d'] . $hour;
         switch ($mode) {
            case "1":
               $view = 'report_hourly/hourly_stafftl_om';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY avgTRA DESC";
               }
               $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
               $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' GROUP BY om" . $order;
               break;
            case "2":
               $view = 'report_hourly/hourly_stafftl_tl';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY avgTRA DESC";
               }
               if ($base == "om") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' AND om = '" . $id . "' GROUP BY tl" . $order;
               } else {
                  $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' GROUP BY tl" . $order;
               }
               $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
               break;
            case "3":
               $view = 'report_hourly/hourly_stafftl_staff';
               if ($dvc == "RM0") {
                  $order = " ORDER BY repRate DESC";
               } else {
                  $order = " ORDER BY total_repay_amount DESC";
               }
               if ($base == "om") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' AND om = '" . $id . "' GROUP BY employee_id" . $order;
               } elseif ($base == "tl") {
                  $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' AND tl = '" . $id . "' GROUP BY employee_id" . $order;
               } else {
                  $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . "' GROUP BY employee_id" . $order;
               }
               $cols = 'employee_id, assign_to, tl, om, SUM(allocated_amount) as allocated_amount, SUM(total_repay_amount) as total_repay_amount, (total_repay_amount/allocated_amount) AS repRate';
               break;
         }
      }
      $data = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      $this->view($view, ['data' => $data, 'dvc' => $dvc]);
   }

   public function om_main()
   {
      $pageInfo = ['title' => 'Report - Hourly OM'];
      $view = 'report_hourly/hourly_om_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function om_data()
   {
      $date = $_POST['Y'] . $_POST['m'] . $_POST['d'];
      $dvc = $_POST['dvc'];

      //PHP DATE
      $phpDate = $_POST['m'] . "/" . $_POST['d'] . "/" . $_POST['Y'];
      $phpDate = strtotime($phpDate);

      //GET YESTERDAY
      $yesterday = strtotime("-1 day", $phpDate);
      $yesterday = date('Ymd', $yesterday);

      $todayEOD = date('Y-m-d', $phpDate);
      $yesterdayEOD = strtotime("-1 day", $phpDate);

      $yesterdayEOD = date('Y-m-d', $yesterdayEOD);

      $view = 'report_hourly/hourly_om_data';
      if ($dvc == "RM0") {
         $dvcTipe = 1;
         $order = " ORDER BY repRate DESC";
         $cols = 'om, SUM(total_repay_amount)/SUM(allocated_amount) AS result';
         $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $yesterday . "17' GROUP BY om ORDER BY result DESC";
         $yest = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
         $cols = 'om, SUM(total_repay_amount)/SUM(allocated_amount) AS result';
         $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $yesterdayEOD . "%' GROUP BY om ORDER BY result DESC";
         $yestEOD = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      } else {
         $dvcTipe = 0;
         $order = " ORDER BY avgTRA DESC";
         $cols = 'om, AVG(total_repay_amount) as result';
         $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $yesterday . "17' GROUP BY om ORDER BY result DESC";
         $yest = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
         $cols = 'om, AVG(total_repay_amount) as result';
         $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $yesterdayEOD . "%' GROUP BY om ORDER BY result DESC";
         $yestEOD = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      }

      foreach ($this->dHour as $a) {
         $jam = $a['hour'];
         $cols = 'date_, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
         $where = "ticket_category = '" . $dvc . "' AND date_ = '" . $date . $jam . "' GROUP BY om" . $order;
         $data[$jam] = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);
      }

      $cols = 'date_, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
      $where = "ticket_category = '" . $dvc . "' AND date_ LIKE '" . $todayEOD . "%' GROUP BY om" . $order;
      $EOD = $this->model('M_DB_1')->get_cols_where($this->tableHourly, $cols, $where);


      $this->view($view, ['data' => $data, 'yest' => $yest, 'EOD' => $EOD, 'yestEOD' => $yestEOD, 'dvcTipe' => $dvcTipe]);
   }
}
