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
                <x-status.success />
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
                    <div class="col-12 col-md-12 col-lg-8 order-1 order-md-1">
                        <h3 class="text-primary">{{ $task['title'] }}</h3>
                        <p class="text-muted">{{ $task['description'] }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Дата создания:
                                <b class="d-block">{{ $task['created_at'] }}</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-5 order-1 order-md-1">
                        <div class="mt-5 mb-3">
                            <a href="{{ route('tasks.edit', $task['id']) }}" class="btn btn-sm btn-secondary">Редактировать</a>
                            <form action="{{ route('tasks.updateStatus', [$task['id'], 'В работе']) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">В работе</button>
                            </form>
                            <form action="{{ route('tasks.updateStatus', [$task['id'], 'Завершена']) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">Завершить</button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-3 order-1 order-md-1 text-right" style="display: inline-block;">
                        <div class="mt-5 mb-3">
                        <h4>{{ $task['status'] }}</h4>
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
                                <button type="submit" class="btn btn-dark">Отправить</button>
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
