<?php
session_start();

if(!isset($_SESSION["loginIndex"])){

echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";

exit;
}


echo "<h4>Olá, ".$_SESSION['nomeIndex']."</h4>";

echo "<br><br><center>";

include ("enquete/enquete.php");

?>


