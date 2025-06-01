<?php
session_start();
session_unset();
session_destroy();
header("Location: ../vista/inicio.php?expirado=1");
exit();
?>
