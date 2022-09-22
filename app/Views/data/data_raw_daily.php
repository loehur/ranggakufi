<?php
if (count($data['dataTanggal']) > 0) {
  $currentMonth =   $data['dataTanggal']['bulan'];
  $currentYear =   $data['dataTanggal']['tahun'];
  $currentDay =   $data['dataTanggal']['tanggal'];
} else {
  $currentMonth = date('m');
  $currentYear = date('Y');
  $currentDay = date('d');
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="content sticky-top m-3 bg-light" style="min-width: 300px;">
            <form action="<?= $this->BASE_URL; ?>Raw_Data/i/2" method="POST">
              <table class="w-100">
                <tr>
                  <td>
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
                  </td>

                  <td>
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
                    <select name="Y" class="form-control form-control-sm" style="width: auto;">
                      <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                                echo 'selected';
                                                              } ?>>2021</option>
                      <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                                echo 'selected';
                                                              } ?>>2022</option>
                    </select>
                  </td>

                  <td><button class="form-control form-control-sm m-1 p-1 bg-light">Cek</td>
                  <td class="w-50"></td>
                  <td class="w-50" nowrap><b>Daily Row Data</b> <span class="rowCount"></span></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm" style="padding: 0;">
              <?php
              $no = 0;
              echo "<tbody>";
              foreach ($data['data'] as $h => $a) {
                echo "<tr>";
                foreach ($a as $key => $value) {
                  if ($key <> 'insertTime') {
                    echo "<td><small>" . $value . "</small></td>";
                  }
                }
                echo "</tr>";
                $no++;
              }
              echo "</tbody>";
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    $("span.rowCount").html(' [<?= $no ?>]')
  });
</script>