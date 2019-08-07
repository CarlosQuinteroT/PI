@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
          {{ csrf_field() }}
              <div class="card-body">
              <div align="center">
                <img  src="admin/assets/img/cisco.png" alt="" style="width:100px;">
              </div>
                <br><br>
              <h3 align="center" class="text-muted">Inicie sesion con su cuenta</h3>
               <br><br>
              <div class="form-group mb-4{{$errors->has('usuario' ? 'is-invalid' : '')}}">
<!--                 <span class="input-group-addon"><i class="icon-user"></i></span> -->
                <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario" style="border-right:0px; border-left:0px;border-top:0px; border-color:blue;">
                {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
<!--                 <span class="input-group-addon"><i class="icon-lock"></i></span> -->
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" style="border-right:0px; border-left:0px;border-top:0px; border-color:blue;">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
                <br><br>
              <div class="row">
                <div  align="center" class="col-11">
                  <button type="submit" class="btn btn-primary ml-4" style="border-radius:30px;">Siguiente</button>
                </div>
                <br><br><br>
                <div align="center" class="col-12">
                  
                </div>
              </div>
            </div>
          </form>
          </div>
         
        </div>
      </div>
    </div>
@endsection
