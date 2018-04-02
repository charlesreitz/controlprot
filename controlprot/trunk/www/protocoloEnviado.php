<? session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>
<link href="impressao.css" rel="stylesheet" type="text/css" />
<body onload="window.print()">
<?php
require 'conectar.php';
require 'util.php';


        $sql = "select A.codProtocolo, B.codUsuario, B.codEmpresa, B.status, B.quantidadeContratos,
                B.dataEnvio, A.nomeCliente, A.cpfCnpjCliente,A.tipo,A.obs
                from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.codProtocolo ='".$_SESSION['codProtocoloImpressao']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $resultado_w = mysql_query($sql) or die ("erro sql".mysql_error());
        $linha = mysql_fetch_array($resultado);



        $sql_usuario = "select nome,codUsuario,produto from usuarios where codUsuario=".$linha['codUsuario']."";
        $resultado_usuario = mysql_query($sql_usuario) or die ("erro sql".mysql_error());
        $linha_usuario = mysql_fetch_array($resultado_usuario);

        $sql_empresa = "select nome,codEmpresa from empresa where codEmpresa=".$linha['codEmpresa']."";
        $resultado_empresa = mysql_query($sql_empresa) or die ("erro sql".mysql_error());
        $linha_empresa = mysql_fetch_array($resultado_empresa);
     

echo "<center><h3>Protocolo de Contratos Enviados</h3></center>";

echo "<div class=\"tab\"><table align=\"center\" border=\"0\" width=\"710px\" cellspacing=\"0\" bordercolor=\"black\">
    <thead>
    <tr>
        <th width=\"100\">Protocolo Nº</th>
        <td width=\"300\">".$linha['codProtocolo']."</td>
        <th width=\"100\">Usuário: </th>
        <td width=\"300\">".$linha_usuario['nome']."</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th width=\"100\">Enviado em:</th>
        <td width=\"300\">".mysql_datetime_para_humano($linha['dataEnvio'])."</td>
        <th width=\"100\">Empresa:</th>
        <td width=\"300\">".$linha_empresa['nome']."</td>
    </tr>
    <tr>
        <th width=\"120\">Qtd Contratos: </th>
        <td width=\"300\">".$linha['quantidadeContratos']."</td>
        <th width=\"100\">Produto:</th>
        <td width=\"300\">".$linha_usuario['produto']."</td>
    </tr>
    </tbody>
    </table></div>";

echo "<br><br>";
echo "<table align=\"center\" border=\"1\" width=\"710px\" cellspacing=\"0\" bordercolor=\"black\">
    <tr>
        <th width=\"250\">Nome</th>
        <th width=\"100\">CPF/CNPJ</th>
        <th width=\"30\">Tipo</th>
        <th width=\"600\">Obsevação</th>
    </tr>
    ";
while ($linha_w = mysql_fetch_assoc($resultado_w)){
    echo"
        <tr>
        <td >".$linha_w['nomeCliente']."</td>
        <td>".$linha_w['cpfCnpjCliente']."</td>
        <td >".$linha_w['tipo']."</td>
        <td >".$linha_w['obs']."</td>
        </tr>";
    }
    $total = mysql_num_rows($resultado);
    echo"
    <tr>
        <th colspan=\"8\">Total de Registros:$total</th>
    </tr>
    </table>";

?>

</body>