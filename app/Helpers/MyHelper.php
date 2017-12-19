<?php
 function forneceDescricao($codigo) {
 
    
$busca = $codigo;    
    
$url = "http://www.sensuallove.com.br/busca?s=$busca";
    
    $EnderecoDoArquivo = FILE_GET_CONTENTS($url);
    
    $arrayRetirar = array('<a>', '</strong>', '<h2>', '</span>' );
    
    $conteudourl = str_replace($arrayRetirar, "", $EnderecoDoArquivo);

if(!$EnderecoDoArquivo){
    echo 'Não Foi Possivel Carrgar No Momento';
     $obj = ['preco' => 0, 'descricao' => 'Descrição Não Encontrada'];
    
    
    
    
    
    return $obj;
    
    
}else{
    
    
    try {
    
   
$Titulo = EXPLODE('<div class="caption">',$conteudourl);
$TituloAbre = EXPLODE("</a>", $Titulo[1]);
    
$precoString = EXPLODE('<div class="vista clearfix">',$conteudourl);
$precoStringFim = EXPLODE("</div>", $precoString[1]);
    
    
$tempPreco =   (String)strip_tags(utf8_encode($precoStringFim[0]));
    
     
    
    $arrayRetirar2 = array('vista', 'À', 'R$', '</span>'  );
    $precoFinal = str_replace($arrayRetirar2, "", $tempPreco);
    $precoFinal = str_replace(",", ".", $precoFinal);
    
    
    
    
  
    
    
    
    
    
    $descricao = strip_tags(utf8_encode($TituloAbre[0]));
    $precoFinal = (double)$precoFinal;  
    
    
    $obj = ['preco' => $precoFinal, 'descricao' => $descricao];
    
    
    
    
    
    return $obj;
    
    
   // return strip_tags(utf8_encode($TituloAbre[0]));
 

}catch (Exception $e) {
    echo $e->getMessage();
} 
}
    
}
  

























