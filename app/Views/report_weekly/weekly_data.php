<?php
switch ($data['level']) {
  case "om":
    $title = "Operation Manager";
    break;
  case "tl":
    $title = "Team Leader";
    break;
  case "employee_id":
    $title = "Staff";
    break;
} ?>

<?php
function Gradient($HexFrom, $HexTo, $HexTo2, $ColorSteps)
{
  $GradientColors = array();
  if ($ColorSteps <> 0) {
    $no = 0;
    $mod = $ColorSteps % 2;
    if ($mod == 0) {
      $ColorSteps1 = $ColorSteps / 2;
      $ColorSteps2 = ($ColorSteps / 2) + 1;
    } else {
      $ColorSteps1 = $ColorSteps / 2;
      $ColorSteps2 = ($ColorSteps / 2) + 1;
    }

    $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
    $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
    $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));

    $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
    $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
    $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

    $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps1 - 1);
    $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps1 - 1);
    $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps1 - 1);

    for ($i = 0; $i <= $ColorSteps1; $i++) {
      if ($mod == 0) {
        if ($i == $ColorSteps1) {
          break;
        }
      }
      $no++;
      $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
      $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
      $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

      $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
      $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
      $HexRGB['b'] = sprintf('%02x', ($RGB['b']));
      $GradientColors[$no] = implode("", $HexRGB);
    }

    $FromRGB['r'] = hexdec(substr($HexTo, 0, 2));
    $FromRGB['g'] = hexdec(substr($HexTo, 2, 2));
    $FromRGB['b'] = hexdec(substr($HexTo, 4, 2));

    $ToRGB['r'] = hexdec(substr($HexTo2, 0, 2));
    $ToRGB['g'] = hexdec(substr($HexTo2, 2, 2));
    $ToRGB['b'] = hexdec(substr($HexTo2, 4, 2));

    $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps2 - 1);
    $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps2 - 1);
    $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps2 - 1);

    for ($i = 0; $i <= $ColorSteps2; $i++) {
      $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
      $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
      $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

      $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
      $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
      $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

      $GradientColors[$no] = implode("", $HexRGB);
      $no++;
    }

    $GradientColors = array_filter($GradientColors, "len");
  }
  return $GradientColors;
}

function len($val)
{
  return (strlen($val) == 6 ? true : false);
}
?>

<div class="container-fluid">
  <?php
  if ($data['level'] <>  "employee_id") { ?>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header border-0 bg-light">
            <div class="d-flex justify-content-between">
              <h6 class="card-title"><span class="text-dark"><b><?= $title ?></b> Summary </span></small></h6>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-sm w-auto">
              <thead>
                <tr class="table-warning">
                  <th>Rank</th>
                  <?php switch ($data['level']) {
                    case "om": ?>
                      <th>OM ID</th>
                      <th>OM Name</th>
                      <th class="text-right">AVG Allocated Amount</th>
                      <th class="text-right">AVG Repay Amount</th>
                    <?php break;
                    case "tl": ?>
                      <th>TL ID</th>
                      <th>TL Name</th>
                      <th class="text-right">AVG Allocated Amount</th>
                      <th class="text-right">AVG Repay Amount</th>
                    <?php break;
                    case "employee_id": ?>
                      <th>Staff ID</th>
                      <th>Staff Name</th>
                      <th class="text-right">SUM Allocated Amount</th>
                      <th class="text-right">SUM Repay Amount</th>
                  <?php break;
                  } ?>
                  <th>Repay Rate</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 0;
                $Gradient = Gradient("008000", "FFFF00", "FF0000", count($data['summary']));
                foreach ($data['summary'] as $a) {
                  $no++;

                  $tl_name = "";
                  $staffName = "";
                  $omName = "";
                  $omID = "";
                  $tlID = "";
                  $staffID = "";
                  switch ($data['level']) {
                    case "om":
                      $omID = $a['om'];
                      break;
                    case "tl":
                      $tlID = $a['tl'];
                      break;
                    case "employee_id":
                      $staffID = $a['employee_id'];
                  }
                  foreach ($this->dEmpMerge as $b) {
                    if ($omID == $b['employee_id']) {
                      $omName = $b['employee_name'];
                    }
                    if ($tlID == $b['employee_id']) {
                      $tl_name = $b['employee_name'];
                    }
                    foreach ($this->dStaff as $ds) {
                      if ($ds['employee_id'] == $staffID) {
                        $staffName = $ds['employee_name'];
                      }
                    }
                  }

                  echo "<tr>";
                  echo "<td class='text-right'><span>" . $no . "</span></td>";
                  switch ($data['level']) {
                    case "om":
                      echo "<td nowrap><span>" . $omID . "</span></td>";
                      echo "<td nowrap><span>" . $omName . "</span></td>";
                      break;
                    case "tl":
                      echo "<td nowrap><span>" . $tlID . "</span></td>";
                      echo "<td nowrap><span>" . $tl_name . "</span></td>";
                      break;
                    case "employee_id":
                      echo "<td nowrap><span>" . $staffID . "</span></td>";
                      echo "<td nowrap><span>" . $staffName . "</span></td>";
                      break;
                  }

                  echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                  if ($data['dvc'] <> 'RM0') {
                    echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                  } else {
                    echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                  }
                  if ($data['dvc'] == 'RM0') {
                    echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . $a['repRate'] * 100 . "%</span></td>";
                  } else {
                    echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                  }
                  echo "</tr>";
                }
                $no = 0;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="row">
    <?php $week = 0;
    foreach ($data['data'] as $key => $b) {
      $week++;
      $Gradient = Gradient("008000", "FFFF00", "FF0000", count($b));
    ?>
      <div class="col">
        <div class="card">
          <div class="card-header border-0 bg-light">
            <div class="d-flex justify-content-between">
              <h6 class="card-title"><span class="text-success"><b><?= $title ?></b> </span> | <b>Week <?= $week ?> | <small></b> <?= $key ?></small></h6>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-sm w-auto">
              <thead>
                <tr class="table-primary">
                  <th>Rank</th>
                  <?php switch ($data['level']) {
                    case "om": ?>
                      <th>OM ID</th>
                      <th>OM Name</th>
                      <th class="text-right">AVG Allocated Amount</th>
                      <th class="text-right">AVG Repay Amount</th>
                    <?php break;
                    case "tl": ?>
                      <th>TL ID</th>
                      <th>TL Name</th>
                      <th class="text-right">AVG Allocated Amount</th>
                      <th class="text-right">AVG Repay Amount</th>
                    <?php break;
                    case "employee_id": ?>
                      <th>Staff ID</th>
                      <th>Staff Name</th>
                      <th class="text-right">SUM Allocated Amount</th>
                      <th class="text-right">SUM Repay Amount</th>
                  <?php break;
                  } ?>
                  <th>Repay Rate</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 0;
                foreach ($b as $a) {
                  $no++;

                  $tl_name = "";
                  $staffName = "";
                  $omName = "";
                  $omID = "";
                  $tlID = "";
                  $staffID = "";
                  switch ($data['level']) {
                    case "om":
                      $omID = $a['om'];
                      break;
                    case "tl":
                      $tlID = $a['tl'];
                      break;
                    case "employee_id":
                      $staffID = $a['employee_id'];
                  }

                  foreach ($this->dEmpMerge as $b) {
                    if ($omID == $b['employee_id']) {
                      $omName = $b['employee_name'];
                    }
                    if ($tlID == $b['employee_id']) {
                      $tl_name = $b['employee_name'];
                    }
                    foreach ($this->dStaff as $ds) {
                      if ($ds['employee_id'] == $staffID) {
                        $staffName = $ds['employee_name'];
                      }
                    }
                  }

                  echo "<tr>";
                  echo "<td class='text-right'><span>" . $no . "</span></td>";
                  switch ($data['level']) {
                    case "om":
                      echo "<td nowrap><span>" . $omID . "</span></td>";
                      echo "<td nowrap><span>" . $omName . "</span></td>";
                      break;
                    case "tl":
                      echo "<td nowrap><span>" . $tlID . "</span></td>";
                      echo "<td nowrap><span>" . $tl_name . "</span></td>";
                      break;
                    case "employee_id":
                      echo "<td nowrap><span>" . $staffID . "</span></td>";
                      echo "<td nowrap><span>" . $staffName . "</span></td>";
                      break;
                  }

                  echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                  if ($data['dvc'] <> 'RM0') {
                    echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                  } else {
                    echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                  }
                  if ($data['dvc'] == 'RM0') {
                    echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . $a['repRate'] * 100 . "%</span></td>";
                  } else {
                    echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                  }
                  echo "</tr>";
                }
                $no = 0;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- SCRIPT -->
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>