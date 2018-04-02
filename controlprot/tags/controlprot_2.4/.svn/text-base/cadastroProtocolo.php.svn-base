<?php
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}

echo "<body onload=\"document.cabecalhoFormulario.cpfCnpjCliente.focus()\">";
//inicio formulario
function formulario(){
echo "<h4>Protocolo Nº: ".$_SESSION['codProtocolo']."</h4>";
echo "
<form method=\"POST\" name=\"cabecalhoFormulario\" action=\"index2.php?pagina=Novo\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"cpfCnpjCliente\1\">Cpf/Cnpj:</label></td>
  <td><input type=\"text\" value=\"\" maxlength=\"14\" size=\"23\" name=\"cpfCnpjCliente\" id=\"cpfCnpjCliente\"></td>
  <td class=\"descCampo\" ><label for=\"nome\">Nome:</label></td>
  <td><input type=\"text\" maxlength=\"40\" size=\"43\" name=\"nome\" id=\"nome\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"obs\">Obs:</label></td>
  <td colspan=4><input type=\"text\" value=\"\" name=\"obs\" size=\"80\" maxlength=\"299\"></td>
</tr>
<tr>
    <td colspan=\"4\"><center><div class=\"green2\"><input type=\"submit\" value=\"Incluir\" name=\"incluir\" ></div></center></td>
</tr>
</table>
</form>";
echo "<div class=\"msg\"><b>Um protocolo pode contar mais de um contrato, portanto apenas clique em ENVIAR quando todos os contratos
estiverem incluídos<br></b></div>";
itemFormulario();

}
//fim formulario
function itemFormulario(){

    echo "<p align=\"center\">...................................................................................................................................</p>

<div>
<form method=\"POST\" name=\"itemFormulario\" action=\"index2.php?pagina=Novo\">
<table border=\"0\" width=\"650\" align=\"center\" class=\"tabItemProtocolo\">
<thead>
<tr>
    <th width=\"100\">Nome</th>
    <th width=\"100\">Cpf/Cnpj</th>
    <th width=\"10\">Tipo</th>
    <th >Obs</th>
    <th width=\"5\">D</th>
</tr>
</thead>
";
        $sql = "select * from itemProtocolo A
            join
            protocolo B
            on A.codProtocolo = B.codProtocolo
            where A.codProtocolo ='".$_SESSION['codProtocolo']."'";
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $total = mysql_num_rows($resultado);
        $_SESSION['total'] = $total;
        while ($linha = mysql_fetch_array($resultado)){
        echo "
        <tbody>
        <tr>
            <td class=\"resultCampo\">".$linha['nomeCliente']."</td>
            <td class=\"resultCampo\">".$linha['cpfCnpjCliente']."</td>
            <td class=\"resultCampo\" align=\"center\">".$linha['tipo']."</td>
            <td class=\"resultCampo\">".$linha['obs']."</td>
            <td><a href=\"index2.php?pagina=Novo&item=".$linha['cpfCnpjCliente']."\" >X</a></td>
        </tr>";
        }

echo "
    <tr>
        <th colspan=5>Total Contratos: ".$total."</th>
    </tr>

</tbody>
</table>
</div>
<table border=\"0\" align=\"center\">
<thead>
        <tr>
        <td class=\"red\"align=\"right\"><input type=\"submit\" value=\"Deletar\" name=\"deletar\" >
        <td class=\"orange\"align=\"right\"><input type=\"submit\" value=\"Gravar\" name=\"gravar\" >
        <td class=\"green\"align=\"right\"><input type=\"submit\" value=\"Enviar\" name=\"enviar\" >
    </tr>
</thead>
<tbody>
</tbody>
</table>
</form>";
}
//inicio formulario
function gravarCabecalho(){


    if (isset($_SESSION['codProtocolo']) && !$_SESSION['codProtocolo']==""){

    }else{
        $sql2 = "select * from protocolo order by codProtocolo desc limit 1 ";//busca o ultimo cod que está no banco
        $resultado2 = mysql_query($sql2) or die ("erro sqlGravarCabecalho".mysql_error());
        $dado2 = mysql_fetch_assoc($resultado2);
        $codProtocolo = $dado2['codProtocolo']+1;//acrescenta + 1 no codigo que buscou do banco
        $_SESSION['codProtocolo'] = $codProtocolo;

$sql = "INSERT INTO protocolo (codProtocolo,dataCriacao,status,codUsuario,codEmpresa,quantidadeContratos) VALUES ('$codProtocolo',now(),'A','".$_SESSION['codUsuarioIndex']."','".$_SESSION['codEmpresaIndex']."','0')";
        $resultadosql = mysql_query($sql) or die ("erro sql GravarCabecalho 2".mysql_error());
}



};
//fim gravar

//inicio formulario
function gravarItemProtocolo(){
    $_SESSION['nome'] = ucwords(strtolower($_POST['nome']));
    $_SESSION['obs'] = ucfirst(strtolower($_POST['obs']));
    $_SESSION['cpfCnpjCliente'] = str_replace(".","",$_POST['cpfCnpjCliente']);
    $_SESSION['cpfCnpjCliente'] = str_replace("/","",$_SESSION['cpfCnpjCliente']);
    $_SESSION['cpfCnpjCliente'] = str_replace("-","",$_SESSION['cpfCnpjCliente']);

//verifica se esta NOME esta vazio
    if (($_SESSION['nome'])=="" || $_SESSION['nome']==" "){
    echo "<div class=\"msgY\">Digite um Nome</div>";
    }
    //verifica se CPF/CNPJ está vazio e se é menor que 11 caracteres
    if($_SESSION['cpfCnpjCliente']=="" || $_SESSION['cpfCnpjCliente']==" " || strlen($_SESSION['cpfCnpjCliente'])<11){
        echo "<div class=\"msgY\">Digite um CPF/CNPJ Valido</div>";
        }
        //verificar se comparações são verdadeiras e efetua a negação para não entrar no IF e gravar no banco
        if(!($_SESSION['cpfCnpjCliente']=="" || $_SESSION['cpfCnpjCliente']==" "
               || $_SESSION['nome']=="" || $_SESSION['nome']==" "
               || strlen($_SESSION['cpfCnpjCliente'])<11)){

                $sql_ver = "select A.codProtocolo, B.dataEnvio from itemProtocolo A
                    join
                    protocolo B
                    on A.codProtocolo = B.codProtocolo
                    where A.cpfCnpjCliente ='".$_SESSION['cpfCnpjCliente']."'";

                    $resultado_ver = mysql_query($sql_ver);
                    $linha_ver = mysql_num_rows($resultado_ver);

                    if ($linha_ver>0){
                        echo "<div class=msgY><b>CPF/Cnpj já possui protocolo</b><br>";

                        while ($linha = mysql_fetch_array($resultado_ver)){
                                echo"Protocolo Nº: ".$linha['codProtocolo']." | Enviado: ".$linha['dataEnvio']."<br>";
                                }

                            echo "<br>Deseja enviar como Novo ou Pendência?";
                           echo "
                            <form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"index2.php?pagina=Novo\">
                            <table border=\"0\" align=\"center\">
                            <thead>
                            <tr>
                            <td align=\"right\"><input type=\"submit\" value=\"Novo\" name=\"novo\" >
                            <td align=\"right\"><input type=\"submit\" value=\"Pendência\" name=\"pendencia\" >
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                            </form></div>";
                            }else{
                                $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs)
                                VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','N','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."')";
                                $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocolo".mysql_error());
                                }
                }
    }
//fim formulario

function gravarItemProtocoloPendencia(){
    $sql =  $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs)
                 VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','P','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."')";
    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocoloPendencia ".mysql_error());
}
function gravarItemProtocoloNovo(){
    $sql =  $sql = "INSERT INTO itemProtocolo (cpfCnpjCliente,nomeCliente,tipo,codProtocolo,obs)
                 VALUES ('".$_SESSION['cpfCnpjCliente']."','".$_SESSION['nome']."','N','".$_SESSION['codProtocolo']."','".$_SESSION['obs']."')";
    $resultadosql = mysql_query($sql) or die ("erro sql gravarItemProtocoloNovo ".mysql_error());
}

function salvarProtocolo(){
    $sql = "Select codProtocolo from itemProtocolo where codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
    $total = mysql_num_rows($resultado);

    if ($total<=0){
        echo "<div class=\"msgR\">Não existe itens para serem salvos</div>";

        }else{
            $sql = "UPDATE protocolo SET status='S',quantidadeContratos='".$_SESSION['total']."'
            WHERE codProtocolo = '".$_SESSION['codProtocolo']."' ;";
            $resultadosql = mysql_query($sql) or die ("erro sql salvarFormulario".mysql_error());
            echo "<div class=\"msgG\">Protocolo Salvo com sucesso <br> Protocolo Nº:".$_SESSION['codProtocolo']." </div>";

            $_SESSION['codProtocolo']="";//zera sessa codprotocolo para não abrir o mesmo protocolo depois de salvo
         }

}

function enviarProtocolo(){

    $sql = "Select codProtocolo from itemProtocolo where codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        $total = mysql_num_rows($resultado);
    if ($total<=0){
        echo "<div class=\"msgR\">Não existe itens para serem enviados</div>";
        formulario();
         }else{
            $sql = "UPDATE protocolo SET status='E',quantidadeContratos='".$_SESSION['total']."', dataEnvio=now(),codUsuario='".$_SESSION['codUsuarioIndex']."',codEmpresa='".$_SESSION['codEmpresaIndex']."'
            WHERE codProtocolo = '".$_SESSION['codProtocolo']."' ;";
            $resultadosql = mysql_query($sql) or die ("erro sql salvarFormulario".mysql_error());
            echo "<div class=\"msgG\">Protocolo Enviado<br>
            <b>Protocolo: ".$_SESSION['codProtocolo']."</b>
            <br><br>
            <label><div class=\"linkImpressao\" ><a href=\"protocoloEnviado.php\" target=\"blank\">Imprimir Protocolo</a></div></label>
            </div>";
            $_SESSION['codProtocoloImpressao']=$_SESSION['codProtocolo'];//envia para a var sessao imprimir cod
            $_SESSION['codProtocolo']="";//zera sessa codprotocolo para não abrir o mesmo protocolo depois de enviado
            }

}


function deletarProtocolo(){
    $sql = "DELETE FROM itemProtocolo WHERE codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    $sql = "DELETE FROM protocolo WHERE codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());

    echo "<div class=\"msgR\">Protocolo Deletado</div>";

    $_SESSION['codProtocolo']="";
}

function excluirItemProtocolo(){
    $sql = "DELETE FROM itemProtocolo WHERE cpfCnpjCliente='".$_SESSION['item']."' and codProtocolo='".$_SESSION['codProtocolo']."';";
    $resultadosql = mysql_query($sql) or die ("erro sql deletarItemProtocolo".mysql_error());
}
$_SESSION['item'] = $_GET['item'];
$_SESSION['cod'] = $_GET['cod'];

if(array_key_exists("enviar", $_POST)){
    enviarProtocolo();
    }
    if(array_key_exists("gravar", $_POST)){
        salvarProtocolo();
        }
        if (array_key_exists("incluir",$_POST)){
            gravarItemProtocolo();
            formulario();

            }
            if(array_key_exists("pendencia", $_POST)){
              gravarItemProtocoloPendencia();
              formulario();
              }
              if(array_key_exists("novo", $_POST)){
                gravarItemProtocoloNovo();
                formulario();
                }
                if(array_key_exists("deletar", $_POST)){
                    deletarProtocolo();
                    }
                    if(array_key_exists("item", $_GET)){
                        excluirItemProtocolo();
                        formulario();
                        }
                        if ( !array_key_exists("enviar", $_POST) && !array_key_exists("gravar", $_POST)
                            && !array_key_exists("incluir",$_POST) && !array_key_exists("pendencia", $_POST)
                            && !array_key_exists("novo", $_POST) && !array_key_exists("deletar", $_POST) 
                            && !array_key_exists("item", $_GET)){
                            
                            formulario();
                            gravarCabecalho();

                           }

?>