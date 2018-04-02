<? session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>
<link href="adm.css" rel="stylesheet" type="text/css" />
<?php
require 'conectar.php';

$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codEmpresa = $_GET['cod'];

function consultar($dado,$campo){

    if ($dado=='nome'){
        $sql = "SELECT * FROM empresa where nome like '%$campo%'" ;
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        else{
            $sql = "SELECT * FROM empresa where $dado = $campo";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }

    while ($linha = mysql_fetch_array($resultado)){
        echo "<center><div class=\"tabConsulta\"><table border=\"0\" align=\"center\" width=\"600\">
            <thead>
            <tr >
                <td class=\"descCampo\" width=\"80\" align=\"left\"><label >Codigo:</td>
                <td width=\"400\"align=\"left\"><label> ".$linha['codEmpresa']."</label></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class=\"descCampo\">Nome:</label></td>
                <td>".$linha['nome']."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\">CNPJ:</td>
                <td>".$linha['cnpj']."</label></td>
            </tr>
            <tr>
                <td class=\"descCampo\">DDD/Telefone:</label></td>
                <td>(".$linha['dddTelefone'].") ".$linha['telefone']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Status:</label></td>
                <td>";
                if ($linha['status']=='A'){
                   echo "Ativado";
                    }else{
                        echo "Desativado";
                     }
            echo "</td>
            </tr>
            <tr>
                <td class=\"descCampo\">CEP:</td>
                <td>".$linha['cep']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Logradouro:</label></td>
                <td>".$linha['logradouro']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Bairro:</label></td>
                <td>".$linha['bairro']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Numero:</label></td>
                <td>".$linha['numero']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Complemento</label></td>
                <td>".$linha['complemento']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Cidade: </td>
                <td>".$linha['cidade']."</td>
            </tr>
            <tr>
                <td class=\"descCampo\">Estado:</td>
                <td>".$linha['estado']."</td>
            </tr>
            <tr>
                <td><a href=\"consultaEmpresa.php?tipo=alterar&cod=".$linha['codEmpresa']."\">Alterar</td>
                <td><a href=\"consultaEmpresa.php?tipo=excluir&cod=".$linha['codEmpresa']."\">Excluir</td>
            </tr>
                </tbody>
            </table>
</div><br>";
     }
$total = mysql_num_rows($resultado);
echo "<br><label>Total de Registros:$total</label>";

}


function formulario(){
    echo "<form name=\"consulta\" action=\"consultaEmpresa.php\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr >
        <th height=\"30\"><label for=\"codigo\"><input type=\"radio\" name=\"dado\" value=\"codEmpresa\" id=\"codigo\" CHECKED/>Codigo</label></th>
        <th height=\"30\"><label for=\"nome\"><input type=\"radio\" name=\"dado\" value=\"nome\" id=\"nome\"/>Nome</nome></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td height=\"30\"><label for=\"campo\">Consulta:</label></td>
        <td><input type=\"text\" name=\"campo\" value=\"\" size=\"50\" id=\"campo\"></td>
        <td colspan=\"2\" align=\"right\" height=\"30\"><input type=\"submit\" value=\"Consultar\" name=\"consultar\" /></td>
    </tr>
    </tbody>
    </table></form>";

}

function excluir($codEmpresa){

    $sql_usuarios = "select codEmpresa from usuarios where codEmpresa=$codEmpresa";
    $resultado_usuarios = mysql_query($sql_usuarios) or die (mysql_error());
    
    if (mysql_num_rows($resultado_usuarios)>0){
        echo "<center><div class=\"msgY\">Empresa possui usuários associados, não pode ser deletada</div></center>";
    }else{
        $sql = "DELETE FROM empresa WHERE codEmpresa=$codEmpresa";
        $resultado = mysql_query($sql) or die (mysql_error());
        echo "<center><div class=\"msgR\">Empresa deletada com sucesso</div></center>";
        }

}


        formulario();

if (array_key_exists("consultar",$_POST)){
        consultar($dado,$campo);
    }
    if ($tipo =='excluir'){
        excluir($codEmpresa);
        }
        if ($tipo =='alterar'){
            $_SESSION['codEmpresa']=$codEmpresa;
            echo "<script>window.open('alterarEmpresa.php','centro');</script>";
            }

?>
