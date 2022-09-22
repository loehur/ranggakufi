<?php

class WA_Check extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'notif';
   }

   public function index()
   {
      $view = 'wa_check/wc_main';
      $pageInfo = ['title' => 'WA Check'];
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view);
   }

   public function content()
   {
      $view = 'wa_check/wc_data';
      $data = array();
      $where = "tipe = 1 AND mode = 4 ORDER BY id_notif ASC";
      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $this->view($view, ['data' => $data]);
   }

   public function insert()
   {
      $numbers = $_POST['numbers'];
      $no = explode(PHP_EOL, $numbers);
      $cols = 'notif_token, tipe, phone, text, mode, user';
      $date = date("Ymd-his");

      foreach ($no as $a) {
         $check = "Check [" . $a . "-" . $date . "]";
         $vals = "1,1,'" . $a . "','" . $check . "',4," . $this->id_user;
         if (strlen($a) > 5 && strlen($a) < 15) {
            print_r($this->model('M_DB_1')->insertCols($this->table, $cols, $vals));
         }
      }
   }

   public function wa_status()
   {
      $where = "token = 1";
      $data = $this->model('M_DB_1')->get_where_row('notif_auth', $where);

      $log = 0;
      $auth = $data['auth'];
      $log = $data['log'];
      $log_time = $data['updateTime'];

      if ($log == 1) {
         echo "Whatsapp <span class='ml-1 text-bold text-success'>CONNECTED</span>";
      } else {
         $now = date('Y-m-d H:i:s');
         $beginTime = date_create($log_time);
         $finalTime = date_create($now);

         $diff  = date_diff($beginTime, $finalTime);

         $menit = $diff->i;
         $filePath = "";
         $filePath = $this->model('M_QR')->GenQR($auth);


         echo "<span class='ml-2'>" . $now . "</span>";

         if ($menit > 3) {
            echo "<span class='ml-2 text-bold text-danger'>QR Expired</span>";
         }
         echo "<span><img width='260' height='260' src='" . $this->BASE_URL . $filePath  . "' /></span>";
         echo "<span id='log' class='d-none'>" . $log . "</span>";
      }
   }

   public function clear()
   {
      $where = "user = " . $this->id_user;
      $this->model('M_DB_1')->delete_where("notif", $where);
   }
}
