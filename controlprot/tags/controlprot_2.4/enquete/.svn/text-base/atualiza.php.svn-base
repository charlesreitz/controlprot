<html>
<head>
<link rel="stylesheet" type="text/css" href="exemplo.css">
<title>Enquete</title>
</head>
<body bgcolor="#00254a" text="#cccccc">
<p>
<?php
$file_ip = "ip.txt";             // associa a file_ip o arquivo com os ip's que já votaram na enquete
$file = "data.txt";              // associa a file o arquivo de dados
$ip =  $_SERVER['REMOTE_ADDR'];  // recebe o ip do computador remoto
$choose = $_POST['escolha'];     // recebe a escolha do usuário vinda do formulário

$fp = fopen($file_ip,"r");                  // abre o arquivo file_ip para leitura
$handle_ip = fread($fp,filesize($file_ip)); // handle_ip recebe o conteudo do arquivo
fclose($fp);                                // o arquivo é fechado
$handle_ip = explode("#",$handle_ip);       // coloca os ip's no vetor handle_ip       

// flag que permite ou não a execução do voto
$flag = 0;
// se o usuário já votou a flag vai para 1 e outro voto não é permitido
// caso contrário a flag continua em 0 e inicia o procedimento para atualização dos dados
// é testado cada ip em handle_ip
for( $i = 0; $i < count($handle_ip); $i++ )
{
   if( $handle_ip[$i] == $ip )
   {  
     $flag = 1;
   } // if
} // for
if( $flag == 0 )
{ 
  clearstatcache(); // limpa o cache
  $fp = fopen($file,"r+");
  $handle = fread($fp,filesize($file));
  fclose($fp);
  $lines = explode("#",$handle);
  $nlines = $lines[0];
  for( $i = 2; $i <= $nlines; $i++)
  {
    $lines[$i] = explode("|",$lines[$i]);
  }
  for( $i = 2; $i <= $nlines; $i++ )
  {
    // se a opção escolhida foi a opção i o número de votos é incrementado
	if( $choose == $i )
    {
      $lines[$i][1]++;
    } // if
  } // for
  for( $i = 2; $i <= $nlines; $i++ )
  {
    $lines[$i] = implode("|",$lines[$i]);
  } // for
  $handle = implode("#",$lines);        // handle volta a ser uma string com o conteúdo do arquivo de dados
  $fp = fopen($file,"w+");              // o arquivo de dados é aberto para escrita
  fputs($fp,$handle,strlen($handle)+1); // o conteúdo atualizado é inserido
  fclose($fp);                          // fecha o arquivo de dados
  
  $handle_ip = implode("#",$handle_ip); // handle_ip volta a ser a string com o conteúdo do arquivo de ip's
  $handle_ip .= $ip . "#";	            // o ip atual é inserido no fim da string com o separador
  $fp = fopen($file_ip,"w+");           // o arquivo de ip's é aberto para escrita 
  fputs($fp,$handle_ip,strlen($handle_ip)+1);  // a nova string é colocada no arquivo de ip's
  fclose($fp);                          // fecha o arquivo de ip's
  echo "<strong>Seu voto foi computado com sucesso!</strong>"; 
} // if
else
{
  echo "<strong>Você já votou nessa enquete!</strong>";
}
// coloca link para voltar à tela com a enquete
echo "&nbsp;<a href=http://www.megacred.net/www/index2.php>[Voltar]</a>"
?>
</body>
</html>