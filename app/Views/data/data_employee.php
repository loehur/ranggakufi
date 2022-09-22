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
          <div class="card-body p-0">
            <table class="table table-sm" style="padding: 0;">
              <?php
              $no = 0;
              echo "<tbody>";
              foreach ($data['data'] as $h => $a) {
                $no++;
                if ($no == 1) {
                  echo "<tr>";
                  foreach ($a as $key => $value) {
                    if ($key != 'insertTime') {
                      echo "<th>" . $key . "</th>";
                    }
                  }
                  echo "<th>#</th>";
                  echo "</tr>";
                }
                $empID = $a['employee_id'];
                echo "<tr id='" . $a['employee_id'] . "'>";
                foreach ($a as $key => $value) {
                  if ($key <> 'insertTime') {
                    if ($key == 'ga') {
                      echo "<td><a href='#' onClick=ga('" . $empID . "','" . $value . "')><small><span id='ga" . $empID . "'>" . $value . "</span></small></a></td>";
                    } else {
                      echo "<td><small>" . $value . "</small></td>";
                    }
                  }
                }
                echo "<td class='text-right'><small><span class='btn badge badge-light' onClick=remove('" . $empID . "')><i class='text-danger far fa-trash-alt'></i></span></small></td>";
                echo "</tr>";
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
<script src=" <?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
  function remove(idnya) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Upload_List/remove_row/<?= $data['tb'] ?>",
      data: {
        id: idnya
      },
      type: "POST",
      success: function(result) {
        $("tr#" + idnya).fadeOut("slow");
      },
    });
  }

  function ga(idnya) {
    var value = $("span#ga" + idnya).html();
    $.ajax({
      url: "<?= $this->BASE_URL ?>Profil/enDisGA/<?= $data['tb'] ?>",
      data: {
        id: idnya,
        val: value
      },
      type: "POST",
      success: function(result) {
        $("span#ga" + idnya).html(result);
      },
    });
  }
</script>