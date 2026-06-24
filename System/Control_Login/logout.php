<?php
session_start();
session_unset();
session_destroy();

header("../index.php");

exit;
?>
<script>

    window.alert("Sesión finalizada");
</script>