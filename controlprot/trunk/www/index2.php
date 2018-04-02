<?session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Popular
Version    : 1.0
Released   : 20080519
Description: A two-column, fixed-width and lightweight template ideal for 1024x768 resolutions. Suitable for blogs and small websites.

    _____________________________________________________________
    |        SISTEMA PROTOCOLOS PARA DOCUMENTOS FISï¿½COS       |
    |ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï½|
    | Elaborado por: Charles Reitz                              |
    | E-mail/MSN: charles.reitz@gmail.com                       |
    | -> Disciplina de Analise e Desenvolvimento de Sistemas    |
    | -> Prof. MEng. Sigmundo Preissler Jr.                     |
    | -> UNERJ - Jaraguï¿½ do Sul - SC - www.unerj.br           |
    |___________________________________________________________|
    |                       Etapas                              |
    |ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½|
    |1 - Documento                                      [100%]  |
    |2 - Modelo Banco Dados                             [100%]  |
    |3 - Desenvolvimento                                [100%]  |
    |4 - Testes/Implementaï¿½ï¿½o/Documentaï¿½ï¿½o      [100%]  |
    |5 - Banca                                          [100%]  |
    |___________________________________________________________|

-->



<html>
<head>
<title>Controlprot - Sistema de Controle de Protocolos</title>
<link href="default.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="util.js"></script>
</head>
<body >
<!-- inicio menu -->
<div id="logo">

</div>

<div id="header">
	<div id="menu">
		<ul>
            <li><a href="index2.php">Home</a><li>
            <li><a href="index2.php?pagina=Novo">Novo Protocolo</a></li>
			<li><a href="index2.php?pagina=Consulta">Consultar Protocolo</a></li>
			<li><a href="index2.php?pagina=Relatorio">Relatório de Protocolos</a></li>
          	<?
            if ($_SESSION['nivelIndex']=='A'){
                echo "<li><a href=\"#\" onClick=\"trocar(1)\">Administrador</a></li>";
                }
            ?>
                
            <li class="last"><a href="sair.php">Sair</a></li>
		</ul>
	</div>
</div>
<!-- fim menu -->

<!-- inicio pagina -->
<div id="page">
  <p>
    <?php
    require "conectar.php";
    require 'util.php';
    

//inicia verificações para abrir arquivos
    $pagina=$_GET['pagina'];
    
    if ($pagina=="Novo"){
        require ("cadastroProtocolo.php");
        }
        if($pagina=="Consulta"){
            deletarProtocolosAbertos();
            require("consultaProtocolo.php");
            }
            if($pagina=="Alterar"){

            require("alterarProtocolo.php");
                }
                if($pagina=="Receber"){
                    require("receberProtocolo.php");
                    }
                    if($pagina=="Relatorio"){
                        deletarProtocolosAbertos();
                        require("relatorioProtocolo.php");
                        }

                            if (!($pagina=="Novo" || $pagina=="Consulta"
                                || $pagina=="Relatorio" || $pagina=="Administrador"
                                || $pagina=="Alterar" || $pagina=="Receber")){
                                deletarProtocolosAbertos();
                                require ("home.php");
                                
                            }








?>
</p>
</div>
<!-- fim pagina -->

<!--inicio rodape-->
<div id="footer">
	<p id="legal"><b>Controlprot - 2009</b><img src=" images/bandeira.jpg"></img></p>
</div>

<div id="central">
<?php include 'admin.php'; ?>
</div>

<!-- fim rodape -->
</body>
</html>
