<?php
$currentMonth = date('m');
$currentYear = date('Y');
$currentDay = date('d');
?>

<div class="content w-100 sticky-top">
  <div class="container-fluid">
    <div class="mb-3 bg-white pl-3 p-2 rounded border">
      <form id="filterForm" action="<?= $this->BASE_URL; ?>Report_Hourly/staff_tl/1" method="POST">
        <div class="d-flex align-items-start align-items-end">
          <div class="p-1">
            <label>Division</label>
            <select name="dvc" class="form-control form-control-sm" style="width: auto;" required>
              <?php foreach ($this->dDvs as $a) { ?>
                <option value="<?= $a['tc_name'] ?>"><?= $a['tc_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="p-1">
            <label>Date</label>
            <select name="d" class="form-control form-control-sm" style="width: auto;">
              <option class="text-right" value="01" <?php if ($currentDay == '01') {
                                                      echo 'selected';
                                                    } ?>>01</option>
              <option class="text-right" value="02" <?php if ($currentDay == '02') {
                                                      echo 'selected';
                                                    } ?>>02</option>
              <option class="text-right" value="03" <?php if ($currentDay == '03') {
                                                      echo 'selected';
                                                    } ?>>03</option>
              <option class="text-right" value="04" <?php if ($currentDay == '04') {
                                                      echo 'selected';
                                                    } ?>>04</option>
              <option class="text-right" value="05" <?php if ($currentDay == '05') {
                                                      echo 'selected';
                                                    } ?>>05</option>
              <option class="text-right" value="06" <?php if ($currentDay == '06') {
                                                      echo 'selected';
                                                    } ?>>06</option>
              <option class="text-right" value="07" <?php if ($currentDay == '07') {
                                                      echo 'selected';
                                                    } ?>>07</option>
              <option class="text-right" value="08" <?php if ($currentDay == '08') {
                                                      echo 'selected';
                                                    } ?>>08</option>
              <option class="text-right" value="09" <?php if ($currentDay == '09') {
                                                      echo 'selected';
                                                    } ?>>09</option>
              <option class="text-right" value="10" <?php if ($currentDay == '10') {
                                                      echo 'selected';
                                                    } ?>>10</option>
              <option class="text-right" value="11" <?php if ($currentDay == '11') {
                                                      echo 'selected';
                                                    } ?>>11</option>
              <option class="text-right" value="12" <?php if ($currentDay == '12') {
                                                      echo 'selected';
                                                    } ?>>12</option>
              <option class="text-right" value="13" <?php if ($currentDay == '13') {
                                                      echo 'selected';
                                                    } ?>>13</option>
              <option class="text-right" value="14" <?php if ($currentDay == '14') {
                                                      echo 'selected';
                                                    } ?>>14</option>
              <option class="text-right" value="15" <?php if ($currentDay == '15') {
                                                      echo 'selected';
                                                    } ?>>15</option>
              <option class="text-right" value="16" <?php if ($currentDay == '16') {
                                                      echo 'selected';
                                                    } ?>>16</option>
              <option class="text-right" value="17" <?php if ($currentDay == '17') {
                                                      echo 'selected';
                                                    } ?>>17</option>
              <option class="text-right" value="18" <?php if ($currentDay == '18') {
                                                      echo 'selected';
                                                    } ?>>18</option>
              <option class="text-right" value="19" <?php if ($currentDay == '19') {
                                                      echo 'selected';
                                                    } ?>>19</option>
              <option class="text-right" value="20" <?php if ($currentDay == '20') {
                                                      echo 'selected';
                                                    } ?>>20</option>
              <option class="text-right" value="21" <?php if ($currentDay == '21') {
                                                      echo 'selected';
                                                    } ?>>21</option>
              <option class="text-right" value="22" <?php if ($currentDay == '22') {
                                                      echo 'selected';
                                                    } ?>>22</option>
              <option class="text-right" value="23" <?php if ($currentDay == '23') {
                                                      echo 'selected';
                                                    } ?>>23</option>
              <option class="text-right" value="24" <?php if ($currentDay == '24') {
                                                      echo 'selected';
                                                    } ?>>24</option>
              <option class="text-right" value="25" <?php if ($currentDay == '25') {
                                                      echo 'selected';
                                                    } ?>>25</option>
              <option class="text-right" value="26" <?php if ($currentDay == '26') {
                                                      echo 'selected';
                                                    } ?>>26</option>
              <option class="text-right" value="27" <?php if ($currentDay == '27') {
                                                      echo 'selected';
                                                    } ?>>27</option>
              <option class="text-right" value="28" <?php if ($currentDay == '28') {
                                                      echo 'selected';
                                                    } ?>>28</option>
              <option class="text-right" value="29" <?php if ($currentDay == '29') {
                                                      echo 'selected';
                                                    } ?>>29</option>
              <option class="text-right" value="30" <?php if ($currentDay == '30') {
                                                      echo 'selected';
                                                    } ?>>30</option>
              <option class="text-right" value="31" <?php if ($currentDay == '31') {
                                                      echo 'selected';
                                                    } ?>>31</option>
            </select>
          </div>
          <div class="p-1">
            <label>Month</label>
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
          </div>
          <div class="p-1">
            <label>Year</label>
            <select name="Y" class="form-control form-control-sm" style="width: auto;">
              <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                        echo 'selected';
                                                      } ?>>2021</option>
              <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                        echo 'selected';
                                                      } ?>>2022</option>
            </select>
          </div>
          <div class="p-1">
            <label>Hour</label>
            <select name="h" class="form-control form-control-sm" style="width: auto;" required>
              <?php foreach ($this->dHour as $a) { ?>
                <option class="text-right" value="<?= $a['hour'] ?>"><?= $a['hour']; ?></option>
              <?php } ?>
              <option class="text-right" value="eod">EOD</option>
            </select>
          </div>
      </form>
      <div class="mr-auto p-1">
        <span class="btn btn-sm btn-primary" id="btnOM" onclick="tl_om()">Cek OM/TL</span>
      </div>
      <div class="p-1">
        <span class="btn btn-sm btn-primary" onclick="allStaff()">ALL Staff</span>
      </div>
    </div>
  </div>
</div>


<div class="content w-100" id="omView"></div>
<div class="content w-100" id="tlView"></div>
<div class="content w-100" id="staffView"></div>

<!-- SCRIPT -->
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
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

    $("#btnOM").click();
  });

  function tl_om() {
    $("div#omView").show();
    $("div#tlView").show();
    $("div#staffView").hide();
    showOM();
    showTL();
  }

  function allStaff() {
    $("div#staffView").show();
    $("div#omView").hide();
    $("div#tlView").hide();
    showStaff();
  }

  function showOM() {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Hourly/staff_tl/1/date/0",
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#omView").html(response);
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }

  function showTL(om_id) {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Hourly/staff_tl/2/date/0",
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#tlView").html(response);
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }

  function showStaff(id, base) {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Hourly/staff_tl/3/" + base + "/" + id,
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#staffView").html(response);
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }
</script>