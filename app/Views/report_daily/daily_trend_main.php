<?php
$currentMonth = date('m');
$currentYear = date('Y');
$currentDay = date('d');
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card p-1">
          <form id="main">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1 mb-1 text-primary">
                <b>From</b>
              </div>
              <div class="p-1">
                <label>Date</label>
                <select name="df" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
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
                <select name="mf" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
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
                <select name="Yf" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                  <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                            echo 'selected';
                                                          } ?>>2021</option>
                  <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                            echo 'selected';
                                                          } ?>>2022</option>
                </select>
              </div>

              <div class="p-1 mb-1 text-danger">
                <b>To</b>
              </div>

              <div class="p-1">
                <label>Date</label>
                <select name="dt" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
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
                <select name="mt" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
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
                <select name="Yt" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                  <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                            echo 'selected';
                                                          } ?>>2021</option>
                  <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                            echo 'selected';
                                                          } ?>>2022</option>
                </select>
              </div>

              <div class="p-1">
                <label>Tipe</label>
                <select name="tipe" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                  <option value="ticket_category" selected>Division</option>
                  <option value="om">OM</option>
                  <option value="tl">TL</option>
                </select>
              </div>
              <div class="p-1">
                <span class="btn btn-sm btn-primary" onclick="getOption()">Get Data</span>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="ticket_categorySelect" class="col-auto ">
        <div class="card p-1">
          <form id="ticket_category" action="<?= $this->BASE_URL; ?>Report_Hourly/trend/1" method="POST">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1">
                <label>Division</label>
                <select id="ticket_category" name="ticket_category" class="form-control form-control-sm" style="width: auto;" required>
                  <option value="" selected>---</option>
                </select>
              </div>
              <div class="mr-auto p-1">
                <span class="btn btn-sm btn-info" onclick="trend_data('ticket_category')">Cek Trend</span>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="omSelect" class="col-auto">
        <div class="card p-1">
          <form id="om" action="<?= $this->BASE_URL; ?>Report_Hourly/trend/1" method="POST">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1">
                <label>Operation Manager</label>
                <select id="om" name="om" class="form-control form-control-sm" style="width: auto;">
                  <option value="" selected>---</option>
                </select>
              </div>
              <div class="p-1">
                <label>Operation Manager (Compare)</label>
                <select id="om" name="om2" class="form-control form-control-sm" style="width: auto;">
                  <option value="" selected>---</option>
                </select>
              </div>
          </form>
          <div class="mr-auto p-1">
            <span class="btn btn-sm btn-info" onclick="trend_data('om')">Cek Trend</span>
          </div>
        </div>
      </div>
    </div>
    <div id="tlSelect" class="col-auto">
      <div class="card p-1">
        <form id="tl" action="<?= $this->BASE_URL; ?>Report_Hourly/trend/1" method="POST">
          <div class="d-flex align-items-start align-items-end">
            <div class="p-1">
              <label>Team Leader</label>
              <select id="tl" name="tl" class="form-control form-control-sm" style="width: auto;">
                <option value="" selected>---</option>
              </select>
            </div>
            <div class="mr-auto p-1">
              <span class="btn btn-sm btn-info" onclick="trend_data('tl')">Cek Trend</span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="content w-100" id="chartView"></div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/Chart.min.js"></script>

<script>
  $(document).ready(function() {
    hideAll();
  });

  function getOption() {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    var tipe = $('form#main').find('select[name="tipe"]').val();
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Daily/option_list",
      data: $("form#main").serialize(),
      type: "POST",
      success: function(jsonData) {
        const myObj = JSON.parse(jsonData);
        let options = "";
        for (let i in myObj) {
          options += "<option value='" + i + "'>" + myObj[i] + "</option>";
        }
        $('select#' + tipe).html(options);
        $("div#" + tipe + "Select").fadeIn("slow");
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }

  function trend_data(tc) {
    $('span#spinner').addClass('spinner-border spinner-border-sm');
    var base = $('form#' + tc).find('select[name="' + tc + '"]').val();
    var base2 = $('form#' + tc).find('select[name="' + tc + '2"]').val();
    var request = $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Daily/trend_data/" + tc + "/" + base + "/" + base2,
      data: $("form#main").serialize(),
      type: "POST",
      success: function(html) {
        $("div#chartView").html(html);
        $('span#spinner').removeClass('spinner-border spinner-border-sm');
      },
    });
  }

  function hideAll() {
    $("div#ticket_categorySelect").fadeOut('fast');
    $("div#omSelect").fadeOut('fast');;
    $("div#tlSelect").fadeOut('fast');;
  }
</script>