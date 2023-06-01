<style>
    .prevent-select {
        -webkit-user-select: none;
        /* Safari */
        -ms-user-select: none;
        /* IE 10 and IE 11 */
        user-select: none;
        /* Standard syntax */
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <?php
                                switch ($_SESSION['userTipe']) {
                                    case "staff":
                                    case "tl":
                                    case "om":
                                ?>
                                        <span class="btn btn-sm border" data-bs-toggle="modal" data-bs-target="#exampleModal2">Tambah Contacts/Sosial Media</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <table class="table table-sm mt-2">
                                    <?php
                                    foreach ($data['kufi_id'] as $ki) {
                                        $kufi = $ki['employee_id'];
                                        if ($_SESSION['userTipe'] == "tl" || $_SESSION['userTipe'] == "om") {
                                            if ($kufi <> $this->id_user) {
                                                switch ($ki['employee_tipe']) {
                                                    case "staff":
                                                        $tl = $this->model('Arr')->get($this->dEmpMerge, "employee_id", "tl", $kufi);
                                                        if ($tl <> $this->id_user) {
                                                            continue 2;
                                                        }
                                                        break;
                                                    case "tl":
                                                        $om = $this->model('Arr')->get($this->dEmpMerge, "employee_id", "om", $kufi);
                                                        if ($om <> $this->id_user) {
                                                            continue 2;
                                                        }
                                                        break;
                                                }
                                            }
                                        }
                                    ?>
                                        <tr class="">
                                            <th><small>KUFI ID</small><br><?= $ki['employee_id'] ?></th>
                                            <th><small>Name</small><br><?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $ki['employee_id']) ?></th>
                                            <?php switch ($ki['employee_tipe']) {
                                                case "staff": ?>
                                                    <th><small>TL Name</small><br><?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $this->model('Arr')->get($this->dEmpMerge, "employee_id", "tl", $ki['employee_id'])) ?></th>
                                                    <th><small>OM Name</small><br><?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $this->model('Arr')->get($this->dEmpMerge, "employee_id", "om", $ki['employee_id'])) ?></th>
                                                <?php
                                                    break;
                                                case "tl": ?>
                                                    <th><small>TL Name</small><br><small>SELF</small></th>
                                                    <th><small>OM Name</small><br><?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $this->model('Arr')->get($this->dEmpMerge, "employee_id", "om", $ki['employee_id'])) ?></th>
                                                <?php
                                                    break;
                                                case "om": ?>
                                                    <th><small>TL Name</small><br><small>SELF</small></th>
                                                    <th><small>OM Name</small><br><small>SELF</small> </th>

                                            <?php }
                                            ?>
                                            <th class="prevent-select">
                                                <small>Action</small><br>
                                                <small>
                                                    <span id="BTN_expand_<?= $ki['employee_id'] ?>" data-ei="<?= $ki['employee_id'] ?>" class="border expand_ rounded border-success pr-1 pl-1" style="cursor: pointer;">Expand</span>
                                                </small>
                                            </th>
                                        </tr>
                                        <tr id="expand_<?= $ki['employee_id'] ?>"></tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hidden" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insert No. HP / Sosmed</h5>
            </div>
            <div class="modal-body">
                <!-- ====================== FORM ========================= -->
                <form action="<?= $this->BASE_URL; ?>PhoneNumbers/addContact" method="POST" class="staff" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Remark</label>
                                    <input type="text" name="remark" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label>No Handphone dan Sosial Media</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">62</div>
                                        </div>
                                        <input type="text" name="contact" class="form-control" id="inlineFormInputGroup" required>
                                    </div>
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
<div class="modal" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Contact</h5>
            </div>
            <div class="modal-body">
                <!-- ====================== FORM ========================= -->
                <form action="<?= $this->BASE_URL; ?>PhoneNumbers/edit" method="POST" class="qc" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Old Data</label>
                                    <input type="text" name="oldData" class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>New Number/Sosmed</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">62</div>
                                        </div>
                                        <input type="text" name="new" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Proof (<span class="text-danger">Max. 10mb</span>)</label>
                                    <input type="file" id="file" name="resi" /> [ <span id="persen"><b>0</b></span><b> %</b> ] Upload Progress
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">QC Remark</label>
                                    <input type="hidden" name="id_edit" value="">
                                    <input type="hidden" name="kufi_id" value="">
                                    <input type="text" name="qc_remark" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("form.staff").on("submit", function(e) {
        $('.modal').modal('hide');
        var kufi = "<?= $this->id_user ?>";
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    content();
                } else {
                    alert(res);
                }
            },
        });
    });

    $("form.qc").on("submit", function(e) {
        $('.modal').modal('hide');
        e.preventDefault();
        var formData = new FormData(this);
        var file = $('#file')[0].files[0];
        formData.append('file', file);

        var kufi = $("input[name=kufi_id]").val();

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

            success: function(res) {
                if (res == 0) {
                    $("tr#expand_" + kufi).load('<?= $this->BASE_URL ?>PhoneNumbers/expand/' + kufi);
                } else {
                    alert(res);
                }
            },
        });
    });

    $("span.expand_").click(function() {
        var ei = $(this).attr("data-ei");
        if ($("tr#expand_" + ei).html() == "") {
            $("tr#expand_" + ei).load('<?= $this->BASE_URL ?>PhoneNumbers/expand/' + ei);
        } else {
            $("tr#expand_" + ei).html("");
        }
    });
</script>