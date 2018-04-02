
<?php
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}

echo "<link href=\"default.css\" rel=\"stylesheet\" type=\"text/css\" />";
require 'conectar.php';


function formulario(){
    echo "<form name=\"consulta\" action=\"index2.php?pagina=Relatorio\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    </thead>
    <tbody>
    <tr\">
        <td class=\"consulta\">Data Inicial:
        <input type=\"text\" name=\"dtInicial\" value=\"\" size=\"20\" onKeyUp=\"DigitaData(this)\">
         Data Final
        <input type=\"text\" name=\"dtFinal\" value=\"\" size=\"20\" onKeyUp=\"DigitaData(this)\">
        <input type=\"submit\" value=\"Imprimir\" name=\"imprimir\" /></td>
    </tr>
    </tbody>
    </table></form>";

}

formulario();


if (array_key_exists("imprimir",$_POST)){
$_SESSION['dtInicial'] = dtBanco($_POST['dtInicial']);
$_SESSION['dtFinal'] = dtBanco($_POST['dtFinal']);
echo "<script>window.open('relatorioProtocoloImprimir.php','_blank');</script>";

    }

?>
