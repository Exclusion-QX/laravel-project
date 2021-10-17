@extends('layouts.admin_layout')

@section('title', 'Просмотр задачи')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Просмотр задачи</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 order-1 order-md-1">
                        <h3 class="text-primary">{{ $task['title'] }}</h3>
                        <p class="text-muted">{{ $task['description'] }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Дата создания:
                                <b class="d-block">{{ $task['created_at'] }}</b>
                            </p>
                        </div>
                        <div class="text-center mt-5 mb-3">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-2">
                        <form action="{{ route('comments.store', $task['id']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea class="form-control" name="description" rows="3"
                                          placeholder="Написать комментарий..."></textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </div>
                    </form>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8 order-3 order-md-3">
                        <div class="row">
                            <h4>Комментарии</h4>
                            @foreach($comments as $comment)
                            <div class="col-12">
                                <hr>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/admin/dist/img/AdminLTELogo.png" alt="user image">
                                        <span class="username">
                                          <a href="#">{{ $comment->name }}</a>
                                        </span>
                                        <span class="description">{{ $comment->created_at }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>{{ $comment->description }}</p>
                                </div>
                                @if($comment->user_id == Auth()->id())
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-xs">Удалить</button>
                                </form>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
