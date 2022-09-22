<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header bg-light">
          <div class="d-flex justify-content-between">
            <h3 class="card-title"><b>Summary</b></h3>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm w-auto">
            <thead>
              <tr class="table-warning">
                <th>Rank</th>
                <th>OM ID</th>
                <th>OM Name</th>
                <th class="text-right">AVG Allocated Amount</th>
                <th class="text-right">AVG Repay Amount</th>
                <th>Repay Rate</th>
                <?php if ($data['dvcTipe'] == 1) { ?>
                  <th class="text-right">Yest. Repay Rate</th>
                  <th class="text-right">Yest. EOD Repay Rate</th>
                <?php } else { ?>
                  <th class="text-right">Yest. AVG Repay Amount</th>
                  <th class="text-right">Yest. EOD AVG Repay Amount</th>
                <?php }
                ?>
                <th class="text-right">AVG Handle Times</th>
                <th class="text-right">AVG Total Call</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 0;
              foreach ($data['data']['17'] as $key => $a) {
                $no++;
                $omID = $a['om'];
                $omName = "";
                foreach ($this->dEmp as $b) {
                  if ($omID == $b['employee_id']) {
                    $omName = $b['employee_name'];
                  }
                }

                if (isset($data['yest'][$key]['result'])) {
                  foreach ($data['yest'] as $yA) {
                    if ($yA['om'] == $omID) {
                      $yest_result = number_format(($yA['result']), 2);
                    }
                  }
                } else {
                  $yest_result = 0;
                }
                if (isset($data['yestEOD'][$key]['result'])) {
                  foreach ($data['yestEOD'] as $yA) {
                    if ($yA['om'] == $omID) {
                      $yestEOD_result = number_format(($yA['result']), 2);
                    }
                  }
                } else {
                  $yestEOD_result = 0;
                }

                if ($data['dvcTipe'] == 1) {
                  $unit = "%";
                } else {
                  $unit = "";
                }

                echo "<tr>";
                echo "<td class='text-right'><span>" . $no . "</span></td>";
                echo "<td nowrap><span>" . $omID . "</span></td>";
                echo "<td><span>" . $omName . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                echo "<td class='text-right'><span>" . $yest_result . $unit . "</span></td>";
                echo "<td class='text-right'><span>" . $yestEOD_result . $unit . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgHT'], 1) . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgTC'], 1) . "</span></td>";
                echo "</tr>";
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <?php
    foreach ($data['data'] as $jam => $jamValue) {
    ?>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-light">
            <div class="d-flex justify-content-between">
              <h3 class="card-title"><b><?= $jam ?></b> O'Clock</h3>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm">
              <thead>
                <tr class="table-primary">
                  <th>Rank</th>
                  <th>OM ID</th>
                  <th>OM Name</th>
                  <th class="text-right">AVG Allocated Amount</th>
                  <th class="text-right">AVG Repay Amount</th>
                  <th>Repay Rate</th>
                  <th class="text-right">AVG Handle Times</th>
                  <th class="text-right">AVG Total Call</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 0;
                foreach ($jamValue as $key => $a) {
                  $no++;
                  $omID = $a['om'];
                  $omName = "";
                  foreach ($this->dEmp as $b) {
                    if ($omID == $b['employee_id']) {
                      $omName = $b['employee_name'];
                    }
                  }
                  echo "<tr>";
                  echo "<td class='text-right'><span>" . $no . "</span></td>";
                  echo "<td nowrap><span>" . $omID . "</span></td>";
                  echo "<td><span>" . $omName . "</span></td>";
                  echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                  echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                  echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                  echo "<td class='text-right'><span>" .  number_format($a['avgHT'], 1) . "</span></td>";
                  echo "<td class='text-right'><span>" .  number_format($a['avgTC'], 1) . "</span></td>";
                  echo "</tr>";
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <div class="row">
    <div class="col-auto">
      <div class="card">
        <div class="card-header bg-light">
          <div class="d-flex justify-content-between">
            <h3 class="card-title"><b>END OF DAY</b></h3>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm">
            <thead>
              <tr class="table-success">
                <th>Rank</th>
                <th>OM ID</th>
                <th>OM Name</th>
                <th class="text-right">AVG Allocated Amount</th>
                <th class="text-right">AVG Repay Amount</th>
                <th>Repay Rate</th>
                <th class="text-right">AVG Handle Times</th>
                <th class="text-right">AVG Total Call</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $no = 0;
              foreach ($data['EOD'] as $key => $a) {
                $no++;
                $omID = $a['om'];
                $omName = "";
                foreach ($this->dEmp as $b) {
                  if ($omID == $b['employee_id']) {
                    $omName = $b['employee_name'];
                  }
                }
                echo "<tr>";
                echo "<td class='text-right'><span>" . $no . "</span></td>";
                echo "<td nowrap><span>" . $omID . "</span></td>";
                echo "<td><span>" . $omName . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                echo "<td class='text-right'><span>" .  number_format($a['avgHT'], 1) . "</span></td>";
                echo "<td class='text-right'><span>" .  number_format($a['avgTC'], 1) . "</span></td>";
                echo "</tr>";
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- SCRIPT -->
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>