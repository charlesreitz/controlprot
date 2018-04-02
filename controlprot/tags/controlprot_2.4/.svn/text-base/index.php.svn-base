<?php session_start();?>
<html>
  <head>
    <title>Login - Controlprot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel=stylesheet href=default.css type=text/css>



  </head>
  <body>
<?php
require('conectar.php');
function anti_injection($sql){
  $sql = preg_replace(sql_regcase("/(from|select|insert|name|like|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
  $sql = trim($sql);
  $sql = strip_tags($sql);
  $sql = addslashes($sql);
return $sql;
}

function formulario(){
echo "<div class=\"fundoLogin\"><center><div class=index>";
echo "<form method=\"POST\" action=index.php>

<table border=\"0\">
<thead>
<tr>
<td class=\"descCampo\">Usuario:</td>
<td> <input name=login size=20></td>
</tr>
</thead>
<tbody>
<tr>
<td class=\"descCampo\">Senha:</td>
<td><input name=senha type=\"password\" size=20></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>

<input type=submit name=enviado value=Login>
</form></div></center></div>";
}

function novaSenha(){
echo "<div class=\"fundoTransparente\"><center><div class=trocaSenha>";
echo "<h3>Nova Senha</h3><form method=\"POST\" action=index.php>

<table border=\"0\">
<thead>
<tr>
<td class=\"descCampo\">Nova Senha:</td>
<td><input name=senha1 type=\"password\" size=20></td>
</tr>
</thead>
<tbody>
<tr>
<td class=\"descCampo\">Confirma Nova Senha:</td>
<td><input name=senha2 type=\"password\" size=20></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>

<input type=submit name=enviadoSenha value=Salvar>
</form></div></center></div>";

}

function gravaNovaSenha(){

$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];

if (($senha1==$senha2) && !($senha1=="" || $senha2=="")){

$senha = md5($senha1.dificilsenha2009);
$sql = "UPDATE usuarios SET senha='$senha',dataUltimoLogin=now() where login='".$_SESSION['loginIndex']."'";
$resultado = mysql_query($sql);



echo "<script language=\"JavaScript\">
     document.location=\"index2.php\";
    </script>";

}
if ((!($senha1==$senha2)) || ($senha1=="" || $senha2=="")){
     echo "<script language=\"JavaScript\">
        alert(\"Senhas NÃO são iguais ou estão em BRANCO\");
        </script>";
        novaSenha();
        }
}

function verifica(){
$login = anti_injection($_POST["login"]);
$senha = md5(anti_injection($_POST["senha"]).dificilsenha2009);
if ((!$login) || (!$senha)){
echo "<center><div class=\"msgR\">Senha ou Login em branco<br>";
echo "</div></center>";
}else{
$sql = "select nome,codUsuario,dataUltimoLogin,nivel,codEmpresa,status,login,senha from usuarios where login='$login' and senha='$senha'";
$resultado = mysql_query($sql);
$linha = mysql_fetch_array($resultado);
$total = @mysql_num_rows($resultado);
if (!$total){
  echo "<script language=\"JavaScript\">
    alert(\"Usuário ou senha inválida.\");
    document.location=\"index.php\";
</script>";
    }else{

        $_SESSION['nivelIndex'] = $linha['nivel'];
        $_SESSION['statusIndex'] = $linha['status'];
        $_SESSION['codEmpresaIndex'] = $linha['codEmpresa'];
        $_SESSION['loginIndex'] = $linha['login'];
        $_SESSION['dataUltimoLogin'] = $linha['dataUltimoLogin'];
        $_SESSION['codUsuarioIndex'] = $linha['codUsuario'];
        $_SESSION['nomeIndex'] = $linha['nome'];
        if ($_SESSION['statusIndex']=='A'){
            if ($linha['dataUltimoLogin']==""){
                novaSenha();
                }else{
        echo $_SESSION['codEmpresaIndex'];
                    $sql = "UPDATE usuarios SET dataUltimoLogin=now() where login='".$_SESSION['loginIndex']."'";
                    $resultado = mysql_query($sql);
                    echo "<script language=\"JavaScript\">
                    document.location=\"index2.php\";
                   </script>";
                    }
            }else{
                
                echo "<script language=\"JavaScript\">
                alert(\"Este usuário está desativado, contate o administrador.\");
                document.location=\"index.php\";
                </script>";
                }
        }
}
}

if (array_key_exists("enviado",$_POST)){
    verifica();
    }
    if (array_key_exists("enviadoSenha",$_POST)) {
        gravaNovaSenha();
        }
        if(!array_key_exists("enviadoSenha",$_POST) || !array_key_exists("enviado",$_POST)){
            
            
            formulario();
            }

?>
  </body>
</html>

