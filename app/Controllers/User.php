<?php

class User extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'user';
   }

   public function index()
   {
      $view = 'user/user_main';
      $data = array();
      $pageInfo = ['title' => 'User'];
      $data = $this->model('M_DB_1')->get($this->table);
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data]);
   }

   public function insert()
   {
      $cols = 'nama_user, no_user, privilege';
      $nama = $_POST['f1'];
      $hp = $_POST['f2'];
      $privilege = $_POST['f3'];
      $vals = "'" . $nama . "','" . $hp . "','" . $privilege . "'";
      $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
      $this->dataSynchrone();
   }

   public function updateCell()
   {
      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      switch ($mode) {
         case "1":
            $col = "nama_user";
            break;
         case "2":
            $col = "no_user";
            break;
         case "3":
            $col = "privilege";
            break;
      }
      $where = "id_user = " . $id;
      $set = $col . " = '" . $value . "'";
      $this->model('M_DB_1')->update($this->table, $set, $where);
      $this->dataSynchrone();
   }

   public function synchrone()
   {
      $this->dataSynchrone();
   }
}
