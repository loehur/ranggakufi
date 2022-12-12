<?php $title = $data['pageInfo']['title']; ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1">
                <?php if ($_SESSION['userTipe'] == "staff") { ?>
                  <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Relief
                  </button><?php } ?>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-auto">
                <table class="table table-sm" style="padding: 0;">
                  <tbody>
                    <?php
                    $row = 0;
                    $arrPerDVC = array();
                    foreach ($data['data'] as $a) {

                      $id =  $a['id_relief'];
                      $emp_id =  $a['emp_id'];
                      $om_name = $a['om'];
                      $tl_name = $a['tl'];
                      $loan_id = $a['loan_id'];

                      $bucket = $a['bucket'];

                      $emp_name = "";
                      foreach ($this->dStaff as $ds) {
                        if ($ds['employee_id'] == $emp_id) {
                          $emp_name = $ds['employee_name'];
                        }
                      }

                      echo "<tr class='table-borderless " . $id . "' style='border-top: 1px dashed silver'>";
                      echo "<td colspan='7' class='pb-0'><h7><small>Loan ID </small> <span class='badge badge-info p-1'><b>#" . $loan_id . "</b></span></h7>";
                      echo "</tr>";
                      echo "<tr class='table-borderless " . $id . "'>";
                      echo "<td class='text-right' ><small>Relief ID:</small><br>#" . $id . "</td>";
                      echo "<td><small>" . $emp_id . "<br><b><span>" . $emp_name . "</span></small></td>";
                      echo "<td><b><small><b>Bucket:</b> " . $bucket . " <br><b>OM:</b> " . $om_name . " <b><br>TL:</b> " . $tl_name . "</small></td>";
                      echo "<td><small>Date</small><br>" . $a['date_'] . "</td>";
                      echo "<td><small>Request Date</small><br>" . $a['request_date'] . "</td>";
                      echo "<td class='text-right'><small>Amount</small><br>" . number_format($a['repay_amount']) . "</td>";
                      echo "<td><small>Remark</small><br><span style='color:#DC7633'><b>" . $a['remark'] . "</b></span></td>";
                      echo "</td>";
                      echo "<td><small>OM Check</small><br><a href='#'><span class='mr-1 btn badge badge-success'>Approve</span></a><span class='btn badge badge-danger'>Reject</span></a></td>";
                      echo "<td><small>Admin Check</small><br><a href='#'><span class='mr-1 btn badge badge-success'>Approve</span></a><span class='btn badge badge-danger'>Reject</span></a></td>";
                      echo "</tr>";
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
        <h5 class="modal-title" id="exampleModalLabel">Add Relief</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>Relief/insert" method="POST" class="insert" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Loan ID</label>
                  <input type="text" name="loan_id" class="form-control" placeholder="Loan ID" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Repayment Amount</label>
                  <input type="number" name="rep_amount" class="form-control" placeholder="Repayment Amount" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Total 4 Elements</label>
                  <input type="number" name="4element" class="form-control" placeholder="Total 4 Elements" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">DPD</label>
                  <input type="number" name="dpd" class="form-control" placeholder="DPD" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="text" name="date_" id="dp1" class="form-control" placeholder="yyyy-dd-mm" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Bucket</label>
                  <select name="bucket" class="tize form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($this->dDvs as $a) { ?>
                      <option value="<?= $a['tc_name'] ?>"><?= $a['tc_name'] ?></option>
                    <?php } ?>
                  </select>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">TL</label>
                  <select name="tl" class="tize form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($this->dTL as $a) { ?>
                      <option value="<?= $a['employee_name'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">OM</label>
                  <select name="om" class="tize form-control form-control-sm p-0 m-0" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($this->dOM as $a) { ?>
                      <option value="<?= $a['employee_name'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Remark</label>
                  <input type="text" name="remark" class="form-control" placeholder="Remark" required>
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
<script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>

<script>
  $(document).ready(function() {
    $('select.tize').selectize();
  });

  $("#dp1").datepicker({
    format: 'yyyy-mm-dd',
  });
</script>