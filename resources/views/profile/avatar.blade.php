@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')
<div class="card">

              <div class="card-header">
                <h2 class="card-title"><b>Загрузка аватара</b></h2>
                 <form method="post" action="{{ route('avatar') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  </button>
                </div>
              </div>
              <div class="card-body">
                Выберите изображение для загрузки
              </div>
            @if(Auth::user()->avatar)
            <img src="/storage/app/{{ Auth::user()->avatar }}" alt="..." class="rounded-circle mb-2 ml-2" height="250" width="250">
            @endif
              <div class="custom-file col-4">
                      <input type="file" class="custom-file-input" id="avatar" name="avatar">
                      <label class="custom-file-label ml-2" for="customFile" >Выбрать файл</label>
                      <p><button type="submit" class="btn btn-primary mt-2">Загрузить</button></p>
                    </div>
              <!-- /.card-body -->
            </div>

@endsection

@endauth
