<style>
  .unselectable {
    background-color: #ddd;
    cursor: not-allowed;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    display: block;
  }
</style>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-info">
            <b>Hourly</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importHourly" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" class="form-control-file" name="file" required>
                <small>date | ticket_category | ranking | assign_to | employee_id | role | allocated_amount | repay_principal | repay_interest | total_repay_amount | rate_of_return | target_repay_rate | diff_target_repay_amount | new_assign_num | handle_times | handle_num | complete_num | load_num | singleMultiple_periods | first_loanReloan | total_call | tl | om</small>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-info">Import HOURLY</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-primary">
            <b>Daily</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importDaily" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" class="form-control-file" name="file" required>
                <small>date | ticket_category | ranking | assign_to | employee_id | role | allocated_amount | repay_principal | repay_interest | total_repay_amount | rate_of_return | target_repay_rate | diff_target_repay_amount | new_assign_num | handle_times | handle_num | complete_num | load_num | singleMultiple_periods | first_loanReloan | total_call | tl | om</small>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">Import DAILY</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-warning">
            <b>STAFF</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importStaff" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleFormControlFile1">Format : ID | Name | TL | OM | Division</label>
                <input type="file" class="form-control-file" name="file" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-warning">Import STAFF</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-warning">
            <b>Team Leader</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importTL" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleFormControlFile1">Format : ID | Name | OM | Division</label>
                <input type="file" class="form-control-file" name="file" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-warning">Import TL</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-warning">
            <b>Operation Manager</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importOM" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleFormControlFile1">Format : ID | Name | Division, Division</label>
                <input type="file" class="form-control-file" name="file" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-warning">Import OM</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-success">
            <b>CS</b> (.csv File Import)
          </div>
          <div class="card-body p-2">
            <form action="<?= $this->BASE_URL; ?>Upload/importCS" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleFormControlFile1">Format : ID | Name</label>
                <input type="file" class="form-control-file" name="file" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Import CS</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card">
          <div class="card-header bg-light">
            <span id="spinnerUpload" role="status" aria-hidden="true"></span>
            <a class="nav-link" href="#">
              <span id="spinnerUpload" role="status" aria-hidden="true"></span>
              <b>Upload Status</b>
            </a>
          </div>
          <div class="card-body p-2">
            <div id="info">-</div>
          </div>
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

<script>
  $(document).ready(function() {
    $("form").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: $(this).attr("method"),
        enctype: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $("button").attr("disabled", true);
          $('span#spinnerUpload').addClass('spinner-border spinner-border-sm');
          $("#spinnerUpload").html("");
          $("#spinnerUpload").hide();
        },
        success: function(response) {
          $('span#spinnerUpload').removeClass('spinner-border spinner-border-sm');
          $("#info").html('<div class="alert alert-secondary" role="alert">' + response + '</div>')
          $("#info").fadeIn();
        },
      });
    });
  });
</script>