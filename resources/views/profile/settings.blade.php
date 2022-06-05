@auth
@extends('layouts.layout')

@section('content')
     <section class="content">
       <div class="card-header">
        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card card-primary card-outline">
              <div class="card-header" >
                <h2 class="card-title"><i class="fas fa-user-cog"></i> <b>Настройки</b></h2></div> </div>


                  <div class="card-header" >
                <h2 class="card-title"><h6><i class="fas fa-user"></i> <b>Моя информация</b></h6></h2><hr>

                 <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="form-horizontal" method="POST" action="{{ route('changeAbout') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Фамилия</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="about" class="col-md-4 control-label ">О себе</label>
                            <div class="col-md-6">
                                <p class="lead emoji-picker-container">
                                <input id="about" type="text" class="form-control" name="about"  data-emojiable="true" data-emoji-input="unicode" ></p>
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                  <div class="card-header" >
                <h2 class="card-title"><h6><i class="fas fa-key"></i> <b>Смена пароля</b></h6></h2><hr>

                   <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Текущий пароль</label>

                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Новый пароль</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Повторите новый пароль</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сменить пароль
                                </button>
                            </div>
                        </div>
                    </form>
                </div>




              </div>
              </div>
             </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>

    @endsection

@endauth