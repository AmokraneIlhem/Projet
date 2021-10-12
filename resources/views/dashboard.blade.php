@extends("layouts.master") 
@section("contenu")
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
               <h3>{{$factures}}</h3> 
             <div class="row">  <p>Factures</p>   </div>
              </div>
              <div class="icon">
               <i class="nav-icon fa fa-file "></i>
              </div>
              <a href="{{route('admin.gestion.factures')}}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
               <h3>{{$struct}}</h3> 

                <p>Structures</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-sitemap "></i>
              </div>
              <a href="{{route('admin.gestion.structures')}}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
               <h3>{{$users}} </h3> 

                <p>Utilisateurs</p>
                
              </div>
              <div class="icon">
               <i class="fa fa-user-plus" aria-hidden="true"></i>
              </div>
              <a href="{{route("admin.habilitations.users.index")}}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                
<h3> {{$fournisseurs}} </h3> 
                <p>Fournisseurs</p>
              </div>
              <div class="icon">
              
                <i class="fa fa-truck"></i>
              </div>
              <a href="{{route('admin.gestion.fournisseurs')}}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}
      
       <div  class="row">
        <div  class="col-lg-6">
      <div  class="card">
       {{$chart->container()}}
  <script src="{{ $chart->cdn()}}"> </script> 
  {{$chart->script()}}
 </div>
  </div>
  
 
 <div  class="col-lg-6">
 <div  class="card">
       {{$chartUser->container()}}
    <script src="{{ $chartUser->cdn()}}"> </script> 
  {{$chartUser->script()}}
   </div>
    <div  class="card">
      {{$chartProfil->container()}}
    <script src="{{ $chartProfil->cdn()}}"> </script> 
  {{$chartProfil->script()}}
  </div>
  </div>
  
   </div>
  
   
   
@endsection

