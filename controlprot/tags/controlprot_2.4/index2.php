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
    |1 - Documento                                      [75%]   |
    |2 - Modelo Banco Dados                             [100%]  |
    |3 - Desenvolvimento                                [85% ]  |
    |4 - Testes/Implementaï¿½ï¿½o/Documentaï¿½ï¿½o      [0%  ]  |
    |5 - Banca                                          [0%  ]  |
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
    //verificar se existe protocolos com status 'A' e deleta
    function deletarProtocolosAbertos(){
    $sql5 = "select codProtocolo,status from protocolo where status = 'A'";
    $resultado5 = mysql_query($sql5) or die ("erro".mysql_error());

        /*faz um while, enquanto existir itens dentro do resultado ele 
        vai executar o sql de deleção, para não sobrecarregado o banco com
         protocolos com status somente A de aberto - Fato existir uma FK primeiramente
         * ele ira deletar os itens após isso e rá deletar todos os protocolos
         * com status A
         */
        while ($linha = mysql_fetch_array($resultado5)){
            $sql = "DELETE FROM itemProtocolo WHERE codProtocolo='".$linha['codProtocolo']."';";
            $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());
        }
    $sql = "DELETE FROM protocolo WHERE status = 'A'";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    /*desregistra sessão codProtocolo pois quando entrar na tela de cadastroProtocolo
     * ele irá verificar se existe uma sessão com o nome, caso estiver ele não grava
     * o cabecalho no banco, ocasionando um erro de FK ao tentar inserir um sql*/
    unset ($_SESSION['codProtocolo']);
    }
    //fim função deletarProtocolosAbertos

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
	<p id="legal"><b>Controlprot - 2009</b></p>
</div>

<div id="central">
<?php include 'admin.php'; ?>
</div>

<!-- fim rodape -->
</body>
</html>
