<div id="content_"></div>

<script>
    $(document).ready(function() {
        content();
    });

    function content() {
        $("div#content_").load('<?= $this->BASE_URL ?><?= $data['page'] ?>/content/<?= $data['parse'] ?>');
    }
</script>