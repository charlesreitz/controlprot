
<?php
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
echo "<link href=\"default.css\" rel=\"stylesheet\" type=\"text/css\" />";
function formulario(){
    echo "<form name=\"consulta\" action=\"index2.php?pagina=Consulta\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr>
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"codProtocolo\" CHECKED/>Numero Protocolo</td>
        <!--<td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"nomeCliente\">Nome</td>-->
        
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"cpfCnpjCliente\">CPF/CNPJ</td>
        <td height=\"30\" class=\"descCampoConsulta\"><input type=\"radio\" name=\"dado\" value=\"todos\">Todos</td>

</tr>
    </thead>
    <tbody>
    <tr>

        <td class=\"consulta\" colspan=\"4\" >
            Consulta:
            <input type=\"text\" name=\"campo\" value=\"\" size=\"53\" id=\"campo\">
            <input type=\"submit\" value=\"Consultar\" name=\"consultar\" />
        </td>
    </tr>
    </tbody>
    </table></form>";

}



function consultar($dado,$campo){

    //se for usuario normal entra nesse if caso contrario executa sql como ADM
    if ($_SESSION['nivelIndex']=='U'){
   
    if ($dado=='todos'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where B.codEmpresa=".$_SESSION['codEmpresaIndex']."
                group by A.codProtocolo;";
            
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
    if ($dado=='nome'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.nomeCliente like '%$campo%' and B.codEmpresa='".$_SESSION['codEmpresaIndex']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        if ($dado=='codProtocolo'){
        $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado ='$campo' and B.codEmpresa='".$_SESSION['codEmpresaIndex']."'
                group by A.codProtocolo;";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        if (!($dado=='todos' || $dado=='nome' || $dado=='codProtocolo')){
            $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado = '$campo' and B.codEmpresa='".$_SESSION['codEmpresaIndex']."'";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
            //FIMif usuario nomal
        }
        //INICIO else ADMINISTRADOR
        else{
            /*
             * select  A.cpfCnpjCliente,
        B.codProtocolo,
        B.dataEnvio,
        B.dataRecepcionado,
        B.quantidadeContratos,
        B.quantidadeContratosRecebidos,
        C.nome,
        D.nome
        from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo

                join
                empresa C
                on C.codEmpresa = B.codEmpresa

                join
                usuarios D
                on D.codUsuario = B.codUsuario
                --group by A.codProtocolo*/

            if ($dado=='todos'){
             $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                group by A.codProtocolo;";
                $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
            if ($dado=='nome'){
            $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.nomeCliente like '%$campo%'";
                $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
            if ($dado=='codProtocolo'){
                $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado ='$campo'
                group by A.codProtocolo;";
                $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
            if (!($dado=='todos' || $dado=='nome' || $dado=='codProtocolo')){
                $sql = "select * from itemProtocolo A
                join
                protocolo B
                on A.codProtocolo = B.codProtocolo
                where A.$dado = '$campo'";
                $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
        }
        //FIM else administrador

//Inicio para apresentar na tabela
echo "<div><table width=\"100%\" border=\"0\" cellspacing=\"0\" bordercolor=\"black\" align=\"center\" class=\"tabItemProtocolo\">

<tr >
<th >N</th>";
if($dado=='nomeCliente' || $dado=='cpfCnpjCliente'){
    echo "<th >Nome:</td>";
    echo "<th >CPF/CNPJ</td>";
}
echo "<th >Enviado</th>
<th>Recepcionado</th>
<th ><center>Status</center></th>
<th >Qtd Enviado</th>
<th >Qtd Recebido</th>
<th >Usuário R</th>
<th>Opções</th>
</tr>";

//inicio do while para mostrar resultado da consulta
 
    while ($linha = mysql_fetch_array($resultado)){
        echo "<tr>
        <td class=\"resultCampo\"><b>".$linha['codProtocolo']."</b></td>";
        if($dado=='nomeCliente' || $dado=='cpfCnpjCliente'){
            echo "<td class=\"resultCampo\">".$linha['nomeCliente']."</td>";
            echo "<td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>";

            }

        //verifica se existe algum conteudo, caso não houver apresenta caracter no lugar de nada
        if(!$linha['dataEnvio']==""){
            echo "<td class=\"resultCampo\">".dtPadrao($linha['dataEnvio'])."</td>";
                }else{
                    echo"<td class=\"resultCampo\"> - </td>";
                    }

        //verifica se existe algum conteudo, caso não houver apresenta caracter no lugar de nada
        if(!$linha['dataRecepcionado']==""){
            echo "<td class=\"resultCampo\">".dtPadrao($linha['dataRecepcionado'])."</td>";
                }else{
                    echo"<td class=\"resultCampo\"> - </td>";
                    }
        //faz verificações para apresentar botões (verde, amarelo e vermelho)
     


        if ($linha['status']=='R'){
            echo "<td class=\"resultCampo\"><center><img src=\"images/b_verde.png\" alt=\"Recepcionado\"></img></center></td>";
            }
        if ($linha['status']=='E'){
            echo "<td class=\"resultCampo\"><center><img src=\"images/b_amarelo.png\" alt=\"Enviado\"></img></center></td>";
            }
        if ($linha['status']=='S'){
            echo "<td class=\"resultCampo\"><center><img src=\"images/b_vermelho.png\"alt=\"Salvo\"></img></center></td>";
            }
        //<td class=\"resultCampo\">".$linha['status']."</td>
        
        
        
        echo "<td class=\"resultCampo\">".$linha['quantidadeContratos']."</td>";

        //verifica se existe algum conteudo, caso não houver apresenta caracter no lugar de nada
        if(!$linha['quantidadeContratosRecebidos']==""){
            echo "<td class=\"resultCampo\">".$linha['quantidadeContratosRecebidos']."</td>";
                }else{
                    echo"<td class=\"resultCampo\"> - </td>";
                    }

        //verifica se existe algum conteudo, caso não houver apresenta caracter no lugar de nada
        if(!$linha['usuarioRecepcionado']==""){
            echo "<td class=\"resultCampo\">".$linha['usuarioRecepcionado']."</td>";
                }else{
                    echo"<td class=\"resultCampo\"> - </td>";
                    }
        
 echo "<td><table border =\"0\" align=\"right\"><tr>";
        //INICIO - verificações para mostar alterar, excluir, receber
        if ($linha['status']=='S'){
            echo "<td width=\"24\"><a href=\"index2.php?pagina=Consulta&tipo=alterar&cod=".$linha['codProtocolo']."\"><img src=\"images/b_editar.png\" alt=\"Alterar\"></img></a></td>";
            echo "<td width=\"24\"><a href=\"index2.php?pagina=Consulta&tipo=excluir&cod=".$linha['codProtocolo']."\"><img src=\"images/b_deletar.png\" alt=\"Excluir\"></img></a></td>";
            echo "<td width=\"24\">&nbsp</td>";
            if ($_SESSION['']=='A'){
                    echo "<td width=\"24\">&nbsp</td>";
                    }

            }
        if($linha['status']=='E'){

            echo "<td width=\"24\">&nbsp</td>";
            echo "<td width=\"24\">&nbsp</td>";
                if ($_SESSION['nivelIndex']=='A'){
                    echo "<td width=\"24\"><a href=\"index2.php?pagina=Consulta&tipo=receber&cod=".$linha['codProtocolo']."\"><img src=\"images/b_receber.png\" alt=\"Recepcionar\"></img></a></td>";
                    }
           echo "<td><a href=\"index2.php?pagina=Consulta&tipo=imprimir&cod=".$linha['codProtocolo']."\"><img src=\"images/b_imprimir.png\" alt=\"Imprimir\"></img></a></td>";
          }
          if($linha['status']=='R'){
                if ($_SESSION['']=='A'){
                    echo "<td width=\"24\">&nbsp</td>";
                    }
            echo "<td width=\"24\">&nbsp</td>";
            echo "<td width=\"24\">&nbsp</td>";
                echo "<td><a href=\"index2.php?pagina=Consulta&tipo=imprimir&cod=".$linha['codProtocolo']."\"><img src=\"images/b_imprimir.png\" alt=\"Imprimir\"></img></a></td>";
            }
        //FIM - verificações para mostar alterar, excluir, receber
        echo "</tr>
        </table></td>";
          echo "</tr>";
        }

        //Fim mostrar tabela e informações

$total = mysql_num_rows($resultado);



echo"<tr>
<th colspan=\"13\">Total de Registros:$total</th>
</tr>
</table>
<br>
<table border=0 width=\"100%\">
<td colspan=2><b>Legenda</b></td>
<tr>

<td>
<h5><img src=\"images/b_vermelho.png\" alt=\"Salvo\"></img> Salvo <br>
<img src=\"images/b_amarelo.png\" alt=\"Enviado\"></img> Enviado <br>
<img src=\"images/b_verde.png\" alt=\"Recepcionado\"></img> Recepcionado</h5>
</td>
<td>
<h5><img src=\"images/b_editar.png\" alt=\"Alterar\"></img> Alterar <br>
<img src=\"images/b_deletar.png\" alt=\"Excluir\"></img> Excluir <br>
<img src=\"images/b_receber.png\" alt=\"Recepcionar\"></img> Recepcionar<br>
<img src=\"images/b_imprimir.png\" alt=\"Imprimir\"></img> Imprimir</h5>

</td>
</tr></table>


</div>";
        
}


function deletarProtocolo($codProtocolo){
    $sql = "DELETE FROM itemProtocolo WHERE codProtocolo='$codProtocolo';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    $sql = "DELETE FROM protocolo WHERE codProtocolo='$codProtocolo';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    echo "<div class=\"msgR\">Protocolo Deletado</div>";
}


$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codProtocolo = $_GET['cod'];


if (array_key_exists("consultar",$_POST)){
    formulario();
    consultar($dado,$campo);
    }
    if ($tipo=="excluir"){
        formulario();
        deletarProtocolo($codProtocolo);
        }
        if ($tipo=="alterar"){
            $_SESSION['codProtocolo'] = $codProtocolo;
            echo "<script>window.location=\"index2.php?pagina=Alterar\"</script>";//redireciona para pagina index
            }
            if ($tipo=="receber"){
                $_SESSION['codProtocolo'] = $codProtocolo;
                echo "<script>window.location=\"index2.php?pagina=Receber\"</script>";//redireciona para pagina index
                }
                if ($tipo=="imprimir"){
                    $_SESSION['codProtocoloImpressao']= $codProtocolo;
                    //echo "<script>window.location=\"index2.php?pagina=Receber\"</script>";//redireciona para pagina index
                    $_SESSION['codProtocolo'];//envia para a var sessao imprimir cod
                    echo "<center><a href=\"protocoloEnviado.php\" target=\"blank\">Imprimir Protocolo</a></center>";
                    }
                    if(!($tipo=='excluir' || array_key_exists("consultar",$_POST) || $tipo=="alterar"|| $tipo=="receber" || $tipo=="imprimir")){
                        formulario();
                        }

?>

