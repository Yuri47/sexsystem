<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\produtos;
use App\NovoPreco;
use App\User;

class SearchController extends Controller
{
    //
        
    public function makeSearch(Request $request) {
        
        $codeNumber = $request->input('codeNumber');
        $idUser = $request->input('idUser');
        //echo $codeNumber;
        
        $prod = DB::table('produtos')->where('codigo', '=', $codeNumber)->first();
        
         //dd ($novoPreco);
        
        //UPDATE tabela SET NomeCampo=REPLACE(NomeCampo,',','.')
        
        if (empty($prod)) {
            $mensagem = "Código não encontrado!";
            return view('search', ['mensagem' => $mensagem]);
        }else {
            
     
            
          //  dd ($novoPreco);
        
        $precoFinal = 0;
        
       $usuario = User::find($idUser);     
        
       // echo  $prod->preco . "<br>";
        $preco =   (double)$prod->preco ; 
            
            
           $val = forneceDescricao($codeNumber)['preco'];
            
        echo gettype($preco);
            
         if($val == $preco && gettype($val) == "double"){
                echo 'preços iguais';
                
            } else {
                echo 'preços diferentes';
             
            
             $novoPreco = produtos::find($prod->id);
            $novoPreco->preco = $val;
            $novoPreco->save();
              
             $preco = $val;
                echo "preço modificado";
                
            }    
                
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        
        if ($usuario->type == 'admin') {
        
        
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
        
        } elseif ($usuario->type == 'resale') {
           // $precoFinal = ($preco / 100) * 150;
            
        }  
            //else {
        //    $precoFinal = $prod->novoPreco;
       // }
            
        
        if ($usuario->type == 'resale') {
            $preco = ($preco / 100) * 150;
            
            
             if ($preco <= 3) {
             $precoFinal = ($preco / 100) * 420;
         }
        if ($preco > 3 && $preco <= 6) {
             $precoFinal = ($preco / 100) * 320;
         }
        if ($preco > 6 && $preco <= 8) {
             $precoFinal = ($preco / 100) * 270;
         }
        if ($preco > 8 && $preco <= 12) {
             $precoFinal = ($preco / 100) * 250;
         }
        if ($preco > 12 && $preco <= 16) {
             $precoFinal = ($preco / 100) * 220;
         }
        if ($preco > 16 && $preco <= 25) {
             $precoFinal = ($preco / 100) * 200;
         }
        if ($preco > 25) {
             $precoFinal = ($preco / 100) * 170;
         }
            
        }
            
            
             $novoPreco = DB::table('novo_precos')->where([
                                                    ['idProduto', '=', $prod->id], 
                                                     ['idUser', '=', $idUser],
                                                    ])->first();
           // dd ($novoPreco);
             if($novoPreco ==! null) {
            //$precoFinal = $novoPreco->novoPreco;
             //    dd($novoPreco);
                 $np = DB::table('novo_precos')->where([
                                                    ['idProduto', '=', $prod->id], 
                                                     ['idUser', '=', $idUser],
                                                    ])->first();
               //  dd($novoPreco);
                // dd($np);
                  $precoFinal = $np->novoPreco;
        }
        
        
        //echo "Preço de custo: " . $prod->preco;
        //echo "<br>Preço final: " . $precoFinal;
        $precoFinal = number_format($precoFinal, 2, '.', '');
            
       $descricaoItem = (forneceDescricao($codeNumber)['descricao']);    
            
            
         
            $disponivel = null;
            
            if($descricaoItem == 'Undefined offset: 1' || $descricaoItem == null) {
                $disponivel = 'VERIFICAR DISPONIBILIDADE NO FORNECEDOR';
                 
            } else {
                $disponivel = '';
               
            }
            
            
         
          
            
           
        
        return view('search', ['preco' => $val, 'precoFinal' => $precoFinal, 'id' => $prod->id, 'codigo' => $prod->codigo, 'descricao' => $descricaoItem . $disponivel]);
        }
        
    }
    
    
    
    public function modifyPrice(Request $request) {
        
        
        
        
         $id = $request->input('id');
         $newPrice = $request->input('newPrice');
         $idUser = $request->input('idUser');
         $descricaoItem = $request->input('descricao');
        
       //  echo $idUser;
         
        $precoFinal = 0;
        
        //pega o dado no banco
        $prod = DB::table('produtos')->where('id', '=', $id)->first();
        //pega o dado no banco de novo preço
        $novoPreco = DB::table('novo_precos')->where([
                                                    ['idProduto', '=', $id], 
                                                     ['idUser', '=', $idUser],
                                                    ])->first();
        //se o preço não existir na tabela de novos preços(null), será criado o registro
       // dd($novoPreco);
        if ($novoPreco == null) {
            
            $cadNovoPreco = [
             
            'idUser' => $idUser,
            'idProduto' => $prod->id,
            'novoPreco' => $newPrice
        ];
        NovoPreco::create($cadNovoPreco);
            
             $precoFinal = $newPrice;
           
             
        } else {
            $novoPreco = NovoPreco::find($novoPreco->id);
            $novoPreco->novoPreco = $newPrice;
            $novoPreco->save();
            
             $precoFinal = $novoPreco->novoPreco;
           
        }
        
         
        
    //    $novoPreco = DB::table('novo_precos')->where('idProduto', '=', $id)->first();
       // dd($novoPreco);
        
        
        
        
       
        
        $precoFinal = number_format($precoFinal, 2, '.', '');
        
        
        
        $preco =   (double)$prod->preco;
        
       return view('search', ['preco' => $preco, 'precoFinal' => $precoFinal, 'id' => $prod->id, 'codigo' => $prod->codigo, 'descricao' => $descricaoItem]);
        
        
         
        
        
    }
    
    
    public function returnView() {
        return view('search');
        
    }
     
    
public function getData() {
 
    return forneceDescricao('C1020');
 

}
    
 
    public function cad() {
        return view('cad');
    }
    
    public function logDev(Request $request) {
        $log = $request->input('log'); 
        if(md5($log) == 'e85c059fa118b510dc5a8956d238e313'){
            return view('cad', ['situacao' => 'true']);
            
        }
        else {
            return view('cad', ['situacao' => 'false']);
              
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function teste() {
         
        echo md5(' ');
        
        
        
        
    
}
}
