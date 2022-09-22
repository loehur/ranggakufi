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
          <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
              +
            </button>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>HP/Email</th>
                  <th>Privilege</th>
                  <th>Last Login</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['data'] as $a) {
                  $id = $a['id_user'];
                  $f2 = $a['admin'];
                  $f3 = $a['privilege'];

                  $privilege = "";
                  foreach ($this->dPrivilege as $b) {
                    if ($b['id_privilege'] == $f3) {
                      $privilege = $b['privilege'];
                    }
                  }

                  echo "<tr>";
                  echo "<td><span data-mode=1 data-id_value='" . $id . "' data-value='" . $a['nama_user'] . "'>" . $a['nama_user'] . "</span></td>";
                  echo "<td><span data-mode=2 data-id_value='" . $id . "' data-value='" . $a['no_user'] . "'>" . $a['no_user'] . "</span></td>";
                  if ($f2 == 1) {
                    $privilege = "Super Admin";
                    echo "<td class='text-secondary unselectable'><b>" . $privilege  . "</b></td>";
                  } else {
                    echo "<td><span data-mode=3 data-id_value='" . $id . "' data-value='" . $privilege . "'>" . $privilege  . "</span></td>";
                  }
                  echo "<td>" . $a['last_login'] . "</td>";
                  echo "<td></td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>User/insert" method="POST">
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Nama User</label>
                  <input type="text" name="f1" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="exampleInputEmail1">Nomor HP</label>
                  <input type="text" name="f2" class="form-control" id="exampleInputEmail1" placeholder="" required>
                </div>
                <div class="col">
                  <label for="exampleInputEmail1">Privilege</label>
                  <select name="f3" class="form-control" required>
                    <option value="" disabled selected>---</option>
                    <?php foreach ($this->dPrivilege as $a) { ?>
                      <option value="<?= $a['id_privilege'] ?>"><?= $a['privilege'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Akses Layanan</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= $this->BASE_URL; ?>Data_List/updateCell/user" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Akses Layanan</label>
              <select class="selectMulti form-control form-control-sm" style="width: 100%" name="value[]" multiple="multiple" required>
                <?php foreach ($this->dLayanan as $a) { ?>
                  <option value="<?= $a['id_layanan'] ?>"><?= $a['layanan'] ?></option>
                <?php } ?>
              </select>
              <input type="hidden" id="idItem" name="id" value="" required>
              <input type="hidden" name="mode" value="11" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
      </div>
      </form>
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
        data: $(this).serialize(),
        type: $(this).attr("method"),
        success: function() {
          location.reload(true);
        },
      });
    });

    var click = 0;
    $("span").on('dblclick', function() {
      click = click + 1;
      if (click != 1) {
        return;
      }
      var id_value = $(this).attr('data-id_value');
      var value = $(this).attr('data-value');
      var mode = $(this).attr('data-mode');
      var value_before = value;
      var span = $(this);
      var valHtml = $(this).html();

      switch (mode) {
        case '1':
        case '2':
          span.html("<input type='text' id='value_' value='" + value + "'>");
          break;
        case '3':
          span.html('<select id="value_"><option value="' + value + '" selected>' + valHtml + '</option><?php foreach ($this->dPrivilege as $a) { ?><option value="<?= $a['id_privilege'] ?>"><?= $a['privilege'] ?></option><?php } ?></select>');
          break;
        default:
      }

      $("#value_").focus();
      $("#value_").focusout(function() {
        var value_after = $(this).val();
        if (value_after === value_before) {
          span.html(value);
          click = 0;
        } else {
          $.ajax({
            url: '<?= $this->BASE_URL ?>User/updateCell',
            data: {
              'id': id_value,
              'value': value_after,
              'mode': mode
            },
            type: 'POST',
            dataType: 'html',
            success: function(response) {
              location.reload(true);
            },
          });
        }
      });
    });
  });
</script>