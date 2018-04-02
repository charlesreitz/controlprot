<?php
session_start();

if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>
<link href="adm.css" rel="stylesheet" type="text/css" />
<?php
require 'conectar.php';
require 'util.php';

$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codUsuario = $_GET['cod'];
function consultar($dado,$campo){

    if ($dado=='nome'){
        $sql = "SELECT * FROM usuarios where nome like '%$campo%'" ;
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        else{
            $sql = "SELECT * FROM usuarios where $dado = $campo";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }

    while ($linha = mysql_fetch_array($resultado)){
        echo "<center><div class=\"tabConsulta\"><table border=\"0\" align=\"center\" width=\"600\">
            <thead>
            <tr >
                <td class=\"descCampo\" width=\"80\" align=\"left\"><label >Codigo:</label></td>
                <td width=\"400\"align=\"left\"><label> ".$linha['codUsuario']."</label></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class=\"descCampo\"><label>Nome:</label></td>
                <td><label>".$linha['nome']."</label></td>
            </tr>
            <tr>
               <td class=\"descCampo\"><label>E-mail: </label></td>
                <td><label>".$linha['email']."</label></td>
            </tr>
            <tr>
               <td class=\"descCampo\"><label>CPF: </label></td>
                <td><label>".$linha['cpf']."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Produto:</label></td>
                <td><label>".$linha['produto']."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Login:</label></td>
                <td><label>".$linha['login']."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Senha:</label></td>
                <td><label>Solicitar Nova Senha</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Data CriaÁ„oo:</label></td>
                <td><label>".mysql_datetime_para_humano($linha['dataCriacao'])."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Nivel:</label></td>
                <td><label>";
                            //verifica flag no banco e apresenta com nome completo
                            if($linha['nivel']=='A'){echo "Administrador";}
                            if($linha['nivel']=='R'){echo "Receptor";}
                            if($linha['nivel']=='U'){echo "Usu√°rio";}
                echo "</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\"><label>Cod Empresa: </label></td>
                <td><label>".$linha['codEmpresa']."</label></td>
            </tr>
            <tr>
                <td><label><a href=\"consultaUsuario.php?tipo=alterar&cod=".$linha['codUsuario']."\">Alterar</label></td>
                <td><label><a href=\"consultaUsuario.php?tipo=excluir&cod=".$linha['codUsuario']."\">Excluir</label></td>
            </tr>
            </tbody>
            </table></div><br>";
     }
     $total = mysql_num_rows($resultado);
    echo "<label>Total de Registros:$total</label>";
}


function formulario(){
    echo "<form name=\"consulta\" action=\"consultaUsuario.php\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr>
        <th colspan=\"3\"height=\"30\"><label for=\"codigo\"><input type=\"radio\" name=\"dado\" value=\"codUsuario\" id=\"codigo\" CHECKED/>Codigo
        <input type=\"radio\" name=\"dado\" value=\"nome\" id=\"nome\"/>Nome
        <input type=\"radio\" name=\"dado\" value=\"codEmpresa\" id=\"codEmpresa\"/>Empresa </th>
</tr>
    </thead>
    <tbody>
    <tr>
        <td height=\"30\"><label for=\"campo\">Consulta:</label></td>
        <td ><input type=\"text\" name=\"campo\" value=\"\" size=\"50\" id=\"campo\"></td>
        <td height=\"30\"><input type=\"submit\" value=\"Consultar\" name=\"consultar\" /></td>
    </tr>
    </tbody>
    </table></form>";

}

function excluir($codUsuario){

    $sql = "DELETE FROM usuarios WHERE codUsuario=$codUsuario";
    $resultado = mysql_query($sql) or die ("sql com erro");

    echo "Movimenta√ß√£o Deletada com Sucesso";


}


        formulario();

if (array_key_exists("consultar",$_POST)){

        consultar($dado,$campo);
    }
    if ($tipo =='excluir'){
        excluir($codUsuario);
        }
        if ($tipo=='alterar'){
           $_SESSION['codUsuario']=$codUsuario;
           echo "<script>window.open('alterarUsuario.php','centro');</script>";
          }

?>
