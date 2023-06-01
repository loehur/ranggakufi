<td colspan="10" class="pt-0 pb-0 pr-0 border">
    <table class="table table-sm table-light mt-0 mb-0 mr-0">
        <?php
        foreach ($data['contact'] as $c) {
            $con = unserialize($c['contact']);
            $status_ = "";
            switch ($con['status']) {
                case 0:
                    $status_ = "Saved";
                    break;
                case 1:
                    $status_ = "Edited";
                    break;
                case 2:
                    $status_ = "Deleted";
                    break;
            }
        ?>
            <tr class="">
                <td class="bg-white"><i class='fas fa-level-up-alt' style='transform: rotateZ(90deg);'></i></td>
                <td><small>No.HP/Sosmed</small><br><?= $con['contact'] ?></td>
                <td><small>Remark</small><br><?= $con['remark'] ?></td>
                <td><small>Updated</small><br><?= $con['updated'] ?></td>
                <td><small>Status</small><br><?= $status_ ?> - <?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $con['qc']) ?></td>
                <?php if ($_SESSION['userTipe'] == "qc") { ?>
                    <td>
                        <small>Action</small><br>
                        <?php
                        if ($con['status'] <> 2) { ?>
                            <a class="editQC" href="#" data-bs-toggle="modal" data-bs-target="#modalEdit" data-mode="<?= $con['mode'] ?>" data-kufi="<?= $c['employee_id'] ?>" data-id="<?= $c['id_contact'] ?>" data-con="<?= $con['contact'] ?>" data-rm="<?= $con['remark'] ?>">Edit</a> | <a class="deleteNumber" href="#" data-kufi="<?= $c['employee_id'] ?>" data-id="<?= $c['id_contact'] ?>">Delete</a>
                        <?php }
                        ?>
                    </td>
                <?php } ?>
            </tr>
            <?php
            //if (is_array($c['log']) && is_array($con['log'])) {
            if (strlen($c['log']) > 0) { ?>
                <tr>
                    <td colspan="10" class="pt-0 pb-0 pl-4 pr-0 bg-white">
                        <table class="table table-sm table-info mr-0 mb-0">
                            <?php foreach (unserialize($c['log']) as $l) { ?>
                                <tr>
                                    <td class="bg-white pr-2"><i class='fas fa-level-up-alt text-info' style='transform: rotateZ(90deg);'></i></td>
                                    <td><small>Contact</small><br><?= $l['contact_before'] ?> <i class="fas fa-angle-right"></i> <?= $l['contact_after'] ?></td>
                                    <td><small>Action</small><br><?= ($l['action'] == 1) ? "Edit" : "Delete" ?></td>
                                    <td><small>QC Remark</small><br><?= $l['qc_remark'] ?></td>
                                    <td><small>QC</small><br><?= $this->model('Arr')->get($this->dEmpMerge, "employee_id", "employee_name", $l['qc']) ?></td>
                                    <td><small>Created</small><br><?= $l['created'] ?></td>
                                    <td><small>Updated</small><br><?= $l['updated'] ?></td>
                                    <td><small>Proof</small><br><a target="_blank" href="<?= $this->BASE_URL ?><?= $l['proof'] ?>"><i class="far fa-image"></i></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            <?php }
            ?>
        <?php } ?>
    </table>
</td>

<script>
    $(".deleteNumber").click(function() {
        if (confirm("Yakin Delete nomor ini?")) {
            var id = $(this).attr("data-id");
            var kufi = $(this).attr("data-kufi");
            $.ajax({
                url: "<?= $this->BASE_URL ?>PhoneNumbers/delete",
                data: {
                    id: id
                },
                type: "POST",
                success: function(res) {
                    if (res == 0) {
                        $("tr#expand_" + kufi).load('<?= $this->BASE_URL ?>PhoneNumbers/expand/' + kufi);
                    } else {
                        alert(res);
                    }
                },
            });
        } else {
            return false;
        }
    });

    $("a.editQC").click(function() {
        $("input[name=id_edit]").val($(this).attr("data-id"));
        $("input[name=kufi_id]").val($(this).attr("data-kufi"));
        var mode = $(this).attr("data-mode");

        if (mode == "hp") {
            $("input[name=mode]").val(mode);
            $("div.62_").removeClass("d-none");
        } else {
            $("div.62_").addClass("d-none");
        }

        var oldData = $(this).attr("data-con") + " (" + $(this).attr("data-rm") + ")";
        $("input[name=oldData]").val(oldData);
    });
</script>