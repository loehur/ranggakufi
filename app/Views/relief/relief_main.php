<style>
  .blink {
    animation: blink-animation 1s steps(5, start) infinite;
    -webkit-animation: blink-animation 1s steps(5, start) infinite;
  }

  @keyframes blink-animation {
    to {
      visibility: hidden;
    }
  }

  @-webkit-keyframes blink-animation {
    to {
      visibility: hidden;
    }
  }
</style>

<?php $title = $data['pageInfo']['title']; ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start">
              <div class="p-1 mr-auto">
                <?php if (strlen($data['period']) > 0) { ?>
                  <form action="<?= $this->BASE_URL; ?>Relief/index/<?= $data['mode'] ?>" method="POST">
                    <div class="row">
                      <div class="col">
                        <select name="st_week" class="tize form-control form-control-sm p-0 m-0" style="width: 200px;">
                          <?php foreach ($data['optWeek'] as $ow) { ?>
                            <option value="<?= $ow ?>" <?= ($ow == $data['period']) ? "selected" : "" ?>><?= $ow ?> to WeekEnd</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col">
                        <button type="submit" class="btn btn-sm btn-primary">
                          Check
                        </button>
                      </div>
                      <?php if ($_SESSION['userTipe'] == "admin") { ?>
                        <div class="col">
                          <select name="tl" class="tizeTL form-control form-control-sm p-0 m-0" style="width: 300px;">
                            <option value="ALL">ALL TEAM LEADER</option>
                            <?php foreach ($this->dTL as $a) { ?>
                              <option value="<?= $a['employee_id'] ?>"><?= $a['employee_name'] ?> [<?= $a['employee_id'] ?>]</option>
                            <?php } ?>
                          </select>
                        </div>
                      <?php  } ?>
                    </div>
                  </form>
                <?php } ?>
              </div>
              <div class="p-1">
                <?php if ($_SESSION['userTipe'] == "staff" || $_SESSION['userTipe'] == "tl") { ?>
                  <button type="button" class="btn btn-sm btn-success float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Relief
                  </button><?php } ?>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-auto">
                <table class="table table-sm" style="padding: 0;">
                  <tbody>
                    <?php
                    $row = 0;
                    $arrPerDVC = array();
                    foreach ($data['data'] as $a) {

                      $id =  $a['id_relief'];
                      $emp_id =  $a['emp_id'];
                      $om_name = $a['om'];
                      $tl = $a['tl'];
                      $tl_name = $a['tl'];
                      $loan_id = $a['loan_id'];

                      $bucket = $a['bucket'];

                      $emp_name = "";
                      foreach ($this->dStaff as $ds) {
                        if ($ds['employee_id'] == $emp_id) {
                          $emp_name = $ds['employee_name'];
                        }
                      }

                      foreach ($this->dOM as $do) {
                        if ($do['employee_id'] == $om_name) {
                          $om_name = $do['employee_name'];
                        }
                      }

                      foreach ($this->dTL as $dt) {
                        if ($dt['employee_id'] == $tl_name) {
                          $tl_name = $dt['employee_name'];
                        }
                      }

                      echo "<tr class='show " . $tl . " table-borderless " . $id . "' style='border-top: 1px dashed silver'>";
                      echo "<td colspan='10' class='pb-0'><h7><small>Loan ID </small> <span class='badge badge-info p-1' style='cursor:pointer' id='" . $id . "' data-loan='" . $loan_id . "' onclick='copyText(" . $id . ")'><b>#" . $loan_id . "</b></span></h7> <span class='text-info' id='c" . $id . "'></span>";

                      if ($a['om_check'] == 0 && $this->id_user == $emp_id) {
                        echo "<a href='" . $this->BASE_URL . "Relief/cancel/" . $a['id_relief'] . "/" . $emp_id . "'><span class='ml-2 btn badge badge-danger'>Cancel</span></a>";
                      }

                      $used100 = 0;
                      foreach ($data['kuota'] as $key => $k) {
                        if ($key == $a['tl']) {
                          $used100 = $k['x100'];
                        }
                      }

                      echo "<span class='ml-1' style='color:#DC7633'><b>" . $a['remark'] . "</b></span>";
                      echo "</tr>";
                      echo "<tr class='show " . $tl . " table-borderless " . $id . "'>";
                      echo "<td><small>Relief: #" . $id . "<br>" . $emp_id . "<br><b><span>" . $emp_name . "</span></small></td>";
                      echo "<td><b><small><b>Bucket:</b> " . $bucket . " <br><b>OM:</b> " . $om_name . " <b><br>TL:</b> " . $tl_name . "</small> <span class='text-success'><b>" . $used100 . "x</b></span></td>";
                      echo "<td><small>Date/Request Date</small><br>" . $a['date_'] . "<br>" . $a['request_date'] . "</td>";
                      echo "<td class='text-right'><small>Total 4 Elements</small><br>" . number_format($a['4_el']) . "</td>";
                      echo "<td class='text-right'><small>Amount</small><br>" . number_format($a['repay_amount']) . "</td>";
                      echo "<td class='text-right'><small>Waiver/Percen</small><br>" . number_format($a['waiver_amount']) . "<br>" . number_format($a['percentage']) . "%</td>";
                      echo "</td>";

                      $om_ap = $a['om_approved'];
                      $data_ap = $a['data_approved'];

                      if ($_SESSION['userTipe'] == "om") {
                        if (strpos($this->userDVC, $a['bucket']) !== FALSE) {
                          if ($a['om_check'] == 0) {
                            echo "<td><small>OM Check</small><br><a href='" . $this->BASE_URL . "Relief/update/" . $a['id_relief'] . "/1'><span class='mr-1 btn badge badge-success'>Approve</span></a><a href='" . $this->BASE_URL . "Relief/update/" . $a['id_relief'] . "/2'><span class='btn badge badge-danger'>Reject</span></a></td>";
                            echo "<td><small>Admin Check</small><br>OM Checking</td>";
                          } else {

                            foreach ($this->dOM as $do) {
                              if ($do['employee_id'] == $om_ap) {
                                $om_ap = $do['employee_name'];
                              }
                            }

                            $st_icon = "";
                            if ($a['om_check'] == 1) {
                              $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                            } else {
                              $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                            }
                            echo "<td><small>OM Check</small><br>" . $st_icon . " " . $om_ap . "</small></td>";
                          }
                        } else {
                          if ($a['om_check'] == 0) {
                            echo "<td><small>OM Check</small><br>Checking...</td>";
                            echo "<td><small>Admin Check</small><br>Checking...</td>";
                          } else {
                            foreach ($this->dOM as $do) {
                              if ($do['employee_id'] == $om_ap) {
                                $om_ap = $do['employee_name'];
                              }
                            }
                            $st_icon = "";
                            if ($a['om_check'] == 1) {
                              $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                            } else {
                              $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                            }
                            echo "<td><small>OM Check</small><br>" . $st_icon . " " . $om_ap . "</small></td>";
                          }
                        }

                        if ($a['data_check'] == 0) {

                          echo "<td>";
                          if ($a['on_check'] == '') {
                            echo "<small>Admin Check</small><br>Checking...";
                          } else {
                            foreach ($this->dUser as $du) {
                              if ($du['id_user'] == $a['on_check']) {
                                $on_check = $du['nama_user'];
                              }
                            }
                            echo "<small>Admin Check</small><br><span class='text-info blink'><i class='fas fa-eye'></i> " . strtoupper($on_check) . "</span>";
                          }
                          echo "</td>";
                        } else {
                          foreach ($this->dUser as $du) {
                            if ($du['id_user'] == $data_ap) {
                              $data_ap = $du['nama_user'];
                            }
                          }
                          $st_icon = "";
                          if ($a['data_check'] == 1) {
                            $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                          } else {
                            $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                          }
                          echo "<td><small>Admin Check</small><br>" . $st_icon . " " . strtoupper($data_ap) . "</small></td>";
                        }
                      } elseif ($_SESSION['userTipe'] == "admin") {
                        if ($a['om_check'] == 0) {
                          echo "<td><small>OM Check</small><br>Checking...</td>";
                          echo "<td><small>Admin Check</small><br>Checking...</td>";
                        } else {
                          foreach ($this->dOM as $do) {
                            if ($do['employee_id'] == $om_ap) {
                              $om_ap = $do['employee_name'];
                            }
                          }
                          $st_icon = "";
                          if ($a['om_check'] == 1) {
                            $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                          } else {
                            $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                          }
                          echo "<td><small>OM Check</small><br>" . $st_icon . " " . $om_ap . "</small></td>";

                          if ($a['om_check'] == 2) {
                            echo "<td><small>Admin Check</small><br><span class='text-danger'><b>OM Rejected</b></span></td>";
                          } else {
                            if ($a['data_check'] == 0) {
                              echo "<td><small>Admin Check</small><br><a href='" . $this->BASE_URL . "Relief/update_admin/" . $a['id_relief'] . "/1'><span class='mr-1 btn badge badge-success'>Approve</span></a><a href='" . $this->BASE_URL . "Relief/update_admin/" . $a['id_relief'] . "/2'><span class='btn badge badge-danger'>Reject</span></a><br>";
                              if ($a['on_check'] == '') {
                                echo "<a href='" . $this->BASE_URL . "Relief/on_check/" . $a['id_relief'] . "/" . $this->id_user . "'><span class='mr-1 btn badge badge-info'>Check</span></a>";
                              } else {
                                foreach ($this->dUser as $du) {
                                  if ($du['id_user'] == $a['on_check']) {
                                    $on_check = $du['nama_user'];
                                  }
                                }
                                echo "<span class='text-info blink'><i class='fas fa-eye'></i> " . strtoupper($on_check) . "</span>";
                              }
                              echo "</td>";
                            } else {
                              foreach ($this->dUser as $du) {
                                if ($du['id_user'] == $data_ap) {
                                  $data_ap = $du['nama_user'];
                                }
                              }
                              $st_icon = "";
                              if ($a['data_check'] == 1) {
                                $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                              } else {
                                $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                              }
                              echo "<td><small>Admin Check</small><br>" . $st_icon . " " . strtoupper($data_ap) . "</small></td>";
                            }
                          }
                        }
                      } else {
                        if ($a['om_check'] == 0) {
                          echo "<td><small>OM Check</small><br>Checking...</td>";
                          echo "<td><small>Admin Check</small><br>Checking...</td>";
                        } else {
                          foreach ($this->dOM as $do) {
                            if ($do['employee_id'] == $om_ap) {
                              $om_ap = $do['employee_name'];
                            }
                          }
                          $st_icon = "";
                          if ($a['om_check'] == 1) {
                            $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                          } else {
                            $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                          }
                          echo "<td><small>OM Check</small><br>" . $st_icon . " " . $om_ap . "</small></td>";

                          if ($a['data_check'] == 0) {
                            echo "<td>";
                            if ($a['on_check'] == '') {
                              echo "<small>Admin Check</small><br>Checking...";
                            } else {
                              foreach ($this->dUser as $du) {
                                if ($du['id_user'] == $a['on_check']) {
                                  $on_check = $du['nama_user'];
                                }
                              }
                              echo "<small>Admin Check</small><br><span class='text-info blink'><i class='fas fa-eye'></i> " . strtoupper($on_check) . "</span>";
                            }
                            echo "</td>";
                          } else {
                            foreach ($this->dUser as $du) {
                              if ($du['id_user'] == $data_ap) {
                                $data_ap = $du['nama_user'];
                              }
                            }
                            $st_icon = "";
                            if ($a['data_check'] == 1) {
                              $st_icon = '<i class="fas fa-check-circle text-success"></i>';
                            } else {
                              $st_icon = '<i class="fas fa-times-circle text-danger"></i>';
                            }
                            echo "<td><small>Admin Check</small><br>" . $st_icon . " " . strtoupper($data_ap) . "</small></td>";
                          }
                        }
                      }
                      echo "</tr>";
                      $row++;
                    }
                    $recap = json_encode($arrPerDVC);
                    ?>
                </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Relief</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form class="ajax" action="<?= $this->BASE_URL; ?>Relief/insert" method="POST" class="insert" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Loan ID</label>
                  <input type="text" name="loan_id" class="form-control" placeholder="Loan ID" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Repayment Amount</label>
                  <input type="number" name="rep_amount" class="form-control" placeholder="Repayment Amount" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Total 4 Elements</label>
                  <input type="number" name="4element" class="form-control" placeholder="Total 4 Elements" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">DPD</label>
                  <input type="number" name="dpd" class="form-control" placeholder="DPD" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="text" name="date_" id="dp1" class="form-control" placeholder="yyyy-dd-mm" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Bucket</label>
                  <select name="bucket" class="form-control form-control-sm" required>
                    <option selected value="<?= $this->userDVC ?>"><?= $this->userDVC ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">TL</label>
                  <?php
                  $userTL = $this->userTL;
                  foreach ($this->dTL as $dt) {
                    if ($this->userTL == $dt['employee_id']) {
                      $userTL = $dt['employee_name'];
                    }
                  } ?>
                  <select name="tl" class="form-control form-control-sm" required>
                    <option selected value="<?= $this->userTL ?>"><?= $userTL ?> [<?= $this->userTL ?>]</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">OM</label>
                  <?php
                  $userOM = $this->userOM;
                  foreach ($this->dOM as $do) {
                    if ($this->userOM == $do['employee_id']) {
                      $userOM = $do['employee_name'];
                    }
                  } ?>
                  <select name="om" class="form-control form-control-sm" required>
                    <option selected value="<?= $this->userOM ?>"><?= $userOM ?> [<?= $this->userOM ?>]</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Waiver Amount</label>
                  <input type="number" name="waiver" class="form-control" placeholder="Waiver Amount" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Remark</label>
                  <input type="text" name="remark" class="form-control" placeholder="Remark" required>
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
</div>

<div class="modal" id="exampleModal2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content showResponse">
    </div>
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

    $('select.tizeTL').selectize({
      onChange: function() {
        var id = this.getValue();
        if (id == 'ALL') {
          $("tr.show").removeClass("d-none");
        } else {
          $("tr.show").addClass("d-none");
          $("tr." + id).removeClass("d-none");
        }
      }
    });
  });

  $("#dp1").datepicker({
    format: 'yyyy-mm-dd',
  });

  $("form.ajax").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      type: $(this).attr("method"),
      success: function(res) {
        if (res == 1) {
          location.reload(true);
        } else {
          alert(res);
        }
      },
    });
  });

  function copyText(id) {
    var copyText = $("span#" + id).attr('data-loan');
    navigator.clipboard.writeText(copyText);
    $("span#c" + id).html("Copied!");
    setTimeout(function() {
      reset_copy(id)
    }, 5000);
  }

  function reset_copy(id) {
    $("span#c" + id).html("");
  }
</script>