<?php
$s = [];
foreach ($data['data'] as $d) {
  if (isset($s[$d['tl']][100])) {
    $s[$d['tl']][100] += $d['percentage'];
  } else {
    $s[$d['tl']][100] = $d['percentage'];
  }
  $s[$d['tl']]['x100'] = floor(($s[$d['tl']][100]) / 100);
  $s[$d['tl']]['dvs'] = $d['bucket'];
}

?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1 ml-auto">
                Period: <span class="text-info text-bold"><?= $data['period'] ?></span>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-auto">
                <table class="table table-sm" style="padding: 0;">
                  <thead>
                    <th>Team Leader</th>
                    <th>Division</th>
                    <th>100%</th>
                  </thead>
                  <tbody>
                    <?php

                    foreach ($s as $k => $a) {

                      if ($_SESSION['userTipe'] <> "admin") {
                        if ($a['dvs'] <> $this->userDVC) {
                          continue;
                        }
                      }

                      $tl_id = $k;
                      $bucket = $a['dvs'];

                      $tl_name = "";
                      foreach ($this->dTL as $dt) {
                        if ($dt['employee_id'] == $tl_id) {
                          $tl_name = $dt['employee_name'];
                        }
                      }

                      echo "<tr class='table-borderless' style='border-top: 1px dashed silver'>";
                      echo "<td colspan='10' class='pb-0'></td>";
                      echo "</tr>";
                      echo "<tr class='table-borderless'>";
                      echo "<td>" . $tl_name . "</td>";
                      echo "<td>" . $bucket . "</td>";
                      echo "<td class='text-right'>" . $a['x100'] . "x</td>";
                      echo "</td>";
                      echo "</tr>";
                    }
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
                      <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
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
                      <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Waiver Amount</label>
                  <input type="number" name="waiver" class="form-control" placeholder="Waiver Amount" required>
                </div>
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

  $("form").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      type: $(this).attr("method"),
      success: function(res) {
        if (res == 1) {
          location.reload(true);
        } else {
          alert(res);
        }
      },
    });
  });

  function copyText(id) {
    var defaulHtml = $("span#" + id).html();
    var copyText = $("span#" + id).attr('data-loan');
    navigator.clipboard.writeText(copyText);
    $("span#" + id).html($("span#" + id).html() + " - Copied");
    setTimeout(function() {
      reset_copy(id, defaulHtml)
    }, 5000);
  }

  function reset_copy(id, defaulHtml) {
    $("span#" + id).html(defaulHtml);
  }
</script>