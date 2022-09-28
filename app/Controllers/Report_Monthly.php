<?php

class Report_Monthly extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->tableDaily = 'data_daily';
      $this->tableHourly = 'data_hourly';
   }

   public function monthly_main()
   {
      $pageInfo = ['title' => 'Report - Monthly'];
      $view = 'report_monthly/monthly_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function monthly_data($level)
   {
      $dvc = $_POST['dvc'];
      if ($dvc == "RM0") {
         $order = " ORDER BY repRate DESC";
      } else {
         $order = " ORDER BY avgTRA DESC";
      }

      $view = 'report_monthly/monthly_data';

      $dateF = $_POST['f1'];
      $dateT = $_POST['f2'];
      $phpDateF = strtotime($dateF);
      $phpDateT = strtotime($dateT);

      $parDate = array();

      $year1 = date('Y', $phpDateF);
      $year2 = date('Y', $phpDateT);
      $month1 = date('m', $phpDateF);
      $month2 = date('m', $phpDateT);
      $diffMonth = (($year2 - $year1) * 12) + ($month2 - $month1);

      for ($i = 0; $i <= $diffMonth; $i = $i + 1) {
         $toDate = strtotime("+1 month", $phpDateF);
         $to = date("Y-m-d", strtotime("-1 day", $toDate));
         $from = date('Y-m-d', $phpDateF);
         $phpDateF = $toDate;
         $parDate[$i] = array($from, $to);
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
         $data[$dateFrom . " To " . $dateTo] = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $cols, $where, 1);
      }

      $colsSummary = $parCol . ', AVG(allocated_amount) as avgAA, AVG(total_repay_amount) as avgTRA, (SUM(total_repay_amount)/SUM(allocated_amount)) AS repRate';
      $where = "ticket_category = '" . $dvc . "' AND (SUBSTRING(date_,1,11) BETWEEN '" . $dateF . "' AND '" . $dateT . "') GROUP BY " . $level . " " . $order;

      if ($level <>  "employee_id") {
         $summary = $this->model('M_DB_1')->get_cols_where($this->tableDaily, $colsSummary, $where, 1);
      } else {
         $summary = array();
      }

      $this->view($view, ['data' => $data, 'summary' => $summary, 'level' => $level, 'dvc' => $dvc]);
   }
}
