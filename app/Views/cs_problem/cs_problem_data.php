<table class="table table-sm" class="border-collapse: collapse" style="padding: 0;">
  <tbody>
    <?php
    $row = 0;
    $arrPerDVC = array();
    foreach ($data['data'] as $a) {
      $path = $a['file_path'] . $a['file_name'];
      $sPath = str_replace('/', '_slash_', $path);
      $sPath = str_replace('-', '_strip_', $sPath);
      $sPath = str_replace(' ', '_space_', $sPath);

      $id =  $a['id_cs_problem'];
      $emp_id =  $a['emp_id'];
      $cs_id = $a['cs_id'];
      $id_name = "";
      $om_id =  $a['om'];
      $tl_id =  $a['tl'];
      $om_name = "";
      $tl_name = "";

      $analyzed = "";
      $loanID = $a['loan_id'];
      foreach ($data['loanResult'] as $lr) {
        if ($lr == $loanID) {
          $analyzed = "<span class='badge badge-dark'><i class='fas fa-check-double'></i> Analized</span>";
        }
      }

      foreach ($this->dStaff as $ds) {
        if ($ds['employee_id'] == $emp_id) {
          $id_name = $ds['employee_name'];
        }
      }

      foreach ($this->dEmp as $de) {
        if ($de['employee_id'] == $om_id) {
          $om_name = $de['employee_name'];
        }
        if ($de['employee_id'] == $tl_id) {
          $tl_name = $de['employee_name'];
        }
      }

      $done = 0;
      if ($a['repay_amount_cs'] > 0) {
        $done = 1;
      }

      $dvs = $a['division'];

      $rs = 0;
      $rs =  $a['resolve'];
      $rsName = "";
      if ($rs == 1) {
        $rsName = "<span class='badge badge-success'><i class='fas fa-check'></i> Solved</span>";
      } elseif ($rs == 2) {
        $rsName = "<span class='badge badge-warning'>Process</span>";
      } elseif ($rs == 3) {
        $rsName = "<span class='badge badge-danger'>Rejected</span>";
      }

      echo "<tr class='table-borderless " . $id . "' style='border-top: 1px dashed silver'>";
      echo "<td colspan='9' class='pb-0'><h7><small>Loan ID </small> <span class='badge badge-info p-1'><b>#" . $loanID . "</b></span></h7> <span data-id='" . $id . "' data-path='" . $sPath . "' class='btn badge badge-primary response' data-bs-toggle='modal' data-bs-target='#exampleModal2'><i class='far fa-eye'></i> View</span>";
      if ($_SESSION['userTipe'] == "admin") {
        echo "<span class='btn badge badge-light float-right' onClick=remove('" . $id . "')><i class='text-danger far fa-trash-alt'></i></span>";
      }
      echo "</td>";
      echo "</tr>";
      echo "<tr class='table-borderless " . $id . "'>";
      echo "<td class='text-right' ><small>Ticket:</small><br>#" . $id . "</td>";
      echo "<td><small>" . $emp_id . "</small><br><b><span>" . $id_name . "</span><br>" . $rsName . " " . $analyzed . "</td>";
      echo "<td><b><small><b>Division:</b> " . $dvs . " <br><b>OM:</b> " . $om_name . " <b><br>TL:</b> " . $tl_name . "</small></td>";
      echo "<td><small>Complained</small><br>" . $a['complain_date'] . "</td>";
      echo "<td><small>Ticket Created</small><br>" . $a['ticket_create_date'] . "</td>";
      echo "<td class='text-right'><small>Amount</small><br>" . number_format($a['repay_amount']) . "</td>";
      echo "<td><small>Remark</small><br><span style='color:#DC7633'><b>" . $a['remark'] . "</b></span></td>";
      echo "</tr>";
      if ($done == 1) {
        echo "<tr class='table-borderless bg-light " . $id . "'>";
        echo "<td class='text-right'><i class='fas fa-level-up-alt' style='transform: rotateZ(90deg);'></i></td>";
        echo "<td><small>Transaction</small><br> " . $a['transaction_date'] . "</td>";
        echo "<td><small>Delay Date</small><br> " . $a['delay_date'] . "</td>";
        echo "<td><small>Due Date</small><br>" . $a['due_date'] . "</td>";
        echo "<td><small>Delay Resolve</small><br>" . $a['delay_date_resolved'] . "</td>";
        echo "<td class='text-right'><small>Real Amount</small><br><b>" . number_format($a['repay_amount_cs']) . "</b></td>";
        echo "<td><small>Remark</small><br><span style='color:#8E44AD'><b>" . $a['cs_remark'] . "</b></span></td>";
        echo "</tr>";
        echo "<tr class='" . $id . "'><td colspan='9' style='border-bottom:0'></td></tr>";
      }
      $row++;
    }
    $recap = json_encode($arrPerDVC);
    ?>
</table>

<div class="modal" id="exampleModal2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content showResponse">
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>

<script>
  $("span.response").on("click", function(e) {
    var id = $(this).attr('data-id');
    var path = $(this).attr('data-path');
    $('div.showResponse').load('<?= $this->BASE_URL ?>CS_Problem/responseForm/' + id + '/' + path);
  });

  function remove(idnya) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Upload_List/remove_row/cs_problem",
      data: {
        id: idnya
      },
      type: "POST",
      success: function(result) {
        $("tr." + idnya).fadeOut("slow");
      },
    });
  }
</script>