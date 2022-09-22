<?php

class CS_Problem extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'cs_problem';
   }

   public function i($mode)
   {
      $view = 'cs_problem/cs_problem_main';
      $data = array();
      $loanResult = array();
      $checkBy = "";

      switch ($_SESSION['userTipe']) {
         case "staff":
            $checkBy = "emp_id = '" . $this->id_user . "' AND ";
            break;
         case "tl":
            $checkBy = "tl = '" . $this->id_user . "' AND ";
            break;
         case "om":
            $checkBy = " ";
            break;
      }

      if (isset($_POST['date'])) {
         $mo =   $_POST['m'];
         $ye =   $_POST['y'];
      } else {
         $mo = date('m');
         $ye = date('Y');
      }

      $date['bulan'] = $mo;
      $date['tahun'] = $ye;
      $month = $ye . "-" . $mo;

      if ($mode == 1) {
         $pageInfo = ['title' => 'Delay Process - CS Problem'];
         $where = $checkBy . "(resolve = 0 OR resolve = 2) ORDER BY id_cs_problem DESC";
      } elseif ($mode == 2) {
         $pageInfo = ['title' => 'Delay Solved - CS Problem'];
         $where = $checkBy . "resolve = 1 AND complain_date LIKE '" . $month . "%' ORDER BY id_cs_problem DESC";
      } elseif ($mode == 3) {
         $pageInfo = ['title' => 'Delay Rejected - CS Problem'];
         $where = $checkBy . "resolve = 3 AND complain_date LIKE '" . $month . "%' ORDER BY id_cs_problem DESC";
      }


      $data = $this->model('M_DB_1')->get_where($this->table, $where);

      $data_result = $this->model('M_DB_1')->get("cs_problem_result");
      $loanResult = array_column($data_result, 'loan_id');
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'pageInfo' => $pageInfo, 'loanResult' => $loanResult, 'mode' => $mode, 'date' => $date]);
   }

   public function insert()
   {
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

      $complain_date = $_POST['f1'];
      $loan_id = $_POST['f2'];

      $ticket_create_date = $_POST['f3'];
      $emp_id = $this->id_user;
      $division = $this->userDVC;
      $om = $this->userOM;
      $tl = $this->userTL;
      $repay_amount_staff = $_POST['f4'];
      $remark = $_POST['f5'];
      $uploads_dir = "files/resi/" . date('Y/') . date('m/') . date('d/');
      $file_name = date('His') . "_" . basename($_FILES['resi']['name']);

      $where2 = "loan_id LIKE '" . $loan_id . "%'";
      $data_count = $this->model('M_DB_1')->count_where($this->table, $where2);
      if (isset($data_count)) {
         $countC = $data_count + 1;
      } else {
         $countC = 1;
      }
      $loan_id = $loan_id . "-C" . $countC;

      if (strlen($emp_id) == 0) {
         echo "Timeout, Re-Synchrone Please!";
         exit();
      }
      $simID = str_replace("KUFI-", "", $emp_id);
      $simComDate = str_replace("-", "", $complain_date);
      $cols = 'unic, emp_id, complain_date, loan_id, ticket_create_date, division, om, tl, remark, repay_amount, file_path, file_name';
      $vals = "'" . $simID . $simComDate . $repay_amount_staff . "','" . $emp_id . "','" . $complain_date . "','" . $loan_id . "','" . $ticket_create_date . "','" . $division . "','" . $om . "','" . $tl . "','" . $remark . "','" . $repay_amount_staff . "','" . $uploads_dir . "','" . $file_name . "'";

      if (!file_exists($uploads_dir)) {
         mkdir($uploads_dir, 0777, TRUE);
      }

      $imageUploadPath =  $uploads_dir . '/' . $file_name;
      $allowExt   = array('png', 'jpg', 'jpeg');
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $imageTemp = $_FILES['resi']['tmp_name'];
      $fileSize   = $_FILES['resi']['size'];

      if (in_array($fileType, $allowExt) === true) {
         if ($fileSize < 10000000) {
            if ($fileSize > 1000000) {
               compressImage($imageTemp, $imageUploadPath, 20);
               $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
               if ($query) {
                  echo "1";
               } else {
                  echo $query['error'];
               }
            } else {
               move_uploaded_file($imageTemp, $imageUploadPath);
               $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
               if ($query) {
                  echo "1";
               } else {
                  echo $query['error'];
               }
            }
         } else {
            echo "FILE BIGGER THAN 10MB FORBIDDEN";
         }
      } else {
         echo "FILE EXT/TYPE FORBIDDEN";
      }
   }

   public function responseForm($id, $path)
   {
      $where = "id_cs_problem = " . $id;
      $data = $this->model('M_DB_1')->get_where_row($this->table, $where);
      $this->view('cs_problem/cs_problem_response', ['data' => $data, 'id' => $id, 'spath' => $path]);
   }

   public function update($id)
   {
      $f1 = $_POST['f1'];
      $f2 = $_POST['f2'];
      $f3 = $_POST['f3'];
      $f4 = $_POST['f4'];
      $f5 = $_POST['f5'];
      $f6 = $_POST['f6'];
      $rs = $_POST['resolve'];
      $set = "transaction_date='" . $f1 . "',delay_date='" . $f2 . "', due_date='" . $f3 . "',delay_date_resolved='" . $f4 . "', cs_remark='" . $f6 . "', repay_amount_cs ='" . $f5 . "', resolve ='" . $rs . "', cs_id ='" . $this->id_user . "'";
      $where = "id_cs_problem = '" . $id . "'";
      $this->model('M_DB_1')->update($this->table, $set, $where);
   }


   public function result()
   {
      $view = 'cs_problem/cs_problem_result';
      $data = array();
      $pageInfo = ['title' => 'Delay Result - CS Problem'];
      $where = "resolve = 1 ORDER BY loan_id DESC";
      $data = $this->model('M_DB_1')->get_where($this->table, $where);
      $data_result = $this->model('M_DB_1')->get("cs_problem_result");
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data, 'data_result' => $data_result]);
   }

   public function insertResult()
   {
      $loan_id = $_POST['loan'];
      $staff_id = $_POST['staff'];
      $dvc = $_POST['dvc'];
      $alo_min = $_POST['aMin'];
      $alo_plus = $_POST['aPlus'];
      $pay_min = $_POST['pMin'];
      $pay_plus = $_POST['pPlus'];
      $comDate = $_POST['comDate'];
      $resDate = $_POST['resDate'];

      $where = "loan_id = '" . $loan_id . "' AND staff_id = '" . $staff_id . "'";
      $count = $this->model('M_DB_1')->count_where('cs_problem_result', $where);
      if ($count < 1) {
         $cols = 'loan_id, staff_id, ticket_category, allocated_min, allocated_plus, payment_min, payment_plus, complain_date, resolved_date';
         $vals = "'" . $loan_id . "','" . $staff_id . "','" . $dvc . "','" . $alo_min . "','" . $alo_plus . "','" . $pay_min . "','" . $pay_plus . "','" . $comDate . "','" . $resDate . "'";
         print_r($this->model('M_DB_1')->insertCols('cs_problem_result', $cols, $vals));
      }
   }
   public function deleteResult($id)
   {
      if ($_SESSION['userTipe'] == "admin") {
         $this->model('M_DB_1')->delete_where('cs_problem_result', "id_cp_result = " . $id);
      }
   }
   public function check_main()
   {
      $view = 'cs_problem/cs_problem_check';
      $pageInfo = ['title' => 'Delay Checking - CS Problem'];
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['pageInfo' => $pageInfo]);
   }

   public function check_data()
   {
      $view = 'cs_problem/cs_problem_data';
      $id = $_POST['id'];
      $where = "loan_id LIKE '" . $id . "%'";
      $data = $this->model('M_DB_1')->get_where($this->table, $where);

      $data_result = $this->model('M_DB_1')->get("cs_problem_result");
      $loanResult = array_column($data_result, 'loan_id');
      $this->view($view, ['data' => $data, 'loanResult' => $loanResult]);
   }
}
