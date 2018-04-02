<?
session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}


echo "

<ul id=menuhor>
<li><a href=cadastroUsuario.php target=centro>Cadastro Usuários</a></li>
<li><a href=cadastroEmpresa.php target=centro>Cadastro Empresa</a></li>
<li><a href=consultaUsuario.php target=centro>Consulta Usuários</a></li>
<li><a href=consultaEmpresa.php target=centro>Consulta Empresa</a></li>
<li><a href=\"brancoIframe.php\" target=centro onClick=\"trocar()\">Fechar</a></li>


</ul>

<hr align=\"left\" size=2 width=720 color=\"#000000\">




<iframe src=\"\" name=\"centro\"scrolling=\"auto\" vspace=\"0\" hspace=\"0\" frameborder=\"0\" width=\"720\" height=\"500\" ></iframe>";





?>

