<?php

class Report_Weekly extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->tableDaily = 'data_daily';
      $this->tableHourly = 'data_hourly';
   }

   public function weekly_main()
   {
      $pageInfo = ['title' => 'Report - Weekly'];
      $view = 'report_weekly/weekly_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function weekly_data($level)
   {
      if (strlen($_POST['f1'] == 0)) {
         exit();
      }

      $dvc = $_POST['dvc'];
      if ($dvc == "RM0") {
         $order = " ORDER BY repRate DESC";
      } else {
         $order = " ORDER BY avgTRA DESC";
      }


      $view = 'report_weekly/weekly_data';
      $dateF = $_POST['f1'];
      $dateT = $_POST['f2'];
      $phpDateF = strtotime($dateF);
      $phpDateT = strtotime($dateT);

      $timeDiff = abs($phpDateT - $phpDateF);
      $days = $timeDiff / 86400;
      $parDate = array();

      $from = date('Y-m-d', $phpDateF);
      $no = 0;
      for ($i = $phpDateF; $i <= $phpDateT; $i = $i + (86400 * 7)) {
         $no++;
         $loopEnd = FALSE;
         $thisDate = date('Y-m-d', $i);
         if ($days >= 7) {
            $from = $thisDate;
         }
         if ($days >= 14) {
            $endWeek = strtotime("+6 day", $i);
            $endWeek = date('Y-m-d', $endWeek);
            $to = $endWeek;
         } else {
            $endWeek = date('Y-m-d', $phpDateT);
            $to = $endWeek;
            $loopEnd = TRUE;
         }

         $parDate[$no] = array($from, $to);

         if ($loopEnd == TRUE) {
            break;
         }
         $days = $days - 7;
      }

      switch ($level) {
         case "om":
            $parCol = "om";
            $cols = $level . ', AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
            break;
         case "tl":
            $parCol = "tl, om";
            $cols = $level . ', AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
            break;
         case "employee_id":
            $parCol = "employee_id, tl, om";
            $cols = $level . ', SUM(allocated_amount) as avgAA, SUM(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
            break;
      }

      foreach ($parDate as $a) {
         $dateFrom = $a[0];
         $dateTo = $a[1];
         $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "') GROUP BY " . $level . " " . $order;
         $data[$dateFrom . " To " . $dateTo] = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $cols, $where);
      }

      $colsSummary = $parCol . ', AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
      $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY " . $level . " " . $order;

      if ($level <>  "employee_id") {
         $summary = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $colsSummary, $where);
      } else {
         $summary = array();
      }

      $this->view($view, ['data' => $data, 'summary' => $summary, 'level' => $level, 'dvc' => $dvc]);
   }
}
