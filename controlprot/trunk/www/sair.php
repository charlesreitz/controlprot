<?php
session_start();
require "conectar.php";
require 'util.php';
deletarProtocolosAbertos();
session_destroy();


echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";


?>
