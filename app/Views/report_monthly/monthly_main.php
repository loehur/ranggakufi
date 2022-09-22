<?php
$currentMonth = date('m');
$currentYear = date('Y');
$currentDay = 21;

//PHP DATE
$phpDate = $currentMonth . "/" . $currentDay . "/" . $currentYear;
$phpDate = strtotime($phpDate);

//GET YESTERDAY
$lastMonth = strtotime("-1 month", $phpDate);
$lastMonth = date('Y-m-d', $lastMonth);

$thisMonth = strtotime("-1 day", $phpDate);
$thisMonth = date('Y-m-d', $thisMonth);
?>


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card p-1">
          <form id="filterForm" method="POST">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1">
                <label>From</label>
                <input type="text" name="f1" id="dp1" class="form-control form-control-sm" placeholder="yyyy-dd-mm" value="<?= $lastMonth; ?>" required>
              </div>
              <div class="p-1">
                <label>To</label>
                <input type="text" name="f2" id="dp2" class="form-control form-control-sm" placeholder="yyyy-dd-mm" value="<?= $thisMonth; ?>" required>
              </div>
          </form>
          <div class="p-1">
            <label>Division</label>
            <select name="dvc" class="form-control form-control-sm" style="width: auto;" required>
              <?php foreach ($this->dDvs as $a) { ?>
                <option value="<?= $a['tc_name'] ?>"><?= $a['tc_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mr-auto p-1">
            <span class="btn btn-sm btn-primary" id="btnOM" onclick="data('om')">Operation Manager</span>
          </div>
          <div class="mr-auto p-1">
            <span class="btn btn-sm btn-primary" onclick="data('tl')">Team Leader</span>
          </div>
          <div class="p-1">
            <span class="btn btn-sm btn-primary" onclick="data('employee_id')">Staff</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content w-100" id="data"></div>

<!-- SCRIPT -->
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    $("#btnOM").click();
  });

  function data(mode) {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Monthly/monthly_data/" + mode,
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#data").html(response);
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }
</script>

<script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>
<script>
  $("#dp1").datepicker({
    format: 'yyyy-mm-dd',
  });
  $("#dp2").datepicker({
    format: 'yyyy-mm-dd',
  });
</script>