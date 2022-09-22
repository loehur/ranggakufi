<html>

<body onload="requestFullScreen()">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h6>Collection's Performance</h6>
            </div>
            <div class="card-body">
              Home PAGE
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>

<script type="text/javascript">
  function PrintContent() {
    var DocumentContainer = document.getElementById('print');
    var WindowObject = window.open('', "PrintWindow", "toolbars=no");
    WindowObject.document.write('<body style="margin:0">');
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
  }
</script>