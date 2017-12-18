<?php
 function forneceDescricao($codigo) {
 
    
$busca = $codigo;    
    
$url = "http://www.sensuallove.com.br/busca?s=$busca";
    
    $EnderecoDoArquivo = FILE_GET_CONTENTS($url);
    
    $arrayRetirar = array('<a>', '</strong>', '<h2>', '</span>' );
    
    $conteudourl = str_replace($arrayRetirar, "", $EnderecoDoArquivo);

if(!$EnderecoDoArquivo){
    echo 'Não Foi Possivel Carrgar No Momento';
}else{
    
   
$Titulo = EXPLODE('<div class="caption">',$conteudourl);
$TituloAbre = EXPLODE("</a>", $Titulo[1]);
    
    
    
return strip_tags(utf8_encode($TituloAbre[0]));
 

}
    
}
  