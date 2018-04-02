<?php
session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>
<body onload="document.cadastro.nome.focus()">

<link href="adm.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">

function verificar(){
if (document.cadastro.nome.value==""){
    document.cadastro.nome.focus()
    alert("Digite um Nome")
    return false
}
if (document.cadastro.email.value==""){
    document.cadastro.email.focus()
    alert("Digite um Email")
    return false
}
if (document.cadastro.cpf.value==""){
    document.cadastro.cpf.focus()
    alert("Digite um CPF")
    return false
    }

}
</script>




<?
require "conectar.php";

//inicio formulario
function formulario(){
$sql = "select codUsuario,nome,email,produto,nivel,status,cpf,codEmpresa from usuarios where codUsuario = ".$_SESSION['codUsuario']."";
$resultado = mysql_query($sql) or die ("erro sql primeiro".mysql_error());
$linha = mysql_fetch_assoc($resultado);

echo "<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"alterarUsuario.php\">
<table border=\"0\" align=\"center\" >
<tr>
  <td class=\"descCampo\"><label for=\"nome\">Nome e Sobrenome:</label></td>
  <td><input type=\"text\" size=\"50\" name=\"nome\" id=\"nome\" value=\"".$linha['nome']."\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>Email: </label></td>
  <td><input type=\"text\" size=\"50\" name=\"email\" value=\"".$linha['email']."\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cpf\">CPF: </cpf></td>
  <td><input type=\"text\" maxlength=\"11\" size=\"50\" name=\"cpf\" id=\"cpf\" value=\"".$linha['cpf']."\"></td>
</tr>
<tr>
  <td class=\"descCampo\"><label for=\"produto\" >Produto:</label></td>
  <td>
    <input type=\"checkbox\" name=\"produto1\" value=\"Consignado Publico\"><label>Consignado Publico<BR></label>
    <input type=\"checkbox\" name=\"produto2\" value=\"Consignado Privado\"><label>Consignado Privado<BR></label>
    <input type=\"checkbox\" name=\"produto3\" value=\"CDC Veiculos\"><label>CDC Veículos</label>
  </td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"nivel\">Nivel: </label></td>
  <td><select size=\"1\" name=\"nivel\" id=\"nivel\" style=\"width: 320px;\">";
   if ($linha['nivel']=='U'){
       echo "<option>Usuário</option>
      <option>Receptor</option>
      <option>Administrador</option>";
        }
   if ($linha['nivel']=='R'){
        echo "<option>Receptor</option>
             <option>Usuário</option>
             <option>Administrador</option>";
        }
   if ($linha['nivel']=='A'){
        echo "<option>Administrador</option>
             <option>Receptor</option>
             <option>Usuário</option>";
        }

   echo "</select>
</tr>
<tr>
  <td class=\"descCampo\"><label for=\"status\" >Status: </label></td>
  <td><select size=\"1\" name=\"status\" id=\"status\" style=\"width: 320px;\" onChange=\"aa()\">";
   if ($linha['status']=='A'){
        echo "<option value=\"A\">Ativado</option>
            <option value=\"D\">Desativado</option>";
            }
  if ($linha['status']=='D'){
        echo "<option value=\"D\">Desativado</option>
            <option value=\"A\">Ativado</option>";
            }
   echo "</select>
</tr>
<tr>
  <td  class=\"descCampo\"><label for=\"empresa\">Empresa: </label></td>
  <td><select name=\"empresa\" style=\"width: 320px;\">";

    //codigo para listar os nomes das empresas cadastradas na tabela empresa
    $sql = "select codEmpresa,nome from empresa ";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());

        //traz o nome da empresa comparando com o que já está gravando no banco
        $sql_emp = "select codEmpresa,nome from empresa where codEmpresa=".$linha['codEmpresa'];
        $resultado_emp = mysql_query($sql_emp) or die ("erro sql".mysql_error());
        $linha2 = mysql_fetch_array($resultado_emp);
        echo '<option value="'.$linha['codEmpresa'].'">'.$linha2['nome'].'</option>'."\n";
        //fim

while( $dados = mysql_fetch_assoc($resultado) ){
            echo '<option value="'.$dados['codEmpresa'].'">'.$dados['nome'].'</option>'."\n";
            }
//fim codigo para listar

echo "</select>
</td>
</tr>
<tr>
<td colspan=2 align=\"center\">
<input type=\"submit\" value=\"salvar\" name=\"salvar\" ></td>
</tr>
</table>
</form>
";
}
//fim formulario

//inicio gravar - insere campos por sql no banco de dados
function gravar(){

    //$numeroAleatorio = rand();
    //$senha = md5($numeroAleatorio.dificilsenha2009);

$nome = ucwords(strtolower($_POST['nome']));
$email = strtolower($_POST['email']);
$dataCriacao = $_POST['datacriacao'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$codEmpresa = $_POST['empresa'];
$produto1 = $_POST['produto1'];
$produto2 = $_POST['produto2'];
$produto3 = $_POST['produto3'];

//buscar se existir caracteres não autorizados, se existir ele retira.
$cpf = str_replace(".","",$_POST['cpf']);
$cpf = str_replace("-","",$cpf);
$cpf = str_replace("/","",$cpf);
$cpf = str_replace("_","",$cpf);

$login = substr($cpf,0,6);

//inicio if - faz a verificaÃ§ao de qual varial recebeu conteudo da checkbox
if ($produto1 == ""){
$todas = $produto2." / ".$produto3;
}
if ($produto2 == ""){
    $todas = $produto1." / ".$produto3;
}
if ($produto3 == ""){
    $todas = $produto1." / ".$produto2;
}
if ($produto1 =="" && $produto2 == ""){
    $todas = $produto3;
}

if ($produto1 =="" && $produto3 == ""){
    $todas = $produto2;
}

if ($produto2 =="" && $produto3 == ""){
    $todas = $produto1;
}
if ($produto2 <>"" && $produto3 <> "" && $produto1 <>""){
    $todas = $produto1." / ".$produto2." / ".$produto3;
}
//fim if


$sql = "UPDATE usuarios SET nome='$nome',email='$email',produto='$todas',nivel='$nivel',
status='$status',codEmpresa='$codEmpresa',cpf='$cpf',login='$login' where codUsuario='".$_SESSION['codUsuario']."'";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());

echo "<center><div class=msgG>Usuário alterado com sucesso<br>
Login: $login
</div></center>";

};
//fim gravar

//inicio gerasenha

if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
     gravar();
    formulario();

     }


?>

