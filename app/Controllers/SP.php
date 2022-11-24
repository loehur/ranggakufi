<?php

class SP extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'sp';
   }

   public function i($mode)
   {
      $view = __CLASS__ . '/main';
      $data = array();
      $checkBy = "";
      $where = "";

      switch ($_SESSION['userTipe']) {
         case "staff":
            $checkBy = "emp_id = '" . $this->id_user . "' ";
            break;
         case "tl":
            $checkBy = "tl = '" . $this->id_user . "' ";
            break;
         case "om":
            $checkBy = "om = '" . $this->id_user . "' ";
            break;
         default:
            $checkBy = "om <> ''";
            break;
      }

      if ($mode == 1) {
         $pageInfo = ['title' => __CLASS__ . ' - Active'];
         $where = $checkBy . "";
      } elseif ($mode == 2) {
         $pageInfo = ['title' => __CLASS__ . ' - Historical'];
         $where = $checkBy . "";
      }


      $data = $this->model('M_DB_1')->get_where_order($this->table, $where, "emp_id ASC, id_sp ASC");

      $send = [];
      foreach ($data as $a) {
         $send[$a['emp_id']][$a['id_sp']] = $a;
      }
      $staff = $this->model('M_DB_1')->get("master_staff");
      $tl = $this->model('M_DB_1')->get("master_tl");
      $om = $this->model('M_DB_1')->get("master_om");

      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $send, 'staff' => $staff, 'tl' => $tl, 'om' => $om, 'pageInfo' => $pageInfo]);
   }

   public function insert()
   {
      $sp_date = $_POST['f1'];
      $sp = $_POST['f2'];
      $emp_id = $_POST['f3'];
      $remark = $_POST['f4'];

      $uploads_dir = "files/sp/" . date('Y/') . date('m/') . date('d/');
      $file_name = date('His') . "_" . basename($_FILES['file']['name']);

      $where2 = "employee_id = '" . $emp_id . "'";
      $emp = $this->model('M_DB_1')->get_where_row("master_staff", $where2);

      $tl = $_POST['f5'];
      $om = $_POST['f6'];
      $dvc = $emp['ticket_category'];

      $unic = $sp_date . $sp . $emp_id;

      $cols = 'unic, sp, emp_id, sp_date, om, tl, remark, file_path, file_name, qc_id, division';
      $vals = "'" . $unic . "'," . $sp . ",'" . $emp_id . "','" . $sp_date . "','" . $om . "','" . $tl . "','" . $remark . "','" . $uploads_dir . "','" . $file_name . "','" . $this->id_user . "','" . $dvc . "'";

      if (!file_exists($uploads_dir)) {
         mkdir($uploads_dir, 0777, TRUE);
      }

      $imageUploadPath =  $uploads_dir . '/' . $file_name;
      $allowExt   = array('pdf', 'PDF');
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $imageTemp = $_FILES['file']['tmp_name'];
      $fileSize   = $_FILES['file']['size'];

      if (in_array($fileType, $allowExt) === true) {
         if ($fileSize < 10000000) {
            if ($fileSize > 1000000) {
               move_uploaded_file($imageTemp, $imageUploadPath);
               $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
               if ($query['errno'] == 0) {
                  echo "1";
               } else {
                  echo $query['error'];
               }
            } else {
               move_uploaded_file($imageTemp, $imageUploadPath);
               $query = $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
               if ($query['errno'] == 0) {
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
