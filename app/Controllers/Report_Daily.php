<?php

class Report_Daily extends Controller
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
      $pageInfo = ['title' => 'Report - Daily Trend'];
      $view = 'report_daily/daily_trend_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function trend_data($label, $base, $base2)
   {
      $dateF = $_POST['Yf'] . "-" . $_POST['mf'] . "-" . $_POST['df'];
      $dateT = $_POST['Yt'] . "-" . $_POST['mt'] . "-" . $_POST['dt'];
      $view = 'report_daily/daily_trend_data';
      $cols = 'date_, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount))*100 AS repRate';

      if ($label <> 'om') {
         $where = "(SUBSTRING(date_,1,10) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND " . $label . " = '" . $base . "' GROUP BY date_ ORDER BY date_ ASC";
      } else {
         $omDvs = explode("->", $base);
         $idOM = $omDvs[0];
         $dvcOM = $omDvs[1];
         $where = "(SUBSTRING(date_,1,10) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND " . $label . " = '" . $idOM . "' AND ticket_category = '" . $dvcOM . "' GROUP BY date_ ORDER BY date_ ASC";
      }

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

      $data2 = array();
      $data = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $cols, $where);
      if (($label == 'om') && (strlen($base2) > 0)) {
         $omDvs = explode("->", $base2);
         $idOM = $omDvs[0];
         $dvcOM = $omDvs[1];
         $where = "(SUBSTRING(date_,1,10) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND " . $label . " = '" . $idOM . "' AND ticket_category = '" . $dvcOM . "' GROUP BY date_ ORDER BY date_ ASC";
         $data2 = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $cols, $where);

         foreach ($this->dEmp as $a) {
            if ($a['employee_id'] == $idOM) {
               $base2 = $a['employee_name'] . " @" . $dvcOM;
            }
         }
      }
      $this->view($view, ['data' => $data, 'data2' => $data2, 'label' => $base, 'label2' => $base2]);
   }

   public function option_list()
   {
      $dateF = $_POST['Yf'] . "-" . $_POST['mf'] . "-" . $_POST['df'];
      $dateT = $_POST['Yt'] . "-" . $_POST['mt'] . "-" . $_POST['dt'];
      $tipe = $_POST['tipe'];

      if ($tipe == "om") {
         $cols = $tipe . ", CONCAT(" . $tipe . ",' -> ',ticket_category) as n" . $tipe;
         $where = "(SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY " . $tipe . ", ticket_category ORDER BY date_ ASC";
      } else {
         $cols = $tipe;
         $where = "(SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY " . $tipe . " ORDER BY date_ ASC";
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
      $pageInfo = ['title' => 'Report - Daily Staff/TL'];
      $view = 'report_daily/daily_stafftl_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function staff_tl($mode, $base, $id)
   {
      $dateF = $_POST['Yf'] . "-" . $_POST['mf'] . "-" . $_POST['df'];
      $dateT = $_POST['Yt'] . "-" . $_POST['mt'] . "-" . $_POST['dt'];
      $dvc = $_POST['dvc'];

      switch ($mode) {
         case "1":
            $view = 'report_daily/daily_stafftl_om';
            if ($dvc == "RM0") {
               $order = " ORDER BY repRate DESC";
            } else {
               $order = " ORDER BY avgTRA DESC";
            }
            $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
            $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY om" . $order;
            break;
         case "2":
            $view = 'report_daily/daily_stafftl_tl';
            if ($dvc == "RM0") {
               $order = " ORDER BY repRate DESC";
            } else {
               $order = " ORDER BY avgTRA DESC";
            }
            if ($base == "om") {
               $where =  "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY om" . $order;
            } elseif ($base == "tl") {
               $where =  "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY tl" . $order;
            }
            if ($base == "om") {
               $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND om = '" . $id . "' GROUP BY tl" . $order;
            } else {
               $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY tl" . $order;
            }
            $cols = 'tl, om, AVG(handle_times) as avgHT, AVG(total_call) as avgTC, AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
            break;
         case "3":
            $view = 'report_daily/daily_stafftl_staff';
            if ($dvc == "RM0") {
               $order = " ORDER BY repRate DESC";
            } else {
               $order = " ORDER BY total_repay_amount DESC";
            }
            if ($base == "om") {
               $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND om = '" . $id . "' GROUP BY employee_id" . $order;
            } elseif ($base == "tl") {
               $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') AND tl = '" . $id . "' GROUP BY employee_id" . $order;
            } else {
               $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY employee_id" . $order;
            }
            $cols = 'employee_id, assign_to, tl, om, SUM(allocated_amount) as allocated_amount, SUM(total_repay_amount) as total_repay_amount, (total_repay_amount/allocated_amount) AS repRate';
            break;
      }

      $data = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $cols, $where);
      $this->view($view, ['data' => $data, 'dvc' => $dvc]);
   }
}
