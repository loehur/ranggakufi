<?php
require_once "library/GoogleAuthenticator.php";
$authenticator = new PHPGangsta_GoogleAuthenticator();
$secret = $authenticator->createSecret();
$website = "rangga.mdl.my.id";
$title = $data['id'];
$QRCode = $authenticator->getQRCodeGoogleUrl($title, $secret, $website);
echo "<img src='" . $QRCode . "'></img><br>";
?>

<form action="<?= $this->BASE_URL ?>Login/verify/<?= $secret ?>/<?= $data['id'] ?>/<?= $data['tipe'] ?>" method="POST">
  Scan and Enter the Code!
  <input type="text" name="code" class="form-control form-control-sm" required>
  <button type="submit" name="btn-submit" class="btn btn-primary btn-sm mt-2">SUBMIT</button>
</form>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $("form").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: $(this).attr("method"),
        success: function(response) {
          if (response == '1') {
            alert("Google Authenticator Actived!");
            location.reload(true);
          } else {
            alert(response);
          }
        },
      });
    });
  });
</script>