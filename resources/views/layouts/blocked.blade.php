@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')
     <section class="content">
       <div class="card-header">
        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header" >
                
                <h2 class="card-title"><b><i class="fas fa-ban"></i> Ууупс. Пользователь которого вы хотите просмотреть заблокирован за нарушение правил ресурса!</b></h2>
             

              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@endauth
