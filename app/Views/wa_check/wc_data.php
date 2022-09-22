<?php
$arrPerDVC = array();
$row = 0;
foreach ($data['data'] as $a) {
  $row++;
  $status =  $a['status'];
  if ($status == 1) {
    if (!isset($arrPerDVC['On Check'])) {
      $arrPerDVC['On Check'] = "#" . $row;
    }
    if (isset($arrPerDVC['Checking'])) {
      $arrPerDVC['Checking'] += 1;
    } else {
      $arrPerDVC['Checking'] = 1;
    }
  } elseif ($status == 2) {
    if (isset($arrPerDVC['Valid'])) {
      $arrPerDVC['Valid'] += 1;
    } else {
      $arrPerDVC['Valid'] = 1;
    }
  } elseif ($status == 6) {
    if (isset($arrPerDVC['Error'])) {
      $arrPerDVC['Error'] += 1;
    } else {
      $arrPerDVC['Error'] = 1;
    }
  } else {
    if (isset($arrPerDVC['Invalid'])) {
      $arrPerDVC['Invalid'] += 1;
    } else {
      $arrPerDVC['Invalid'] = 1;
    }
  }
}
$recap = json_encode($arrPerDVC, JSON_PRETTY_PRINT);
?>

<div class="row">
  <div>
    <b>Recap</b> <span id="rows"><?= $row ?></span> Rows, <span id="recap"><?= $recap ?></span>
  </div>
</div>
<div class="row">
  <div class="col-auto">
    <table class="table table-sm p-0">
      <?php
      $row = 0;
      foreach ($data['data'] as $a) {
        $id =  $a['id_notif'];
        $number =  $a['phone'];
        $status =  $a['status'];
        $update = $a['updateTime'];
        $user = $a['user'];

        $row += 1;
        $valid = "";
        $textStatus = "";

        if ($status == 1) {
          $textStatus = "<span class='text-dark'>Checking</span>";
        } elseif ($status == 2) {
          $textStatus = "<span class='text-success'>Valid</span>";
        } elseif ($status == 6) {
          $textStatus = "<span class='text-warning'>Error</span>";
        } else {
          $textStatus = "<span class='text-danger'>Invalid</span>";
        }

        if ($user == $this->id_user) {
          echo "<tr class='p-0 table-borderless " . $id . "'>";
          echo "<td>#" . $row . "</td>";
          echo "<td>" . $number . "</td>";
          echo "<td>" . $textStatus . "</td>";
          echo "<td>" . substr($update, 5, 11) . "</td>";
          echo "</tr>";
        }

        if ($row % 20 == 0) { ?>
    </table>
  </div>
  <div class="col-auto">
    <table class="table table-sm">
  <?php }
      }
      $cekCount = 0;
      if (isset($arrPerDVC['Checking'])) {
        $cekCount = $arrPerDVC['Checking'];
      }
  ?>
    </table>
  </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>

<script>
  var checkCount = 0;
  $(document).ready(function() {
    checkCount = "<?= $cekCount ?>";
  });

  function load_cek() {
    if (checkCount > 0) {
      $("div#content").load('<?= $this->BASE_URL ?>WA_Check/content');
    }
  }
</script>