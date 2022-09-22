      <?php
      $path = str_replace('_slash_', '/', $data['spath']);
      $path = str_replace('_strip_', '-', $path);
      $path = str_replace('_space_', ' ', $path);
      ?>

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View</h5>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td style="width: 250px;" <?php if ($_SESSION['userTipe'] <> "cs") {
                                        echo 'class="d-none"';
                                      } ?>>
              <form action="<?= $this->BASE_URL; ?>CS_Problem/update/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body border rounded">
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Transaction Date</label>
                        <input type="text" name="f1" id="dp21" class="form-control form-control-sm" placeholder="yyyy-dd-mm" value="<?= $data['data']['transaction_date'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Delay Date</label>
                        <input type="text" name="f2" id="dp22" class="form-control form-control-sm" value="<?= $data['data']['delay_date'] ?>" placeholder="yyyy-dd-mm" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Due Date</label>
                        <input type="text" name="f3" id="dp23" class="form-control form-control-sm" value="<?= $data['data']['due_date'] ?>" placeholder="yyyy-dd-mm" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Delay Date Resolve</label>
                        <input type="text" name="f4" id="dp24" class="form-control form-control-sm" value="<?= $data['data']['delay_date_resolved'] ?>" placeholder="yyyy-dd-mm" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Repay Amount</label>
                        <input type="number" name="f5" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="" value="<?= $data['data']['repay_amount_cs'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label for="exampleInputEmail1">Remark</label>
                        <input type="text" name="f6" class="form-control form-control-sm" id="exampleInputEmail1" value="<?= $data['data']['cs_remark'] ?>" placeholder="" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label>Resolve</label>
                        <select name="resolve" class="form-control form-control-sm" style="width: auto;" required>
                          <option value="">---</option>
                          <option value="1">SOLVE</option>
                          <option value="2">PROCESS</option>
                          <option value="3">REJECT</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </td>
            <td valign='top'>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-auto image">
                      <img src="<?= $this->BASE_URL . $path ?>" style="max-height: 600px; max-width 400px;" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <!-- ====================== FORM ========================= -->
      </div>

      <!-- SCRIPT -->
      <script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
      <script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
      <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>

      <script>
        $(document).ready(function() {
          $("form").on("submit", function(e) {
            e.preventDefault();
            $('span#spinner').addClass('spinner-border spinner-border-sm');
            $.ajax({
              url: $(this).attr('action'),
              data: $(this).serialize(),
              type: $(this).attr("method"),
              success: function() {
                location.reload(true);
              },
            });
          });
        });

        $("#dp21").datepicker({
          format: 'yyyy-mm-dd',
        });
        $("#dp22").datepicker({
          format: 'yyyy-mm-dd',
        });
        $("#dp23").datepicker({
          format: 'yyyy-mm-dd',
        });
        $("#dp24").datepicker({
          format: 'yyyy-mm-dd',
        });

        $('.modal').on('hidden.bs.modal', function() {
          $('div.image').html("");
        });
      </script>