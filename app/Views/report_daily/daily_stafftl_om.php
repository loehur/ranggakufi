<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title"><b>Operation Manager</b> Ranking</h3>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-sm w-auto">
            <thead style="cursor: pointer;">
              <tr class="table-primary">
                <th>Rank</th>
                <th>OM ID</th>
                <th>OM Name</th>
                <th class="text-right">AVG Allocated Amount</th>
                <th class="text-right">AVG Repay Amount</th>
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
                echo "<td><span>" . $omID . "</span></td>"; ?>
                <td><span class="badge badge-light btn" onclick="tl_staff('<?= $omID ?>')"><?= $omName ?></span></td>
              <?php
                echo "<td class='text-right'><span>" . number_format($a['avgAA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" . number_format($a['avgTRA'], 2) . "</span></td>";
                echo "<td class='text-right'><span>" .  number_format($a['avgHT'], 1) . "</span></td>";
                echo "<td class='text-right'><span>" .  number_format($a['avgTC'], 1) . "</span></td>";
                echo "<td class='text-right'><span>" . $a['repRate'] * 100 . "%</span></td>";
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

  function tl_staff(om_id) {
    showTLbaseOM(om_id);
    showStaffbaseOM(om_id);
  }

  function showTLbaseOM(om_id) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Daily/staff_tl/2/om/" + om_id,
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#tlView").html(response);
      },
    });
  }

  function showStaffbaseOM(om_id) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Report_Daily/staff_tl/3/om/" + om_id,
      data: $("form#filterForm").serialize(),
      type: $("form#filterForm").attr("method"),
      success: function(response) {
        $("div#staffView").show();
        $("div#staffView").html(response);
      },
    });
  }
</script>