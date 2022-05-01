@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Сделать публикацию</h3>
              </div>
              <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Заголовок</label>
                    <input type="text" class="form-control" id="title" placeholder="Введите заголовок..." name="title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Комментарий</label>
                    <textarea class="form-control" rows="3" id="description" placeholder="Введите текст..." name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Выберите фото</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="exampleInputFile">Выбрать</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

@endsection

@endauth
