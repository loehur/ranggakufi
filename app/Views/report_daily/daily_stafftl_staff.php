<div class="content w-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title"><b>Staff</b> Ranking</h3>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead style="cursor: pointer;">
                <tr class="table-secondary">
                  <th>Rank</th>
                  <th>Staff ID</th>
                  <th>EMP Name</th>
                  <th>TL NAME</th>
                  <th>OM Name</th>
                  <th>SUM Allocated Amount</th>
                  <th>SUM Repay Amount</th>
                  <th>Rate Of Return</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 0;
				$allCount = count($data['data']);
				  if($allcount != 0){
					$arrRA = array_column($data['data'], 'total_repay_amount');
	                $totalRA = array_sum($arrRA);
	                $arrAM = array_column($data['data'], 'allocated_amount');
                	$totalAM = array_sum($arrAM);
                	$average = ($totalRA / $totalAM) / $allCount;  
				  }
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

                  $repRate = $a['repRate'] * 100;
                  $cf = "";
                  if ($repRate < $average) {
                    $cf = "bg-danger";
                  }

                  echo "<tr class='" . $cf . "'>";
                  echo "<td class='text-right'><span>" . $no . "</span></td>";
                  echo "<td><span>" . $a['employee_id'] . "</span></td>";
                  echo "<td><span>" . $a['assign_to'] . "</span></td>";
                  echo "<td><span>" . $tlName . "</span></td>";
                  echo "<td><span>" . $omName . "</span></td>";
                  echo "<td class='text-right'><span>" . number_format($a['allocated_amount'], 2) . "</span></td>";
                  echo "<td class='text-right'><span>" . number_format($a['total_repay_amount'], 2) . "</span></td>";
                  echo "<td class='text-right'><span>" . $repRate . "%</span></td>";
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
<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/jquery.tablesort.js"></script>

<script>
  $(document).ready(function() {
    $('table').tablesort();
  });
</script>