<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\produtos;

class SearchController extends Controller
{
    //
        
    public function makeSearch(Request $request) {
        
        $codeNumber = $request->input('codeNumber');
        //echo $codeNumber;
        
        $prod = DB::table('produtos')->where('codigo', '=', $codeNumber)->first();
      //  dd ($prod);
        
        //UPDATE tabela SET NomeCampo=REPLACE(NomeCampo,',','.')
        
        if (empty($prod)) {
            $mensagem = "Código não encontrado!";
            return view('welcome', ['mensagem' => $mensagem]);
        }else {
        
        $precoFinal = 0;
        
        
       // echo  $prod->preco . "<br>";
        $preco =   (double)$prod->preco ; 
        
        if ($prod->novoPreco == NULL) {
        
        
        if ($preco <= 3) {
             $precoFinal = ($preco / 100) * 500;
         }
        if ($preco > 3 && $preco <= 6) {
             $precoFinal = ($preco / 100) * 400;
         }
        if ($preco > 6 && $preco <= 8) {
             $precoFinal = ($preco / 100) * 350;
         }
        if ($preco > 8 && $preco <= 12) {
             $precoFinal = ($preco / 100) * 330;
         }
        if ($preco > 12 && $preco <= 16) {
             $precoFinal = ($preco / 100) * 300;
         }
        if ($preco > 16 && $preco <= 25) {
             $precoFinal = ($preco / 100) * 280;
         }
        if ($preco > 25) {
             $precoFinal = ($preco / 100) * 260;
         }
        
        } else {
            $precoFinal = $prod->novoPreco;
        }
        
        
        
        //echo "Preço de custo: " . $prod->preco;
        //echo "<br>Preço final: " . $precoFinal;
        $precoFinal = number_format($precoFinal, 2, '.', '');
        
        return view('welcome', ['preco' => $preco, 'precoFinal' => $precoFinal, 'id' => $prod->id, 'codigo' => $prod->codigo]);
        }
        
    }
    
    
    
    public function modifyPrice(Request $request) {
        
        
        
        
         $id = $request->input('id');
         $newPrice = $request->input('newPrice');
        //echo $codeNumber;
        $prod = produtos::find($id);
            $prod->novoPreco = $newPrice;
            $prod->save();
        
        
        $prod = DB::table('produtos')->where('id', '=', $id)->first();
        
        
        $precoFinal = $prod->novoPreco;
        
        $precoFinal = number_format($precoFinal, 2, '.', '');
        
        
        
        $preco =   (double)$prod->preco;
        
        return view('welcome', ['preco' => $preco, 'precoFinal' => $precoFinal, 'id' => $prod->id, 'codigo' => $prod->codigo]);
        
        
        
        
        
        
        
        
        
        
    }
    
    
    
    
     
    
    
    
}
