<?php

class Upload_List extends Controller
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
      $cols = 'insertTime, count(date_) as count';
      $groupBy = "insertTime ORDER BY insertTime DESC";
      switch ($raw) {
         case "1":
            $pageInfo = ['title' => 'Hourly - Upload List'];
            $data = $this->model('M_DB_1')->get_cols_groubBy($this->tableHourly, $cols, $groupBy);
            break;
         case "2":
            $pageInfo = ['title' => 'Daily - Upload List'];
            $data = $this->model('M_DB_1')->get_cols_groubBy($this->tableDaily, $cols, $groupBy);
            break;
      }


      $view = 'upload_list/upload_list_main';
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'raw' => $raw]);
   }

   public function remove($raw)
   {
      $id = $_POST['id'];
      $where = "insertTime = '" . $id . "'";
      switch ($raw) {
         case "1":
            $this->model('M_DB_1')->delete_where($this->tableHourly, $where);
            break;
         case "2":
            $this->model('M_DB_1')->delete_where($this->tableDaily, $where);
            break;
      }
   }

   public function remove_row($tb)
   {
      $id = $_POST['id'];

      switch ($tb) {
         case "cs_problem":
            $where = "id_cs_problem = '" . $id . "'";
            break;
         default:
            $where = "employee_id = '" . $id . "'";
            break;
      }

      $this->model('M_DB_1')->delete_where($tb, $where);
   }
}
