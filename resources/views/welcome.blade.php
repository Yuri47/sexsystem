<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/csss?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"> </div>
                
                <form method="post" action="searchCode">
                    <label>Digite o código do produto</label>
                    <input type="text" name="codeNumber" required value="@if (isset($preco)){{$codigo}}@endif">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                     
                    <input type="submit" value="Pesquisar">  
                </form>
                
                @if(isset($mensagem))
                    
                    <h3>{{$mensagem}}</h3>
                    
                @endif
                
                
                @if (isset($preco))
                 <h3>Código: {{$codigo}}</h3> 
                 <h3>Preço de custo: <span id="precoCusto" style="display:none;">{{$preco}}</span> </h3> <button id="verPreco" onclick="verPreco()">Visualizar</button>
                 <h3>Preço final: {{$precoFinal}}</h3> <button id="verPreco" onclick="alterarPreco()">Alterar</button>
                  
                  
                <form method="post" action="modifyPrice" id="formAlterarPreco" style="display:none;">
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="newPrice" value="{{$precoFinal}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                     
                    
                    
                    <input type="number" placeholder="0" required name="newPrice" min="0" value="{{$precoFinal}}" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">

                    
                    
                    <input type="submit" value="Alterar">
                </form>
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
        
        
        
        
    </body>
</html>
