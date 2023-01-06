<?php $title = $data['pageInfo']['title'];
$sp_final = [];
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <?php if ($_SESSION['userTipe'] == "qc") { ?>
              <div class="d-flex align-items-start align-items-end">
                <div class="mr-auto">
                  <div class="p-1">
                    <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      + Insert SP
                    </button>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php
            foreach ($data['data'] as $key => $d) {
              foreach ($d as $a) {
                $sp_id =  $a['id_sp'];
                if (isset($sp_final[$sp_id])) {
                  $sp_final[$sp_id] += $a['sp'];
                } else {
                  $sp_final[$sp_id] = $a['sp'];
                }
              }
            }
            ?>


            <div class="card-body p-0 pt-1 mt-2">
              <div class="row">
                <div class="col-auto">
                  <?php
                  foreach ($data['data'] as $key => $d) {
                    $sp = 0
                  ?>
                    <table class="table table-sm" class="border-collapse: collapse" style="padding: 0;">
                      <tbody>
                      <?php
                      foreach ($d as $a) {
                        $sp += $a['sp'];
                        $path = $a['file_path'];
                        $sPath = str_replace('/', '_slash_', $path);
                        $sPath = str_replace('-', '_strip_', $sPath);
                        $sPath = str_replace(' ', '_space_', $sPath);

                        $sp_id =  $a['id_sp'];
                        $emp_id =  $a['emp_id'];
                        $cs_id = $a['qc_id'];
                        $id_name = "";
                        $om_id =  $a['om'];
                        $tl_id =  $a['tl'];
                        $om_name = "";
                        $tl_name = "";
                        $sp_date = $a['sp_date'];

                        $analyzed = "";

                        foreach ($this->dStaff as $ds) {
                          if ($ds['employee_id'] == $emp_id) {
                            $id_name = $ds['employee_name'];
                          }
                        }

                        foreach ($this->dOM as $do) {
                          if ($do['employee_id'] == $om_id) {
                            $om_name = $do['employee_name'];
                          }
                        }

                        foreach ($this->dTL as $dt) {
                          if ($dt['employee_id'] == $tl_id) {
                            $tl_name = $dt['employee_name'];
                          }
                        }

                        $dvs = $a['division'];

                        $exp_date    = date('Y-m-d', strtotime('+90 days', strtotime($sp_date)));
                        $sp_show = "";

                        $qc = $a['qc_id'];
                        foreach ($this->dQC as $lqc) {
                          if ($lqc['employee_id'] == $qc) {
                            $qc = $lqc['employee_name'];
                          }
                        }


                        echo "<tr class='table-borderless " . $sp_id . "' style='border-top: 1px dashed silver'>";
                        echo "<td colspan='9' class='pb-0'><h7><small>SP ID </small> <span class='badge badge-info p-1'><b>#" . $sp_id . "</b></span></h7> <a target='_blank' href='" . $this->BASE_URL . $a['file_path'] . $a['file_name'] . "'><span class='btn badge badge-primary'><i class='far fa-eye'></i> SP View</span></a>";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr class='table-borderless " . $sp_id . "'>";
                        echo "<td><small>" . $emp_id . "</small><br><b><span>" . $id_name . "</span><br></td>";
                        echo "<td><b><small><b>Division:</b> " . $dvs . " <br><b>OM:</b> " . $om_name . " <b><br>TL:</b> " . $tl_name . "</small></td>";
                        echo "<td><small>SP Date</small><br>" . $sp_date . "</td>";
                        echo "<td><b class='text-primary'>SP" . $a['sp'] . "</b> - Final: <b class='text-danger'>SP" . $sp_final[$sp_id] . "</b><br><small><b>QC</b>: " . $qc . "</small></td>";
                        echo "<td><small>Remark</small><br><span style='color:#DC7633'><b>" . $a['remark'] . "</b></span></td>";
                        echo "<td><small>Expired Date</small><br>" . $exp_date . "</td>";
                        echo "</tr>";
                      }
                      echo "</tbody></table>";
                    }
                      ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
        </div>
        <div class="modal-body">
          <!-- ====================== FORM ========================= -->
          <form action="<?= $this->BASE_URL; ?>SP/insert" method="POST" class="insert" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label for="exampleInputEmail1">SP Date</label>
                    <input type="text" name="f1" id="dp1" class="form-control" placeholder="yyyy-dd-mm" required>
                  </div>
                  <div class="col">
                    <label for="exampleInputEmail1">SP</label>
                    <select name="f2" class="tize form-control form-control-sm p-0 m-0" required>
                      <option value="1" selected>SP 1</option>
                      <option value="2">SP 2</option>
                      <option value="3">SP 3</option>
                      <option value="4">SP 4</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label for="exampleInputEmail1">To Staff</label>
                    <select name="f3" class="tize form-control form-control-sm p-0 m-0" required>
                      <option value="" selected disabled>...</option>
                      <?php foreach ($data['staff'] as $a) { ?>
                        <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label for="exampleInputEmail1">TL</label>
                    <select name="f5" class="tize form-control form-control-sm p-0 m-0" required>
                      <option value="" selected disabled>...</option>
                      <?php foreach ($data['tl'] as $a) { ?>
                        <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label for="exampleInputEmail1">OM</label>
                    <select name="f6" class="tize form-control form-control-sm p-0 m-0" required>
                      <option value="" selected disabled>...</option>
                      <?php foreach ($data['om'] as $a) { ?>
                        <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label for="exampleInputEmail1">Remark</label>
                    <input type="text" name="f4" class="form-control" id="exampleInputEmail1" placeholder="" required>
                  </div>
                  <div class="col">
                    <label>SP - PDF FILE (<span class="text-danger">Max. 10mb</span>)</label>
                    <input type="file" id="file" name="file" required /> [ <span id="persen"><b>0</b></span><b> %</b> ] Upload Progress
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Insert</button>
        </div>
        </form>
      </div>
    </div>

    <!-- SCRIPT -->
    <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>
    <script src="<?= $this->ASSETS_URL ?>js/selectize.min.js"></script>

    <script>
      $(document).ready(function() {
        $('select.tize').selectize();

        $("form.insert").on("submit", function(e) {
          e.preventDefault();
          $('span#spinner').addClass('spinner-border spinner-border-sm');
          var formData = new FormData(this);
          var file = $('#file')[0].files[0];
          formData.append('file', file);

          $.ajax({
            xhr: function() {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = (evt.loaded / evt.total) * 100;
                  $('#persen').html('<b>' + Math.round(percentComplete) + '</b>');
                }
              }, false);
              return xhr;
            },
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: "application/octet-stream",
            enctype: 'multipart/form-data',

            contentType: false,
            processData: false,

            success: function(dataRespon) {
              if (dataRespon == 1) {
                location.reload(true);
              } else {
                alert(dataRespon);
              }
              $('span#spinner').removeClass('spinner-border spinner-border-sm');
            },
          });
        });
      });
    </script>

    <script>
      $("#dp1").datepicker({
        format: 'yyyy-mm-dd',
      });
      $("#dp2").datepicker({
        format: 'yyyy-mm-dd',
      });

      function remove(idnya) {
        $.ajax({
          url: "<?= $this->BASE_URL ?>Upload_List/remove_row/cs_problem",
          data: {
            id: idnya
          },
          type: "POST",
          success: function(result) {
            $("tr." + idnya).fadeOut("slow");
          },
        });
      }
    </script>