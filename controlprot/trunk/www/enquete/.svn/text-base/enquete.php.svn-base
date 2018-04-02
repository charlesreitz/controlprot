<html>
<head>
<link rel="stylesheet" type="text/css" href="exemplo.css">
<title>Enquete</title>
</head>

<body bgcolor="#00254a" text="#cccccc">
<p>
</p>
<!-- formulario da enquete, que usa o arquivo atualiza.php para atualizar os dados -->
<form action="enquete/atualiza.php" method="POST">
<table width="500" border="0">
<?php
 clearstatcache();                     // limpa o cache    
 $file = "/home/sites/megacred.net/web/www/enquete/data.txt";                   // file recebe o nome do arquivo de dados
 $fp = fopen($file,"r+");              // abre o arquivo com os dados para leitura
 $handle = fread($fp,filesize($file)); // handle recebe o conteudo do arquivo
 fclose($fp);                          // fecha o arquivo fp
 $lines = explode("#",$handle);        // cria o vetor lines com as linhas do arquivo de dados
 $nlines = $lines[0];                  // nlines guarda o numero de linhas do arquivo de dados
 $question = $lines[1];                // question recebe a pergunta da enquete
 // imprime a pergunta da enquete
 echo "<tr><td colspan=\"2\"><strong>" . $question . "</strong></td></tr>";
 for( $i = 2; $i <= $nlines; $i++)
 {
    echo "<tr><td width=\"400\" align=\"left\">";

   // separa a opção do número de votos dessa opção
   $lines[$i] = explode("|",$lines[$i]); 
   // coloca um radio button para cada opção i e associa o valor i
   echo "<input type=\"radio\" name=\"escolha\" value=\"" . $i . "\">" . $lines[$i][0] . "<br>";
echo "</td>";


 }
?> 
  <td width="150" align="center">
   <input type="submit" name="submit1" class="formulario" value="Enviar">
   <?//<a href="enquete/resultado.php">Resultado Parcial</a>?>
  </td>
 </tr>
</table>
</form>
</body>
</html>