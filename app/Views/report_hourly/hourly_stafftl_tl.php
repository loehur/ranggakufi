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

$Gradient = Gradient("008000", "FFFF00", "FF0000", count($data['data']));
?>

<div class="container-fluid">
  <div class="content w-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title"><b>Team Leader</b> Ranking</h3>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-sm w-auto">
                <thead style="cursor: pointer;">
                  <tr class="table-info">
                    <th>Rank</th>
                    <th>TL ID</th>
                    <th>TL Name</th>
                    <th>OM Name</th>
                    <th>AVG Allocated Amount</th>
                    <th>AVG Repay Amount</th>
                    <th class="text-right">AVG Handle Times</th>
                    <th class="text-right">AVG Total Call</th>
                    <th>Repay Rate</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no = 0;
                  foreach ($data['data'] as $a) {
                    $no++;
                    $tliD = $a['tl'];
                    $omID = $a['om'];
                    $tlName = "";
                    $omName = "";
                    foreach ($this->dEmp as $b) {
                      if ($tliD == $b['employee_id']) {
                        $tlName = $b['employee_name'];
                      }
                      if ($omID == $b['employee_id']) {
                        $omName = $b['employee_name'];
                      }
                    }
                    echo "<tr>";
                    echo "<td class='text-right'><span>" . $no . "</span></td>";
                    echo "<td><span>" . $tliD . "</span></td>"; ?>
                    <td><span class="badge badge-light btn" onclick="showStaffbaseTL('<?= $tliD ?>')"><?= $tlName ?></span></td>
                  <?php
                    echo "<td><span>" . $omName . "</span></td>";
                    echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                    if ($data['dvc'] <> 'RM0') {
                      echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                    } else {
                      echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                    }
                    echo "<td class='text-right'><span>" .  number_format($a['avgHT'], 1) . "</span></td>";
                    echo "<td class='text-right'><span>" .  number_format($a['avgTC'], 1) . "</span></td>";
                    if ($data['dvc'] == 'RM0') {
                      echo "<td class='text-right' style='background-color: #" . strtoupper($Gradient[$no]) . "'><span>" . $a['repRate'] * 100 . "%</span></td>";
                    } else {
                      echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
                    }
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
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
<script src="<?= $this->ASSETS_URL ?>js/jquery.tablesort.js"></script>

<script>
  $(document).ready(function() {
    $('table').tablesort();
  });

  function showStaffbaseTL(tl_id) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Hourly/staff_tl/3/tl/" + tl_id,
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#staffView").show();
        $("div#staffView").html(response);
      },
    });
  }
</script>