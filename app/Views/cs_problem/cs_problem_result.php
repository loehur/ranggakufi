<?php foreach ($data['data_result'] as $i) {
  $loanID = $i['loan_id'];
  foreach ($i as $key => $val) {
    if ($key <> 'loan_id') {
      $idTiket = $i['id_cp_result'];
      $d[$loanID][$idTiket][$key] = $val;
    }
  }
} ?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class='col p-0 m-1 rounded'>
        <div class='bg-white rounded p-1 sticky-top'>
          <div class="d-flex align-items-start align-items-end">
            <div class="mr-auto">
              <h6>Final Result</h6>
            </div>
            <div class="">
              <?php if ($_SESSION['userTipe'] == "admin" || $_SESSION['userTipe'] == "cs") { ?>
                <a href="<?= $this->BASE_URL ?>Upload/exportCSV/cs_problem_result" class="btn btn-sm btn-warning float-right mr-1 ml-1">
                  Export CSV
                </a><?php } ?>
              <?php if ($_SESSION['userTipe'] == "admin") { ?>
                <button type="button" class="btn btn-sm btn-primary float-right mr-1 ml-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  + Add Result
                </button><?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      foreach ($d as $dKey => $dVal) {
        echo "<div class='col p-0 m-1 rounded' style='max-width:350px;'>";
        echo "<div class='bg-white rounded p-1'>";
        echo "<span class='badge badge-info'>Loan ID #" . $dKey . "</span>";
        echo "<table class='table table-sm m-0 rounded'>";
        foreach ($dVal as $a) {
          $id = $a['id_cp_result'];
          $id_staff = $a['staff_id'];
          foreach ($this->dStaff as $ds) {
            if ($ds['employee_id'] == $id_staff) {
              $id_name = $ds['employee_name'];
            }
          }
          echo "<tr class='" . $id . "'>";
          echo "<td colspan='2' nowrap style='border-top:0'>" . $id_name . "<br><small>Division</small> " . $a['ticket_category'] . "</span>";
          if ($_SESSION['userTipe'] == "admin") { ?>
            <button data-class='<?= $id ?>' class='hapus float-right badge badge-danger  btn-outline-danger'><i class='fas fa-trash-alt'></i></button>
      <?php }
          echo "</td>";
          echo "</tr>";
          echo "<tr class='" . $id . "'>";
          echo "<td nowrap><small>Allocated (-)</small><br>" . number_format($a['allocated_min']) . "</td>";
          echo "<td nowrap class='text-right'><small>Payment (-)</small><br><span class='text-danger'>" . number_format($a['payment_min']) . "</span></td>";
          echo "</tr>";
          echo "<tr class='" . $id . "'>";
          echo "<td nowrap><small>Allocated (+)</small><br>" . number_format($a['allocated_plus']) . "</td>";
          echo "<td nowrap class='text-right'><small>Payment (+)</small><br><span class='text-success'>" . number_format($a['payment_plus']) . "</span></td>";
          echo "</tr>";
          // echo "<tr class='" . $id . "'>";
          // echo "<td nowrap><small>Complain Date</small><br>" . $a['complain_date'] . "</td>";
          // echo "<td nowrap class='text-right'><small>Resolve Date</small><br><span>" . $a['resolved_date'] . "</span></td>";
          // echo "</tr>";
        }
        echo "</table>";
        echo "</div></div>";
      } ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Insert Result</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>CS_Problem/insertResult" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Ticket Number</label>
                  <select name="ticket" id="ticket" class="form-control form-control-sm" style="width:100%;" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data['data'] as $a) { ?>
                      <option id="<?= $a['id_cs_problem'] ?>" value="<?= $a['id_cs_problem'] ?>" data-staff="<?= $a['emp_id'] ?>" data-payment="<?= $a['repay_amount_cs'] ?>" data-dvc="<?= $a['division'] ?>" data-loan="<?= $a['loan_id'] ?>" data-comDate="<?= $a['complain_date'] ?>" data-resDate="<?= $a['delay_date_resolved'] ?>"><?= $a['id_cs_problem'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Loan ID</label>
                  <select name="loan" id="selectLoan" class="form-control form-control-sm" style="width:100%;" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data['data'] as $a) { ?>
                      <option id="op<?= $a['id_cs_problem'] ?>" data-staff="<?= $a['emp_id'] ?>" value="<?= $a['loan_id'] ?>"><?= $a['loan_id'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Staff Name</label>
                  <select name="staff" id="selectStaff" class="form-control form-control-sm" style="width:100%;" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($this->dStaff as $a) { ?>
                      <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Division</label>
                  <select name="dvc" id="selectDVC" class="form-control form-control-sm" style="width:100%;" required>
                    <option value="" selected disabled>...</option>
                    <?php foreach ($data['data'] as $a) { ?>
                      <option value="<?= $a['division'] ?>"><?= $a['division'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Allocated <b>(-)</b></label>
                  <input min="0" type="number" name="aMin" value="0" class="form-control" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Allocated <b>(+)</b></label>
                  <input min="0" type="number" name="aPlus" class="form-control" value="0" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Payment <b>(-)</b></label>
                  <input min="0" type="number" name="pMin" value="0" class="form-control" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Payment <b>(+)</b></label>
                  <input min="0" id="paymentPlus" type="number" name="pPlus" value="0" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Complain Date</label>
                  <input type="text" name="comDate" id="comDate" class="form-control" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Resolve Date</b></label>
                  <input type="text" name="resDate" id="resDate" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div> -->

          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Insert</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/select2/select2.min.js"></script>

<script>
  $(document).ready(function() {
    selectList();
    $("form").on("submit", function(e) {
      e.preventDefault();
      $('span#spinner').addClass('spinner-border spinner-border-sm');
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: $(this).attr("method"),
        success: function() {
          location.reload(true);
        },
      });
    });
  });

  $("button.hapus").on("click", function() {
    var classNya = $(this).attr('data-class');
    $.ajax({
      url: "<?= $this->BASE_URL ?>CS_Problem/deleteResult/" + classNya,
      success: function() {
        $("tr." + classNya).fadeOut("slow");
      },
    });
  });

  $("select#ticket").change(function() {
    var staffID = $("option#" + $(this).val()).attr('data-staff');
    $('select#selectStaff').val(staffID);
    $('select#selectStaff').trigger('change');

    var dvc = $("option#" + $(this).val()).attr('data-dvc');
    $('select#selectDVC').val(dvc);
    $('select#selectDVC').trigger('change');

    var payment = $("option#" + $(this).val()).attr('data-payment');
    $('input#paymentPlus').val(payment);

    var loanID = $("option#" + $(this).val()).attr('data-loan');
    $('select#selectLoan').val(loanID);
    $('select#selectLoan').trigger('change');

    var comDate = $("option#" + $(this).val()).attr('data-comDate');
    $('input#comDate').val(comDate);

    var resDate = $("option#" + $(this).val()).attr('data-resDate');
    $('input#resDate').val(resDate);
  });

  function selectList() {
    $('select#ticket').select2({
      dropdownParent: $("#exampleModal"),
    });
    $('select#selectLoan').select2({
      dropdownParent: $("#exampleModal"),
    });
    $('select#selectStaff').select2({
      dropdownParent: $("#exampleModal"),
    });
    $('select#selectDVC').select2({
      dropdownParent: $("#exampleModal"),
    });
  }
</script>