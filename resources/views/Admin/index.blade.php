@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
      <div id="chart-line"></div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12">
      <h5 class="negro">Ultimas Noticias</h5>
      <div class="alert alert-light" role="alert">
        <h6 class="negro"> <i class="fas fa-user-friends"></i> Usuarios registrados</h6>
        {{$UserRegister}}
      </div>
      <div class="alert alert-light" role="alert">
        <h6 class="negro"><i class="fas fa-check-circle"></i> Préstamos realizados</h6>
          {{$Loans}}
      </div>
      <div class="alert alert-light" role="alert">
        <h6 class="negro"><i class="fas fa-bell"></i> Productos por revisar</h6>
        10 productos
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-6 col-sm-12">
      <h5 class="negro">Mejores usuarios</h5>
      <div class="row">
        <!--MEJORES USUARIOS CARTAS-->
        <div class="col-md-4">
          <div class="card text-center">
            <img src="{{asset('img/user.png')}}" alt="" class="card-img-top">
            <h5 class="card-title">Marco Antonio Solis</h5>
            <p class="card-text">Puebla</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-center">
            <img src="{{asset('img/user.png')}}" alt="" class="card-img-top">
            <h5 class="card-title">Marco Antonio Solis</h5>
            <p class="card-text">Puebla</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-center">
            <img src="{{asset('img/user.png')}}" alt="" class="card-img-top">
            <h5 class="card-title">Marco Antonio Solis</h5>
            <p class="card-text">Puebla</p>
          </div>
        </div>
        <!--MEJORES USUARIOS CARTAS-->
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div id="chart-donus"></div>
      <div class="card-body">

      </div>
    </div>
  </div>
</div>


@endsection
