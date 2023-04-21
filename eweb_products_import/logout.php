<?php
session_start();

session_unset();

session_destroy();
include 'config.php';
?>
<script>
    window.location.href='<?php echo Client_site_url; ?>/eweb_products_import/login.php';
</script>