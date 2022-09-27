<?php

class Upload extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'user';
   }

   public function index()
   {
      $view = 'upload/upload_main';
      $data = array();
      $pageInfo = ['title' => 'Upload'];
      $data = $this->model('M_DB_1')->get($this->table);
      $this->view('layout', ['pageInfo' => $pageInfo]);
      $this->view($view, ['data' => $data]);
   }

   public function importDaily()
   {
      $succCount = 0;
      $failedMsg = "";
      $upStatus = 'Import Complete!';
      $dateNow = date('YmdHis');
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            $no = 0;
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $no++;
               $date = $line[0];
               if (strlen($date) > 0) {
                  $ticket_category = $line[1];
                  $ranking = $line[2];
                  $assign_to = $line[3];
                  $assign_to = str_replace("'", "", $assign_to);
                  $employee_id = $line[4];
                  $allocated_amount = $line[5];
                  $repay_principal = $line[6];
                  $repay_interest = $line[7];
                  $total_repay_amount = $line[8];
                  $rate_of_return = $line[9];
                  $target_repay_rate = $line[10];
                  $diff_target_repay_amount = $line[11];
                  $new_assign_num = $line[12];
                  $handle_times = $line[13];
                  $handle_num = $line[14];
                  $complete_num = $line[15];
                  $load_num = $line[16];
                  $singleMultiple_periods = $line[17];
                  $first_loanReloan = $line[18];
                  $total_call = $line[19];
                  $tl = $line[20];
                  $om = $line[21];

                  $realDate = substr($date, 0, 10);
                  $simDate = str_replace("-", "", $realDate);
                  $simID = str_replace("KUFI-", "", $employee_id);
                  $primary = $simDate . $simID . $allocated_amount . $total_repay_amount;

                  $vals =  "'" . $primary . "','" . $date . "','" . $ticket_category . "','" . $ranking . "','" . $assign_to . "','" . $employee_id . "','" . $allocated_amount . "','" . $repay_principal . "','" . $repay_interest . "','" . $total_repay_amount . "','" . $rate_of_return . "','" . $target_repay_rate . "','" . $diff_target_repay_amount . "','" . $new_assign_num . "','" . $handle_times . "','" . $handle_num . "','" . $complete_num . "','" . $load_num . "','" . $singleMultiple_periods . "','" . $first_loanReloan . "','" . $total_call . "','" . $tl . "','" . $om . "','" . $dateNow . "'";
                  $query = "INSERT INTO data_daily VALUES(" . $vals . ");";
                  $lastInsert = $realDate . " " . $employee_id;

                  $queryExecute = $this->model('M_DB_1')->query($query);
                  if ($queryExecute == 1) {
                     $succCount++;
                  } else {
                     $upStatus = 'Import Stopped!';
                     $failedMsg = $queryExecute['info'] . "<br>" . $queryExecute['query'] . "<br>Failed Insert: " . $lastInsert;
                     break;
                  }
                  if ($no == 2000) {
                     $upStatus = 'Import Stopped!';
                     $failedMsg = "2000 Rows Limit Reach! <br>Last Inserted: " . $lastInsert;
                     break;
                  }
               }
            }
            fclose($csvFile);
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "<hr>[" . $succCount . "] INSERTED<hr>" . $failedMsg;
      echo $msg;
   }

   public function importHourly()
   {
      $succCount = 0;
      $failedMsg = "";
      $upStatus = 'Import Complete!';
      $dateNow = date('YmdHis');
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            $no = 0;
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $date = $line[0];
               if (strlen($date) > 0) {
                  $ticket_category = $line[1];
                  $ranking = $line[2];
                  $assign_to = $line[3];
                  $assign_to = str_replace("'", "", $assign_to);
                  $employee_id = $line[4];
                  $role = $line[5];
                  $allocated_amount = $line[6];
                  $repay_principal = $line[7];
                  $repay_interest = $line[8];
                  $total_repay_amount = $line[9];
                  $rate_of_return = $line[10];
                  $target_repay_rate = $line[11];
                  $diff_target_repay_amount = $line[12];
                  $new_assign_num = $line[13];
                  $handle_times = $line[14];
                  $handle_num = $line[15];
                  $complete_num = $line[16];
                  $load_num = $line[17];
                  $singleMultiple_periods = $line[18];
                  $first_loanReloan = $line[19];
                  $total_call = $line[20];
                  $tl = $line[21];
                  $om = $line[22];

                  $realDate = substr($date, 0, 10);
                  $simDate = str_replace("-", "", $realDate);
                  $simID = str_replace("KUFI-", "", $employee_id);
                  $primary = $simDate . $simID . $allocated_amount . $total_repay_amount;

                  $vals =  "'" . $primary . "','" . $date . "','" . $ticket_category . "','" . $ranking . "','" . $assign_to . "','" . $employee_id . "','" . $role . "','" . $allocated_amount . "','" . $repay_principal . "','" . $repay_interest . "','" . $total_repay_amount . "','" . $rate_of_return . "','" . $target_repay_rate . "','" . $diff_target_repay_amount . "','" . $new_assign_num . "','" . $handle_times . "','" . $handle_num . "','" . $complete_num . "','" . $load_num . "','" . $singleMultiple_periods . "','" . $first_loanReloan . "','" . $total_call . "','" . $tl . "','" . $om . "','" . $dateNow . "'";
                  $query = "INSERT INTO data_hourly VALUES(" . $vals . ");";
                  $lastInsert = $realDate . " " . $employee_id;

                  $queryExecute = $this->model('M_DB_1')->query($query);
                  if ($queryExecute == 1) {
                     $succCount++;
                  } else {
                     $upStatus = 'Import Stopped!';
                     $failedMsg = $queryExecute['info'] . "<br>" . $queryExecute['query'] . "<br>Failed Insert: " . $lastInsert;
                     break;
                  }
                  if ($no == 2000) {
                     $upStatus = 'Import Stopped!';
                     $failedMsg = "2000 Rows Limit Reach! <br>Last Inserted: " . $lastInsert;
                     break;
                  }
               }
            }
            fclose($csvFile);
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "<hr>[" . $succCount . "] INSERTED<hr>" . $failedMsg;
      echo $msg;
   }

   public function importStaff()
   {
      $upStatus = "Error Function";
      $succCount = 0;
      $failedCount = 0;
      $skipCount = 0;
      $updateCount = 0;
      $list_updated = "";
      $list_skipped = "";
      $list_failed = "";
      $msg = $upStatus . " - [" . $succCount . "] OK, [" . $succCount . "] Failed.";
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $employee_id = $line[0];
               if (strlen($employee_id) > 0) {
                  $employee_name = $line[1];
                  $employee_name = str_replace("'", "", $employee_name);
                  $tl_id = $line[2];
                  $om_id = $line[3];
                  $dvc = $line[4];
                  $where = "employee_id = '" . $employee_id . "'";
                  $data_main = $this->model('M_DB_1')->count_where('master_staff', $where);
                  if ($data_main < 1) {
                     $vals =  "'" . $employee_id . "','" . $employee_name . "','" . $tl_id . "','" . $om_id . "','" . $dvc . "',DEFAULT,DEFAULT,DEFAULT";
                     $query = $this->model('M_DB_1')->insert('master_staff', $vals);
                     if ($query == 1) {
                        $succCount++;
                     } else {
                        $failedCount++;
                        $list_failed = $list_failed . "[" . $employee_id . "] ";
                     }
                  } else {
                     $where2 = "employee_id = '" . $employee_id . "' AND employee_name = '" . $employee_name . "' AND tl = '" . $tl_id . "' AND om = '" . $om_id . "' AND ticket_category = '" . $dvc . "'";
                     $data_main2 = $this->model('M_DB_1')->count_where('master_staff', $where2);
                     if ($data_main2 < 1) {
                        $query2 = $this->model('M_DB_1')->update("master_staff", "employee_name = '" . $employee_name . "', tl = '" . $tl_id . "', om = '" . $om_id . "', ticket_category = '" . $dvc . "'", $where);
                        if ($query2 == 1) {
                           $updateCount++;
                           $list_updated = $list_updated . "[" . $employee_id . "] ";
                        } else {
                           $failedCount++;
                           $list_failed = $list_failed . "[" . $employee_id . "] ";
                        }
                     } else {
                        $skipCount++;
                        $list_skipped = $list_skipped . "[" . $employee_id . "] ";
                     }
                  }
               }
            }
            fclose($csvFile);
            $upStatus = 'Import Complete!<hr>';
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "[" . $succCount . "] Success,<hr> 
      [" . $updateCount . "] Updated,<br>" . $list_updated . "<hr>
      [" . $skipCount . "] Skipped,<br>" . $list_skipped . "<hr>
      [" . $failedCount . "] Failed.<br>" . $list_failed;
      echo $msg;
   }

   public function importTL()
   {
      $upStatus = "Error Function";
      $succCount = 0;
      $failedCount = 0;
      $skipCount = 0;
      $updateCount = 0;
      $list_updated = "";
      $list_skipped = "";
      $list_failed = "";
      $msg = $upStatus . " - [" . $succCount . "] OK, [" . $succCount . "] Failed.";
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $employee_id = $line[0];
               if (strlen($employee_id) > 0) {
                  $employee_name = $line[1];
                  $om_id = $line[2];
                  $dvc = $line[3];
                  $where = "employee_id = '" . $employee_id . "'";
                  $data_main = $this->model('M_DB_1')->count_where('master_tl', $where);
                  if ($data_main < 1) {
                     $vals =  "'" . $employee_id . "','" . $employee_name . "','" . $om_id . "','" . $dvc . "',DEFAULT,DEFAULT,DEFAULT";
                     $query = $this->model('M_DB_1')->insert('master_tl', $vals);
                     if ($query == 1) {
                        $succCount++;
                     } else {
                        $failedCount++;
                        $list_failed = $list_failed . "[" . $employee_id . "] ";
                     }
                  } else {
                     $where2 = "employee_id = '" . $employee_id . "' AND employee_name = '" . $employee_name . "' AND  om = '" . $om_id . "' AND ticket_category = '" . $dvc . "'";
                     $data_main2 = $this->model('M_DB_1')->count_where('master_tl', $where2);
                     if ($data_main2 < 1) {
                        $query2 = $this->model('M_DB_1')->update("master_tl", "employee_name = '" . $employee_name . "', om = '" . $om_id . "', ticket_category = '" . $dvc . "'", $where);
                        if ($query2 == 1) {
                           $updateCount++;
                           $list_updated = $list_updated . "[" . $employee_id . "] ";
                        } else {
                           $failedCount++;
                           $list_failed = $list_failed . "[" . $employee_id . "] ";
                        }
                     } else {
                        $skipCount++;
                        $list_skipped = $list_skipped . "[" . $employee_id . "] ";
                     }
                  }
               }
            }
            fclose($csvFile);
            $upStatus = 'Import Complete!<hr>';
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "[" . $succCount . "] Success,<hr> 
      [" . $updateCount . "] Updated,<br>" . $list_updated . "<hr>
      [" . $skipCount . "] Skipped,<br>" . $list_skipped . "<hr>
      [" . $failedCount . "] Failed.<br>" . $list_failed;
      echo $msg;
   }

   public function importOM()
   {
      $upStatus = "Error Function";
      $succCount = 0;
      $failedCount = 0;
      $skipCount = 0;
      $updateCount = 0;
      $list_updated = "";
      $list_skipped = "";
      $list_failed = "";
      $msg = $upStatus . " - [" . $succCount . "] OK, [" . $succCount . "] Failed.";
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $employee_id = $line[0];
               if (strlen($employee_id) > 0) {
                  $employee_name = $line[1];
                  $dvc = $line[2];
                  $where = "employee_id = '" . $employee_id . "'";
                  $data_main = $this->model('M_DB_1')->count_where('master_om', $where);
                  if ($data_main < 1) {
                     $vals =  "'" . $employee_id . "','" . $employee_name . "','" . $dvc . "',DEFAULT,DEFAULT,DEFAULT";
                     $query = $this->model('M_DB_1')->insert('master_om', $vals);
                     if ($query == 1) {
                        $succCount++;
                     } else {
                        $failedCount++;
                        $list_failed = $list_failed . "[" . $employee_id . "] ";
                     }
                  } else {
                     $where2 = "employee_id = '" . $employee_id . "' AND employee_name = '" . $employee_name . "' AND ticket_category = '" . $dvc . "'";
                     $data_main2 = $this->model('M_DB_1')->count_where('master_om', $where2);
                     if ($data_main2 < 1) {
                        $query2 = $this->model('M_DB_1')->update("master_om", "employee_name = '" . $employee_name . "', ticket_category = '" . $dvc . "'", $where);
                        if ($query2 == 1) {
                           $updateCount++;
                           $list_updated = $list_updated . "[" . $employee_id . "] ";
                        } else {
                           $failedCount++;
                           $list_failed = $list_failed . "[" . $employee_id . "] ";
                        }
                     } else {
                        $skipCount++;
                        $list_skipped = $list_skipped . "[" . $employee_id . "] ";
                     }
                  }
               }
            }
            fclose($csvFile);
            $upStatus = 'Import Complete!<hr>';
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "[" . $succCount . "] Success,<hr> 
      [" . $updateCount . "] Updated,<br>" . $list_updated . "<hr>
      [" . $skipCount . "] Skipped,<br>" . $list_skipped . "<hr>
      [" . $failedCount . "] Failed.<br>" . $list_failed;
      echo $msg;
   }


   public function importCS()
   {
      $upStatus = "Error Function";
      $succCount = 0;
      $failedCount = 0;
      $skipCount = 0;
      $updateCount = 0;
      $list_updated = "";
      $list_skipped = "";
      $list_failed = "";
      $msg = $upStatus . " - [" . $succCount . "] OK, [" . $succCount . "] Failed.";
      if ($_FILES["file"]["size"] > 0) {
         if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while (($line = fgetcsv($csvFile)) !== FALSE) {
               $employee_id = $line[0];
               if (strlen($employee_id) > 0) {
                  $employee_name = $line[1];
                  $where = "employee_id = '" . $employee_id . "'";
                  $data_main = $this->model('M_DB_1')->count_where('master_cs', $where);
                  if ($data_main < 1) {
                     $vals =  "'" . $employee_id . "','" . $employee_name . "',DEFAULT,DEFAULT,DEFAULT";
                     $query = $this->model('M_DB_1')->insert('master_cs', $vals);
                     if ($query == 1) {
                        $succCount++;
                     } else {
                        $failedCount++;
                        $list_failed = $list_failed . "[" . $employee_id . "] ";
                     }
                  } else {
                     $where2 = "employee_id = '" . $employee_id . "' AND employee_name = '" . $employee_name . "'";
                     $data_main2 = $this->model('M_DB_1')->count_where('master_cs', $where2);
                     if ($data_main2 < 1) {
                        $query2 = $this->model('M_DB_1')->update("master_cs", "employee_name = '" . $employee_name . "'", $where);
                        if ($query2 == 1) {
                           $updateCount++;
                           $list_updated = $list_updated . "[" . $employee_id . "] ";
                        } else {
                           $failedCount++;
                           $list_failed = $list_failed . "[" . $employee_id . "] ";
                        }
                     } else {
                        $skipCount++;
                        $list_skipped = $list_skipped . "[" . $employee_id . "] ";
                     }
                  }
               }
            }
            fclose($csvFile);
            $upStatus = 'Import Complete!<hr>';
         } else {
            $upStatus = 'Error Data Row!';
         }
      } else {
         $upStatus = 'Invalid File!';
      }
      $msg = $upStatus . "[" . $succCount . "] Success,<hr> 
      [" . $updateCount . "] Updated,<br>" . $list_updated . "<hr>
      [" . $skipCount . "] Skipped,<br>" . $list_skipped . "<hr>
      [" . $failedCount . "] Failed.<br>" . $list_failed;
      echo $msg;
   }

   public function exportCSV($tb)
   {
      if ($_SESSION['userTipe'] == "admin" || $_SESSION['userTipe'] == "cs") {
         $delimiter = ",";
         $filename = $tb . "_" . date('Ymd') . ".csv";
         $f = fopen('php://memory', 'w');
         $data = $this->model('M_DB_1')->get($tb);

         switch ($tb) {
            case "cs_problem":
               $fields = array('ID', 'STAFF_ID', 'COMPLAIN_DATE', 'LOAN_ID', 'TICKET_CREATED_DATE', 'DIVISION', 'OM_ID', 'TL_ID', 'STAFF_REMARK', 'REPAY_AMOUNT', 'TRANSACTION_DATE', 'DELAY_DATE', 'DUE_DATE', 'DELAY_DATE_RESOLVE', 'CS_REMARK', 'REAL_REPAY_AMOUNT', 'CS_ID', 'RESOLVE_STATUS');
               fputcsv($f, $fields, $delimiter);
               foreach ($data as $a) {
                  $lineData = array($a['id_cs_problem'], $a['emp_id'], $a['complain_date'], "'" . $a['loan_id'], $a['ticket_create_date'], $a['division'], $a['om'], $a['tl'], $a['remark'], $a['repay_amount'], $a['transaction_date'], $a['delay_date'], $a['due_date'], $a['delay_date_resolved'], $a['cs_remark'], $a['repay_amount_cs'], $a['cs_id'], $a['resolve']);
                  fputcsv($f, $lineData, $delimiter);
               }
               break;
            case "cs_problem_result":
               $fields = array('ID', 'LOAN_ID', 'STAFF ID', 'ALLOCATED_MIN', 'ALLOCATED_PLUS', 'PAYMENT_MIN', 'PAYMENT_PLUS', 'TICKET_CATEGORY', 'COMPLAIN_DATE', 'RESOLVED_DATE');
               fputcsv($f, $fields, $delimiter);
               foreach ($data as $a) {
                  $lineData = array($a['id_cp_result'], "'" . $a['loan_id'], $a['staff_id'], $a['allocated_min'], $a['allocated_plus'], $a['payment_min'], $a['payment_plus'], $a['ticket_category'], $a['complain_date'], $a['resolved_date']);
                  fputcsv($f, $lineData, $delimiter);
               }
               break;
         }

         fseek($f, 0);
         header('Content-Type: text/csv');
         header('Content-Disposition: attachment; filename="' . $filename . '";');
         fpassthru($f);
      } else {
         echo "ACCESS FORBIDDEN!";
      }
   }
}
