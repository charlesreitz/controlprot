<html>
<head>
<link rel="stylesheet" type="text/css" href="exemplo.css">
<title>Enquete</title>
</head>
<body bgcolor="#00254a" text="#cccccc">
<p>
<?php
 clearstatcache();                     // limpa o cache  
 $file = "/home/sites/megacred.net/web/www/enquete/data.txt";                   // file recebe o nome do arquivo de dados
 $fp = fopen($file,"r+");              // abre o arquivo com os dados para leitura
 $handle = fread($fp,filesize($file)); // handle recebe o conteudo do arquivo
 fclose($fp);                          // fecha o arquivo fp
 $lines = explode("#",$handle);        // cria o vetor lines com as linhas do arquivo de dados
 $nlines = $lines[0];                  // nlines guarda o numero de linhas do arquivo de dados
 $question = $lines[1];                // question recebe a pergunta da enquete
 for( $i = 2; $i <= $nlines; $i++)
 {
   // separa a opção do número de votos dessa opção
   // lines[i][0] possui a opção e lines[i][1] possui a quantidade de votos
   $lines[$i] = explode("|",$lines[$i]); 
 }
 // calcula a quantidade total de votos, armazenada na variavel soma
 $soma = 0;
 for( $i = 2; $i <= $nlines; $i++)
 {
   $soma += $lines[$i][1];
 }
 // controi uma tabela com o resultado parcial da enquete
 echo "<strong>:: Resultado parcial</strong></p><hr>"; 
 echo "<p><table><tr><td>" . $question . "</td></tr>";
 for( $i = 2; $i <= $nlines; $i++)
 {
   $percent = ($lines[$i][1]/$soma)*100;      // calcula a porcentagem de votos para a opção i
   echo "<tr><td>" . $lines[$i][0] . "</td>"; // imprime a opção i
   echo "<td>";
   // coloca uma barra representando a porcentagem para a opção i
   echo "<img src=\"l.gif\">";
   for( $j = 0; $j <= $percent; $j++ )
   {
   	 echo "<img src=\"b.jpg\">";  
   }
   echo "<img src=\"r.gif\">";
   // imprime a porcentagem formatada
   printf(" %01.1f%%", $percent); 
 }
 echo "</table>";
 echo "<br>Votaram nessa enquete <strong>" . $soma . "</strong> pessoas.</p>";
?>
<br><a href="enquete.php">[Voltar]</a>
</body>
</html>