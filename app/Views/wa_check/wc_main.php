<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex align-items-start align-items-end">
              <div class="p-1">
                <?php if ($_SESSION['userTipe'] == "admin") { ?>
                  <a href="<?= $this->BASE_URL ?>Upload/exportCSV/cs_problem1" class="btn btn-sm btn-warning d-none">
                    Export CSV
                  </a><?php } ?>
                <button type="button" class="btn btn-sm btn-dark" onclick="clearData()">
                  Clear
                </button>
                <button type="button" class="btn btn-sm btn-success ml-1" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                  Check Whatsapp
                </button>
                <button type="button" class="btn btn-sm btn-primary ml-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Insert
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card p-2" id="content">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Numbers</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>WA_Check/insert" method="POST" class="insert" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Numbers | <small>Pisahkan dengan [ENTER]</small></label>
                  <textarea type="text" name="numbers" maxlength="140" class="form-control" required></textarea>
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

<div class="modal" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Whatsapp Status</h5>
      </div>
      <div class="modal-body">
        <span class="btn btn-sm btn-success" onclick="beginCheck()">Cek Status</span>
        <div class="mt-2" id="wa_status"></div>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>

<script>
  var checkCount = 0;
  $(document).ready(function() {
    $("div#content").load('<?= $this->BASE_URL ?>WA_Check/content');

    setInterval(function() {
      load_cek();
    }, 5000);
  });

  function clearData() {
    $("div#content").load('<?= $this->BASE_URL ?>WA_Check/clear');
    $("div#content").load('<?= $this->BASE_URL ?>WA_Check/content');
  }

  $("form.insert").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      type: $(this).attr("method"),
      success: function(result) {
        location.reload(true);
      },
    });
  });

  var runCheck = false;
  var log = 0

  function beginCheck() {
    checkWA();
    if (runCheck == false) {
      setInterval(checkWA, 3000);
      runCheck = true;
    }
  }

  function checkWA() {
    $("div#wa_status").load('<?= $this->BASE_URL ?>WA_Check/wa_status');
    log = $("span#log").html();
    if (log == 1) {
      clearInterval(checkWA);
    }
  }
</script>