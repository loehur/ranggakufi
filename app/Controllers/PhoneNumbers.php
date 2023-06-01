<?php

class PhoneNumbers extends Controller
{
   public $page = __CLASS__;

   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->v_content = $this->page . "/content";
      $this->v_viewer = $this->page . "/viewer";
   }

   public function index($parse = "")
   {
      $pageInfo = ['title' => 'Phone Numbers'];
      $this->view("layout", ['pageInfo' => $pageInfo]);
      $this->viewer($parse);
   }

   public function viewer($parse = "")
   {
      $this->view($this->v_viewer, ["page" => $this->page, "parse" => $parse]);
   }

   public function content($parse = "")
   {
      $data['et'] = $parse;

      switch ($parse) {
         case "staff":
            $where = "employee_id = '" . $this->id_user . "' ORDER BY id_contact DESC";
            $data['contact'] = $this->model('M_DB_1')->get_where("contacts", $where);
            $data['kufi_id'] = $this->model("Arr")->group_col_all($data['contact'], "employee_id");;
            break;
         case "admin":
         case "qc":
         case "tl":
            $order = "id_contact DESC";
            $data['contact'] = $this->model('M_DB_1')->get_order("contacts", $order);
            $data['kufi_id'] = $this->model("Arr")->group_col_all($data['contact'], "employee_id");;
            break;
      }

      $this->view($this->v_content, $data);
   }

   public function addContact()
   {
      if (!($_SESSION['userTipe'] == "staff" || $_SESSION['userTipe'] == "tl" || $_SESSION['userTipe'] == "om")) {
         exit();
      }

      $remark = $_POST['remark'];
      $mode = $_POST['mode'];

      if ($mode == "hp") {
         $contact = "62" . $_POST['contact'];
      } else {
         $contact = $_POST['contact'];
      }

      $arr_contact =  [
         "remark" => $remark,
         "contact" => $contact,
         "status" => 0, // 0 staff add, 1 qc edit, 2 qc delete
         "updated" => date("Y-m-d H:i"),
         "qc" => "",
         "mode" => $mode
      ];

      $contact_ = serialize($arr_contact);

      //$where = "contact LIKE '%" . $contact . "%'";
      //$count = $this->model('M_DB_1')->count_where('contacts', $where);

      $cols = 'employee_tipe, employee_id, contact';
      $vals = "'" . $this->userTipe . "','" . $this->id_user . "','" . $contact_ . "'";
      $do = $this->model('M_DB_1')->insertCols('contacts', $cols, $vals);
      echo $do['errno'];

      // if ($count < 1) {
      // } else {
      //    echo $contact . " Already exist";
      // }
   }

   public function expand($parse = "")
   {
      $where = "employee_id = '" . $parse . "' ORDER BY id_contact DESC";
      $data['contact'] = $this->model('M_DB_1')->get_where("contacts", $where);

      $this->view($this->page . "/expand", $data);
   }

   function delete()
   {
      if (!$_SESSION['userTipe'] == "qc") {
         exit();
      }

      $id = $_POST['id'];
      $where = "id_contact = " . $id;
      $data = $this->model('M_DB_1')->get_where_row("contacts", $where);
      $c = unserialize($data['contact']);
      $log =  [
         "contact_before" => $c['contact'],
         "contact_after" => $c['contact'],
         "action" => 2, //1 qc edit, 2 qc delete
         "created" => $c['updated'],
         "updated" => date("Y-m-d H:i"),
         "proof" => "",
         "qc" => $this->id_user,
         "qc_remark" => "delete",
      ];


      $log_ = [];
      if (strlen($data['log']) == 0) {
         $log_ = [];
      } else {
         $log_ = unserialize($data['log']);
      }
      array_push($log_, $log);

      $c["status"] = 2;
      $c["updated"] = date("Y-m-d H:i");
      $c["qc"] = $this->id_user;

      $ser_log = serialize($log_);
      $ser_con = serialize($c);

      $set = "contact ='" . $ser_con . "', log ='" . $ser_log . "'";
      $where = "id_contact = " . $id;
      $update = $this->model('M_DB_1')->update("contacts", $set, $where);
      echo ($update['errno'] == 0) ? 0 : $update['error'];
   }

   public function edit()
   {
      if (!$_SESSION['userTipe'] == "qc") {
         exit();
      }

      function compressImage($source, $destination, $quality)
      {
         $imgInfo = getimagesize($source);
         $mime = $imgInfo['mime'];
         switch ($mime) {
            case 'image/jpeg':
               $image = imagecreatefromjpeg($source);
               break;
            case 'image/png':
               $image = imagecreatefrompng($source);
               break;
            case 'image/gif':
               $image = imagecreatefromgif($source);
               break;
            default:
               $image = imagecreatefromjpeg($source);
         }

         imagejpeg($image, $destination, $quality);
         return $destination;
      }

      $filePath = "";

      if (isset($_FILES['resi'])) {
         $uploads_dir = "files/pn_proof/" . date('Y/') . date('m/') . date('d/');
         $file_name = date('His') . "_" . basename($_FILES['resi']['name']);

         $filePath = $uploads_dir . $file_name;

         if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, TRUE);
         }

         $imageUploadPath =  $uploads_dir . '/' . $file_name;
         $allowExt   = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
         $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

         $imageTemp = $_FILES['resi']['tmp_name'];
         $fileSize   = $_FILES['resi']['size'];

         if (in_array($fileType, $allowExt) === true) {
            if ($fileSize < 10000000) {
               if ($fileSize > 1000000) {
                  compressImage($imageTemp, $imageUploadPath, 20);
               } else {
                  move_uploaded_file($imageTemp, $imageUploadPath);
               }
            } else {
               echo "FILE BIGGER THAN 10MB FORBIDDEN";
               exit();
            }
         } else {
            echo "FILE EXT/TYPE FORBIDDEN";
            exit();
         }
      }

      $id = $_POST['id_edit'];
      $mode = $_POST['mode'];
      if ($mode == "hp") {
         $new = "62" . $_POST['contact'];
      } else {
         $new = $_POST['contact'];
      }
      $qc_remark = $_POST['qc_remark'];
      $where = "id_contact = " . $id;

      $data = $this->model('M_DB_1')->get_where_row("contacts", $where);
      $c = unserialize($data['contact']);

      $log =  [
         "contact_before" => $c['contact'],
         "contact_after" => $new,
         "action" => 1, //1 qc edit, 2 qc delete
         "created" => $c['updated'],
         "updated" => date("Y-m-d H:i"),
         "proof" => $filePath,
         "qc" => $this->id_user,
         "qc_remark" => $qc_remark,
      ];


      $log_ = [];
      if (strlen($data['log']) == 0) {
         $log_ = [];
      } else {
         $log_ = unserialize($data['log']);
      }
      array_push($log_, $log);

      $c["contact"] = $new;
      $c["status"] = 1;
      $c["updated"] = date("Y-m-d H:i");
      $c["qc"] = $this->id_user;

      $ser_log = serialize($log_);
      $ser_con = serialize($c);

      $set = "contact ='" . $ser_con . "', log ='" . $ser_log . "'";
      $where = "id_contact = " . $id;
      $update = $this->model('M_DB_1')->update("contacts", $set, $where);
      echo ($update['errno'] == 0) ? 0 : $update['error'];
   }
}
