<?php
session_start();

if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>

<body onload="document.cadastro.empresa.focus()">

<link href="adm.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

function verificar(){

if (document.cadastro.empresa.value==""){
    document.cadastro.empresa.focus()
    alert("Digite um Nome")
    return false
}
if (document.cadastro.cnpj.value==""){
    document.cadastro.cnpj.focus()
    alert("Digite um CNPJ")
    return false
}
if (document.cadastro.dddTelefone.value==""){
    document.cadastro.dddTelefone.focus()
    alert("Digite DDD")
    return false
}
if (document.cadastro.telefone.value==""){
    document.cadastro.telefone.focus()
    alert("Digite um Telefone")
    return false
}
if (document.cadastro.cep.value==""){
    document.cadastro.cep.focus()
    alert("Digite um CEP")
    return false
}
if (document.cadastro.logradouro.value==""){
    document.cadastro.logradouro.focus()
    alert("Digite um Logradouro")
    return false
}
if (document.cadastro.bairro.value==""){
    document.cadastro.bairro.focus()
    alert("Digite um Bairro")
    return false
}
if (document.cadastro.n.value==""){
    document.cadastro.n.focus()
    alert("Digite o numero do endereço")
    return false
}
if (document.cadastro.cidade.value==""){
    document.cadastro.cidade.focus()
    alert("Digite uma cidade")
    return false
}




}


</script>

<?
require "conectar.php";

//formulario ao qual exibe labels e campos para digitar informaï¿½ï¿½es
function formulario(){



echo "<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroEmpresa.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" >Empresa:</td>
  <td><input type=\"text\" maxlength=\"45\" size=\"50\" name=\"empresa\"></td>
</tr>
<tr>
  <td class=\"descCampo\" >CNPJ:</td>
  <td><input type=\"text\" value=\"\" maxlength=\"14\" size=\"50\" name=\"cnpj\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>DDD: </label></td>
  <td><input type=\"text\" value=\"\" maxlength=\"3\" size=\"3\" name=\"dddTelefone\">
      <label>Telefone:</label> <input type=\"text\" maxlength=\"8\" size=\"32\" name=\"telefone\">
    </td>
</tr>
<tr>
  <td class=\"descCampo\" > <label>Status: </label></td>
  <td><select name=\"status\" id=\"status\" style=\"width: 326px;\">
<option>Ativado</option>
<option>Desativado</option>
</select></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label >CEP: </label></td>
  <td><input type=\"text\" maxlength=\"8\" name=\"cep\" size=\"50\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>Logradouro: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"logradouro\" size=\"50\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>Bairro: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"bairro\" size=\"50\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>Nº: </label></td>
  <td><input type=\"text\" maxlength=\"8\" name=\"n\" size=\"12\" id=\"n\">
  <label for=\"complemento\">Complemento: </label>
  <input type=\"text\" maxlength=\"8\" name=\"complemento\" size=\"18\">
    </td>
</tr>
<tr>
<tr>
  <td class=\"descCampo\" ><label>Cidade: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"cidade\" size=\"50\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label>Estado:</label></td>
  <td>
      <select size=\"1\" name=\"estado\" style=\"width: 327px;\"  >
      <option>Selecione</option>
      <option>Acre</option>
      <option>Alagoas</option>
      <option>Amapá¡</option>
      <option>Amazonas</option>
      <option>Bahia</option>
      <option>Ceará¡</option>
      <option>Distrito Federal</option>
      <option>Goiás</option>
      <option>Espírito Santo</option>
      <option>Maranhãoo</option>
      <option>Mato Grosso</option>
      <option>Mato Grosso do Sul</option>
      <option>Minas Gerais</option>
      <option>Pará¡</option>
      <option>Paraiba</option>
      <option>Paraná¡</option>
      <option>Pernambuco</option>
      <option>Piaui­</option>
      <option>Rio de Janeiro</option>
      <option>Rio Grande do Norte</option>
      <option>Rio Grande do Sul</option>
      <option>RondÃ´nia</option>
      <option>Roraima</option>
      <option>São Paulo</option>
      <option>Santa Catarina</option>
      <option>Sergipe</option>
      <option>Tocantins</option>
      </select>
  </td>
</tr>
<tr>
    <td colspan=2 align=\"center\"><input type=\"submit\" value=\"salvar\" name=\"salvar\" >
</tr>
</table>
</form>";}
//fim formulario

//insere campos por sql no banco de dados
function gravar(){
$empresa = ucwords(strtolower($_POST['empresa']));
$cidade = $_POST['logradouro'];
$status = $_POST['status'];
$estado = $_POST['estado'];
$numero = $_POST['n'];
$bairro = ucwords(strtolower($_POST['bairro']));
$cnpj = $_POST['cnpj'];
$complemento = ucfirst(strtolower($_POST['complemento']));
$telefone = $_POST['telefone'];
$dddTelefone = $_POST['dddTelefone'];
$cep = $_POST['cep'];
$logradouro = ucfirst(strtolower($_POST['logradouro']));


$sql = "INSERT INTO empresa (nome,cidade,estado,status,numero,bairro,cnpj,complemento,telefone,dddTelefone,cep,logradouro)
VALUES ('$empresa','$cidade','$estado','$status','$numero','$bairro','$cnpj','$complemento','$telefone','$dddTelefone','$cep','$logradouro')";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());
echo "<center><div class=msgG>Registro gravado com sucesso</div></center>";

};
//fim gravar

if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
   gravar();
   formulario();
     
     }



?>

