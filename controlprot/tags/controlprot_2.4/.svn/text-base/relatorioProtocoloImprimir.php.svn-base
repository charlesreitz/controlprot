<? session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>
<body >
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <script language=\"JavaScript\" src=\"util.js\"></script>
<link href="impressao.css" rel="stylesheet" type="text/css" />
  </head>
  <body onload="window.print()">
<?php

require 'conectar.php';
require 'util.php';

if ($_SESSION['nivelIndex']=='U'){
        $sql = "select codProtocolo,dataCriacao,status,quantidadeContratos,dataEnvio,codUsuario,codEmpresa from protocolo
        where dataEnvio BETWEEN '".$_SESSION['dtInicial']."' and '".$_SESSION['dtFinal']."'
        and codEmpresa=".$_SESSION['codEmpresaIndex'].";";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $resultado_w = mysql_query($sql) or die ("erro sql".mysql_error());
        }else{
            $sql = "select quantidadeContratosRecebidos,codProtocolo,dataCriacao,status,quantidadeContratos,dataEnvio,codUsuario,codEmpresa from protocolo
        where dataEnvio BETWEEN '".$_SESSION['dtInicial']."' and '".$_SESSION['dtFinal']."';";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $resultado_w = mysql_query($sql) or die ("erro sql".mysql_error());
        }




echo "<center><h3>Protocolo enviado por data</h3>";


echo "<table border=\"1\" width=\"710\" cellspacing=\"0\" bordercolor=\"black\">
    <tr>
        <th >Protocolo</th>
        <th >Criado em:</th>
        <th >Enviado em:</th>
        <th >Qte Contratos</th>
        <th >Recebidos</th>
        <th >Usuário</th>
    </tr>
    ";
while ($linha = mysql_fetch_assoc($resultado_w)){
    echo"
        <tr>
        <td class=\"resultadoImpressao\">".$linha['codProtocolo']."</td>
        <td class=\"resultadoImpressao\">".mysql_datetime_para_humano($linha['dataCriacao'])."</td>
        <td class=\"resultadoImpressao\">".mysql_datetime_para_humano($linha['dataEnvio'])."</td>
        <td class=\"resultadoImpressao\">".$linha['quantidadeContratos']."</td>
        <td class=\"resultadoImpressao\">".$linha['quantidadeContratosRecebidos']."</td>
        <td class=\"resultadoImpressao\">".$linha['codUsuario']."</td>
        </tr>";
    }
    $total = mysql_num_rows($resultado);
    echo"
    <tr>
        <th colspan=\"8\">Total de Registros:$total</th>
    </tr>
    </table></center>";

?>
  </body>
</html>
