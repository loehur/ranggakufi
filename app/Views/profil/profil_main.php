<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                Google Authenticator
              </div>
              <div class="col-auto">
                <?php if ($data['data']['ga'] == 1) {
                  echo "<b class='text-success'>ON</b>";
                  if ($_SESSION['userTipe'] == 'admin' || $_SESSION['userTipe'] == 'management') {
                    echo " - <span class='btn badge badge-light' onClick='remove()'><i class='text-danger far fa-trash-alt'></i> Unlink</span>";
                  }
                } else {
                  echo "<b class='text-danger'>OFF</b>";
                  if ($_SESSION['userTipe'] == 'admin' || $_SESSION['userTipe'] == 'management') {
                    echo " - <span class='btn badge badge-light scan' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fas fa-qrcode'></i> Scan</span>";
                  }
                }; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content qr p-2">
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>

<script>
  $("span.scan").on("click", function(e) {
    $('div.qr').load('<?= $this->BASE_URL ?>Login/qr/<?= $this->id_user ?>/<?= $_SESSION['userTipe'] ?>');
  });

  function remove() {
    $.ajax({
      url: "<?= $this->BASE_URL ?>Profil/removeGA",
      data: {
        id: "<?= $this->id_user ?>"
      },
      type: "POST",
      success: function() {
        location.reload(true);
      },
    });
  }

  $('.modal').on('hidden.bs.modal', function(e) {
    location.reload(true);
  })
</script>