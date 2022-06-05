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

                <h3 class="card-title"><b>Сделать публикацию</b></h3>
              </div>
              <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
  <!--                 <div class="form-group">
                    <label for="exampleInputEmail1">Заголовок</label>
                    <input type="text" class="form-control" id="title" placeholder="Введите заголовок..." name="title">
                  </div> -->

                  <div class="form-group">
                    <label for="exampleInputFile">Выберите фото</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="exampleInputFile">Выбрать</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" >Комментарий</label>
                    <p class="lead emoji-picker-container">
                    <textarea class="form-control" rows="3" id="description" placeholder="Введите текст..." name="description" data-emojiable="true" data-emoji-input="unicode"></textarea></p>
                  </div>

                    <div class="form-group">
                            <label>Теги: <span class="text-danger"></span><small>(разделитель - #)</small></label>
                            <br>
                            <input type="text" data-role="tagsinput" name="tags" class="form-control tags">
                            <br>
                            @if ($errors->has('tags'))
                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                            @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                          </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@endauth
