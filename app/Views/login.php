<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | CP</title>

    <link rel="icon" href="<?= $this->ASSETS_URL ?>icon/logoCB.png">
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/adminLTE-3.1.0/css/adminlte.min.css">
    <style>
        body {
            font-family: 'Titillium Web',
                sans-serif;
        }
    </style>
</head>

<body class="login-page small" style="min-height: 496.781px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Collection’s <b>Performance</b></a><br>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">New Session Login</p>
                <form action="<?= $this->BASE_URL ?>Login/cek_login" method="post">
                    <div id="info"></div>
                    <div class="input-group mb-3">
                        <input type="text" name="HP" class="form-control" placeholder="KUFI-ID / 08xx (Phone Number)" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span<i class="fas fa-mobile-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="PASS" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="tipe" class="form-control" required>
                            <option value=""></option>
                            <option value="staff">Staff</option>
                            <option value="tl">Team Leader</option>
                            <option value="om">Operation Manager</option>
                            <option value="management">Management</option>
                            <option value="cs">Customer Service</option>
                            <option value="qc">Quality Control</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-shield"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <div id="spinner" class="spinner-border text-primary col-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


<div class="modal" id="exampleModal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content qr p-2">
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $("#info").hide();
        $("#spinner").hide();
    });

    $("form").on("submit", function(e) {
        $("#spinner").show();
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(response) {
                if (response == '1') {
                    $("#spinner").hide();
                    location.reload(true);
                    return;
                } else if (response == '2') {
                    var id = $("input[name=HP]").val();
                    var tipe = $("select[name=tipe]").val();
                    $('#exampleModal').modal('show');
                    $('div.qr').load('<?= $this->BASE_URL ?>Login/qr/' + id + '/' + tipe);
                    $("#spinner").hide();
                    return;
                } else {
                    $("#info").hide();
                    $("#spinner").hide();
                    $("#info").html('<div class="alert alert-danger" role="alert">' + response + '</div>')
                    $("#info").fadeIn();
                    return;
                }
            },
        });
    });

    $('.modal').on('hidden.bs.modal', function(e) {
        location.reload(true);
    })
</script>