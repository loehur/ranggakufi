<?php
$arrAvgTRA = array_column($data['data'], "avgTRA");
$arrAvgRepRate = array_column($data['data'], "repRate");

array_push($arrAvgTRA, $data['dataEOD'][0]['avgTRA']);
array_push($arrAvgRepRate, $data['dataEOD'][0]['repRate']);

$dataAJson = json_encode($arrAvgTRA);
$dataBJson =  json_encode($arrAvgRepRate);

$arrDate = array_column($data['data'], "date_");
foreach ($arrDate as $key => $val) {
  $labelDate[$key] = substr($val, -2);
}

$labelDate[$key + 1] = "EOD";
$dateJson = json_encode($labelDate);
$label = $data['label'];
?>

<style>
  canvas {
    background: #fff;
    height: 350px;
  }
</style>

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
    var data = {
      "datasets": [{
        "backgroundColor": "rgb(156, 39, 176)",
        "borderColor": "rgb(156, 39, 176)",
        "fill": false,
        "data": <?= $dataAJson ?>,
        "id": "a",
        "label": "Averaging Repay Amount",
        "tension": 0.3
      }, ],
      "labels": <?= $dateJson ?>,
    };
    var options = {
      "maintainAspectRatio": false,
      "responsive": true,
      plugins: {
        title: {
          display: true,
          text: 'Division: <?= $label ?>',
        },
      },
    }
    var type = "line";
    var myChart = new Chart(document.getElementById("myChart").getContext('2d'), {
      options,
      data,
      type
    });

    var data = {
      "datasets": [{
        "backgroundColor": "rgb(39, 176, 200)",
        "borderColor": "rgb(39, 176, 200)",
        "fill": false,
        "data": <?= $dataBJson ?>,
        "id": "b",
        "label": "Repay Rate (%)",
        "tension": 0.3
      }],
      "labels": <?= $dateJson ?>,
    };
    var options = {
      "maintainAspectRatio": false,
      "responsive": true,
      plugins: {
        title: {
          display: true,
          text: 'Division: <?= $label ?>',
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