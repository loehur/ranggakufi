<?php if ($data['raw'] == 1) {
  $title = "Hourly";
} else {
  $title = "Daily";
}
?>
<div class="content w-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <b>Upload List <span class="text-primary"><?= $title ?></span></b>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Insert Time</th>
                  <th>Row Count</th>
                  <th>Opt</th>
                </tr>
              </thead>
              <?php
              $no = 0;
              echo "<tbody>";
              foreach ($data['data'] as $a) {
                echo "<tr id='" . $a['insertTime'] . "'>";
                echo "<td class='text-right'><small>" . $a['insertTime'] . "</small></td>";
                echo "<td class='text-right'><small>" . number_format($a['count']) . "</small></td>";
                echo "<td class='text-right'><small><span class='btn badge badge-light' onClick='remove(" . $a['insertTime'] . ")'><i class='text-danger far fa-trash-alt'></i></span></small></td>";
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
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js">
</script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
  function remove(insertTime) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Upload_List/remove/<?= $data['raw'] ?>",
      data: {
        id: insertTime
      },
      type: "POST",
      success: function() {
        $("tr#" + insertTime).fadeOut("slow");
      },
    });
  }
</script>