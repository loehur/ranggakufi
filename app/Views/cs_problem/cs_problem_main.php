<?php
if (isset($data['date'])) {
  $currentMonth =   $data['date']['bulan'];
  $currentYear =   $data['date']['tahun'];
} else {
  $currentMonth = date('m');
  $currentYear = date('Y');
}

$mode = $data['mode'];
?>

<?php $title = $data['pageInfo']['title']; ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start align-items-end">
              <div class="mr-auto">

                <?php if ($mode <> 1) { ?>
                  <form action="<?= $this->BASE_URL; ?>CS_Problem/i/<?= $mode ?>" method="POST">
                    <table class="w-100">
                      <tr>
                        <td>
                          <small>Month</small>
                          <select name="m" class="form-control form-control-sm" style="width: auto;">
                            <option class="text-right" value="01" <?php if ($currentMonth == '01') {
                                                                    echo 'selected';
                                                                  } ?>>01</option>
                            <option class="text-right" value="02" <?php if ($currentMonth == '02') {
                                                                    echo 'selected';
                                                                  } ?>>02</option>
                            <option class="text-right" value="03" <?php if ($currentMonth == '03') {
                                                                    echo 'selected';
                                                                  } ?>>03</option>
                            <option class="text-right" value="04" <?php if ($currentMonth == '04') {
                                                                    echo 'selected';
                                                                  } ?>>04</option>
                            <option class="text-right" value="05" <?php if ($currentMonth == '05') {
                                                                    echo 'selected';
                                                                  } ?>>05</option>
                            <option class="text-right" value="06" <?php if ($currentMonth == '06') {
                                                                    echo 'selected';
                                                                  } ?>>06</option>
                            <option class="text-right" value="07" <?php if ($currentMonth == '07') {
                                                                    echo 'selected';
                                                                  } ?>>07</option>
                            <option class="text-right" value="08" <?php if ($currentMonth == '08') {
                                                                    echo 'selected';
                                                                  } ?>>08</option>
                            <option class="text-right" value="09" <?php if ($currentMonth == '09') {
                                                                    echo 'selected';
                                                                  } ?>>09</option>
                            <option class="text-right" value="10" <?php if ($currentMonth == '10') {
                                                                    echo 'selected';
                                                                  } ?>>10</option>
                            <option class="text-right" value="11" <?php if ($currentMonth == '11') {
                                                                    echo 'selected';
                                                                  } ?>>11</option>
                            <option class="text-right" value="12" <?php if ($currentMonth == '12') {
                                                                    echo 'selected';
                                                                  } ?>>12</option>
                          </select>
                        </td>
                        <td>
                          <small>Year</small>
                          <select name="y" class="form-control form-control-sm" style="width: auto;">
                            <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                                      echo 'selected';
                                                                    } ?>>2021</option>
                            <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                                      echo 'selected';
                                                                    } ?>>2022</option>
                          </select>
                        </td>
                        <td class="align-bottom"><button name='date' class="form-control form-control-sm pr-2 pl-2 bg-light align-bottom">Check</td>
                        <td valign="bottom" class="w-50"><small>- Base on Complained Date</small></td>
                      </tr>
                    </table>
                  </form>
                <?php
                } else {
                  echo "<h7>" . $title . "</h7>";
                } ?>


              </div>

              <div class="mr-auto">
                <b>Recap</b><br>
                <span id="rows">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </span> Rows,
                <span id="recap">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </span>
              </div>
              <div class="p-1">
                <?php if ($_SESSION['userTipe'] == "admin" || $_SESSION['userTipe'] == "cs") { ?>
                  <a href="<?= $this->BASE_URL ?>Upload/exportCSV/cs_problem" class="btn btn-sm btn-warning float-right">
                    Export CSV
                  </a><?php } ?>
                <?php if ($_SESSION['userTipe'] == "staff" && strpos($title, 'Delay Process') !== FALSE) { ?>
                  <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Insert Complain
                  </button><?php } ?>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-auto">
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

                      foreach ($this->dOM as $do) {
                        if ($do['employee_id'] == $om_id) {
                          $om_name = $do['employee_name'];
                        }
                      }

                      foreach ($this->dTL as $dt) {
                        if ($dt['employee_id'] == $tl_id) {
                          $tl_name = $dt['employee_name'];
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

                      if (isset($arrPerDVC[$dvs]) ==  TRUE) {
                        $arrPerDVC[$dvs] = $arrPerDVC[$dvs] + 1;
                      } else {
                        $arrPerDVC[$dvs] = 1;
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>CS_Problem/insert" method="POST" class="insert" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Complain Date</label>
                  <input type="text" name="f1" id="dp1" class="form-control" placeholder="yyyy-dd-mm" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Loan ID</label>
                  <input type="text" name="f2" class="form-control" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Ticket Create Date</label>
                  <input type="text" name="f3" id="dp2" class="form-control" placeholder="yyyy-dd-mm" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Repay Amount</label>
                  <input type="number" name="f4" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Remark</label>
                  <input type="text" name="f5" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
                <div class="col">
                  <label>Image (<span class="text-danger">Max. 10mb</span>)</label>
                  <input type="file" id="file" name="resi" required /> [ <span id="persen"><b>0</b></span><b> %</b> ] Upload Progress
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Insert</button>
      </div>
      </form>
    </div>
  </div>
</div>

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
  $(document).ready(function() {
    $("span#rows").html("<?= $row ?>");
    $("span#recap").html('<?= $recap ?>');

    $("form.insert").on("submit", function(e) {
      e.preventDefault();
      $('span#spinner').addClass('spinner-border spinner-border-sm');
      var formData = new FormData(this);
      var file = $('#file')[0].files[0];
      formData.append('file', file);

      $.ajax({
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = (evt.loaded / evt.total) * 100;
              $('#persen').html('<b>' + Math.round(percentComplete) + '</b>');
            }
          }, false);
          return xhr;
        },
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: "application/octet-stream",
        enctype: 'multipart/form-data',

        contentType: false,
        processData: false,

        success: function(dataRespon) {
          if (dataRespon == 1) {
            location.reload(true);
          } else {
            alert(dataRespon);
          }
          $('span#spinner').removeClass('spinner-border spinner-border-sm');
        },
      });
    });
  });

  $("span.response").on("click", function(e) {
    var id = $(this).attr('data-id');
    var path = $(this).attr('data-path');

    $('div.showResponse').load('<?= $this->BASE_URL ?>CS_Problem/responseForm/' + id + '/' + path);
  });
</script>

<script>
  $("#dp1").datepicker({
    format: 'yyyy-mm-dd',
  });
  $("#dp2").datepicker({
    format: 'yyyy-mm-dd',
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