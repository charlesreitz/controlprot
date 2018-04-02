<? session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}
/*######### FUNCÕES DE DATAS ####################################
Função que converte Y-m-d para d/m/Y
Utilizado para manipular datas no formato Date do MySQL
exibindo no formato convencional.
############################################################## */


function dtPadrao($data) {
$data = trim($data);
if (strlen($data) < 10)
{
$rs = "";
}
else
{
$arr_data = explode(" ",$data);
$data_db = $arr_data[0];
$arr_data = explode("-",$data_db);
$data_form = $arr_data[2]."/".$arr_data[1]."/".$arr_data[0];
$rs = $data_form;
}
return $rs;
}



/*
Função que converte d/m/Y para Y-m-d
Utilizado para inserir datas do tipo converncional em
campos tipo Date do MySQL
*/
function dtBanco($data) {
$data = trim($data);
if (strlen($data) != 10)
{
$rs = "";
}
else
{
$arr_data = explode("/",$data);
$data_banco = $arr_data[2]."-".$arr_data[1]."-".$arr_data[0];
$rs = $data_banco;
}
return $rs;
}



// Código Original/ Original Code by Woodys
// Converte formato do DATETIME do MySQL para um compreensível para os homens
// 2003-12-30 23:30:59 -> 30/12/2003 23:30:59
function mysql_datetime_para_humano($dt) {
        $yr=strval(substr($dt,0,4));
        $mo=strval(substr($dt,5,2));
        $da=strval(substr($dt,8,2));
        $hr=strval(substr($dt,11,2));
        $mi=strval(substr($dt,14,2));
        return date("d/m/Y H:i:s", mktime ($hr,$mi,0,$mo,$da,$yr));
}

//_________________________________________________


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