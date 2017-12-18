@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
              
                    
                    @if(isset($situacao))
                    
                    
                    
                    @extends('auth.register')
                    
                    
                    @else
                    
                            <form method="post" action="/logDev">
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"> </label>

                         <input type="hidden" name="_token" value="{{csrf_token()}}">
                             
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="log" >

                                
                            </div>
                        </div>
                      <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                    </form>
                    
                    @endif
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
