<style>
  canvas {
    background: #fff;
    height: 350px;
  }
</style>

<?php
$dataAJson = array();
$dataBJson = array();
$dataAJson2 = array();
$dataBJson2 = array();
$arrDate1 = array_column($data['data'], "date_");
$arrDate2 = array_column($data['data2'], "date_");
$countLabel1 = count($arrDate1);
$countLabel2 = count($arrDate2);

if ($countLabel1 > $countLabel2) {
  $arrDate = $arrDate1;
} else {
  $arrDate = $arrDate2;
}

foreach ($arrDate as $key => $val) {
  $labelDate[$key] = substr($val, -2);
}
$dateJson = json_encode($labelDate);

$label = $data['label'];
$label2 = $data['label2'];

foreach ($arrDate as $dateVal) {
  foreach ($data['data'] as $a) {
    if ($a['date_'] == $dateVal) {
      $dataAJson[$dateVal] = $a['avgTRA'];
      $dataBJson[$dateVal] = $a['repRate'];
    }
    if (!isset($dataAJson[$dateVal])) {
      $dataAJson[$dateVal] = 0;
    }
    if (!isset($dataBJson[$dateVal])) {
      $dataBJson[$dateVal] = 0;
    }
  }

  foreach ($data['data2'] as $a) {
    if ($a['date_'] == $dateVal) {
      $dataAJson2[$dateVal] = $a['avgTRA'];
      $dataBJson2[$dateVal] = $a['repRate'];
    }
    if (!isset($dataAJson2[$dateVal])) {
      $dataAJson2[$dateVal] = 0;
    }
    if (!isset($dataBJson2[$dateVal])) {
      $dataBJson2[$dateVal] = 0;
    }
  }
}

$dataAJson = json_encode(array_values($dataAJson));
$dataBJson = json_encode(array_values($dataBJson));

$dataAJson2 = json_encode(array_values($dataAJson2));
$dataBJson2 = json_encode(array_values($dataBJson2));
?>

<div class="container-fluid">
  <div class="row">
    <div class="col" style="max-width: 600px;">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Averaging Repay Amount</h3>
        </div>
        <div class="wrapper m-3">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col" style="max-width: 600px;">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Repay Rate (%)</h3>
        </div>
        <div class="wrapper m-3">
          <canvas id="myChart2"></canvas>
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
<script src="<?= $this->ASSETS_URL ?>js/chart.min.js"></script>

<script>
  $(document).ready(function() {
    <?php
    if ($countLabel2 > 0) { ?>
      var data = {
        "datasets": [{
          "backgroundColor": "rgb(156, 39, 176)",
          "borderColor": "rgb(156, 39, 176)",
          "fill": false,
          "data": <?= $dataAJson ?>,
          "id": "a",
          "label": " <?= $label ?>",
          "tension": 0.5
        }, {
          "backgroundColor": "RED",
          "borderColor": "RED",
          "fill": false,
          "data": <?= $dataAJson2 ?>,
          "id": "a2",
          "label": " <?= $label2 ?>",
          "tension": 0.5
        }],
        "labels": <?= $dateJson ?>,
      };
    <?php } else { ?>
      var data = {
        "datasets": [{
          "backgroundColor": "rgb(156, 39, 176)",
          "borderColor": "rgb(156, 39, 176)",
          "fill": false,
          "data": <?= $dataAJson ?>,
          "id": "a",
          "label": " <?= $label ?>",
          "tension": 0.5
        }],
        "labels": <?= $dateJson ?>,
      };
    <?php } ?>

    var options = {
      "maintainAspectRatio": false,
      "responsive": true,
      plugins: {
        title: {
          display: true,
        },
      },
    }
    var type = "line";
    var myChart = new Chart(document.getElementById("myChart").getContext('2d'), {
      options,
      data,
      type
    });

    <?php
    if ($countLabel2 > 0) { ?>
      var data = {
        "datasets": [{
          "backgroundColor": "rgb(156, 39, 176)",
          "borderColor": "rgb(156, 39, 176)",
          "fill": false,
          "data": <?= $dataBJson ?>,
          "id": "a",
          "label": " <?= $label ?>",
          "tension": 0.5
        }, {
          "backgroundColor": "RED",
          "borderColor": "RED",
          "fill": false,
          "data": <?= $dataBJson2 ?>,
          "id": "a2",
          "label": " <?= $label2 ?>",
          "tension": 0.5
        }],
        "labels": <?= $dateJson ?>,
      };
    <?php } else { ?>
      var data = {
        "datasets": [{
          "backgroundColor": "rgb(156, 39, 176)",
          "borderColor": "rgb(156, 39, 176)",
          "fill": false,
          "data": <?= $dataBJson ?>,
          "id": "a",
          "label": " <?= $label ?>",
          "tension": 0.5
        }],
        "labels": <?= $dateJson ?>,
      };
    <?php } ?>

    var options = {
      "maintainAspectRatio": false,
      "responsive": true,
      plugins: {
        title: {
          display: true,
        },
      },
    }
    var type = "line";
    var myChart = new Chart(document.getElementById("myChart2").getContext('2d'), {
      options,
      data,
      type
    });
  });
</script>