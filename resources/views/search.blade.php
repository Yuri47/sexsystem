 @extends('layouts.app')

@section('content')
 


        <div class="container">
            <div class="content">
                <div class="title"> </div>
                
                <form method="post" action="searchCode">
                    <label><h3>Digite o código do produto</h3></label>
                    <div>
                    <input type="text" class="form-control" name="codeNumber" required value="@if (isset($preco)){{$codigo}}@endif">
                        </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="idUser" value="{{Auth::user()->id}}">
                     <br>
                    <input type="submit" value="Pesquisar" class="btn btn-primary">  
                </form>
                
                @if(isset($mensagem))
                    
                    <h3>{{$mensagem}}</h3>
                    
                @endif
                
                
                @if (isset($preco))
                 <h4>Código: {{$codigo}}</h4> 
                 <h4>Descricao: {{$descricao}}</h4> 
                  <div class="alert alert-info" role="alert">
                 <h4>Preço: {{$precoFinal}}</h4> 
                  </div> 
                  
                <form method="post" action="modifyPrice" id="formAlterarPreco" style="display:none;">
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="newPrice" value="{{$precoFinal}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="idUser" value="{{Auth::user()->id}}">
                    <input type="hidden" name="descricao" value="{{$descricao}}">
                     
                    
                    
                    <input type="number" placeholder="0" required name="newPrice" min="0" value="{{$precoFinal}}" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">

                    
                    
                    <input type="submit" value="Alterar" class="btn btn-warning">
                </form>
                
                
                
                <div class="footer navbar-fixed-bottom">  
                
                
                <span id="precoCusto" style="display:none;"><h4>Preço de custo: {{$preco}} </h4> </span><button class="btn btn-success" id="verPreco" onclick="verPreco()">Custo</button>
                <button class="btn btn-warning" id="verPreco" onclick="alterarPreco()">Alterar</button>
                    
                    </div>
                @endif
            </div>
        </div>
        
        <script>
function verPreco() {
    var x = document.getElementById("precoCusto");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
            
            
function alterarPreco() {
    var x = document.getElementById("formAlterarPreco");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}            
            
</script>
        
    @endsection