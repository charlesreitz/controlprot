<?php
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
echo "<body onload=\"document.cabecalhoFormulario.cpfCnpjCliente.focus()\">";
function formulario(){

$sql = "select * from itemProtocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.codProtocolo ='".$_SESSION['codProtocolo']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $resultado_cabecalho = mysql_query($sql) or die ("erro sql".mysql_error());
        $linha_cabecalho = mysql_fetch_assoc($resultado_cabecalho);

        $total = mysql_num_rows($resultado);

    echo " <h3>Protocolo nº: ".$linha_cabecalho['codProtocolo']."</h3>";

    echo "<p align=\"center\">...................................................................................................................................</p>

<div>
<form method=\"POST\" name=\"formulario\" action=\"index2.php?pagina=Receber\">
<table border=\"0\" width=\"650\" align=\"center\" class=\"tabItemProtocolo\">
<thead>
<tr>
    <th width=\"100\">Nome</th>
    <th width=\"100\">Cpf/Cnpj</th>
    <th width=\"10\">Tipo</th>
    <th >Obs</th>
    <th width=\"5\">Recepcionado?</th>
</tr>
</thead>
";
        
        $_SESSION['total'] = $total;
        while ($linha = mysql_fetch_array($resultado)){
        echo "
        <tbody>
        <tr>
            <td class=\"resultCampo\">".$linha['nomeCliente']."</td>
            <td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>
            <td class=\"resultCampo\" align=\"center\">".$linha['tipo']."</td>
            <td class=\"resultCampo\">".$linha['obs']."</td>
            <td><center><input type=\"checkbox\" name=\"receber[]\" value=\"".$linha['cpfCnpjCliente']."\"></center></td>
        </tr>";
    }

echo "
    <tr>
        <th colspan=5>Total Contratos: ".$total."</th>
    </tr>

</tbody>
</table>
</div>
<table border=\"0\" align=\"center\">
<thead>
    <tr>
        <td align=\"right\"><input type=\"submit\" value=\"Confirmar\" name=\"confirmar\" >
    </tr>
</thead>
<tbody>
</tbody>
</table>
</form>";

     
}


function gravar(){


    foreach($_POST['receber'] as $key => $receber) {

             $sql = "UPDATE itemProtocolo SET recebido='S' where cpfCnpjCliente=$receber and codProtocolo=".$_SESSION['codProtocolo']."";
             $resultadosql = mysql_query($sql) or die ("erro sql receber".mysql_error());
             $cont ++;
             }


            $sql = "UPDATE protocolo SET quantidadeContratosRecebidos='$cont', status='R', dataRecepcionado=now(),usuarioRecepcionado='".$_SESSION['codUsuarioIndex']."'
            WHERE codProtocolo = '".$_SESSION['codProtocolo']."' ;";
            $resultadosql = mysql_query($sql) or die ("erro sql salvarFormulario".mysql_error());
            echo "<div class=\"msgG\">Protocolo Recepcionado<br>
            <b>Protocolo: ".$_SESSION['codProtocolo']."</b>
            <br><br>
            </div>";
           $_SESSION['codProtocolo']="";//zera sessa codprotocolo para não abrir o mesmo protocolo depois de enviado

}



$_SESSION['item'] = $_GET['item'];
$_SESSION['cod'] = $_GET['cod'];

if(array_key_exists("confirmar", $_POST)){
    gravar();
    }
    if ( !array_key_exists("confirmar", $_POST)){
        formulario();
        }

?>