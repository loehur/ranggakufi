<?php $title = $data['pageInfo']['title']; ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start align-items-end">
              <div class="mr-auto" style="width:200px">
                <h7><?= $title ?></h7>
              </div>
              <div class="p-1">
                <label>Loan ID</label>
                <input type="text" minlength="10" id="loanID" style="width: 200px;" class="form-control form-control-sm" />
              </div>
              <div class="p-1">
                <button class="btn btn-sm btn-primary" onclick="cek(document.getElementById('loanID').value)">Cek</button>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-auto" id="view">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/date-picker/bootstrap-datepicker.min.js"></script>

<script>
  function cek(idnya) {
    $.ajax({
      url: "<?= $this->BASE_URL ?>CS_Problem/check_data",
      data: {
        id: idnya
      },
      type: "POST",
      beforeSend: function() {
        $("div#view").html('<span id="rows"><div class="spinner-border spinner-border-sm m-3" role="status"><span class="sr-only">Loading...</span></div></span>');
      },
      success: function(response) {
        $("div#view").html(response);
      },
    });
  }
</script>