@extends('layouts.admin_layout')

@section('title', 'Редактировать задачу')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Редактировать задачу: {{ $task['title'] }}</h1>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <form action="{{ route('tasks.update', $task['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputBorder">Название</label>
                                        <input type="text" class="form-control form-control-border"
                                               name="title" id="exampleInputBorder"
                                               placeholder="Моя задача" value="{{ $task['title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Описание</label>
                                        <textarea class="form-control" name="description" rows="3"
                                                  placeholder="Описание задачи...">{{ $task['description'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputBorder">Плановое завершение задачиние</label>
                                        <input type="text" class="form-control form-control-border"
                                               name="deadline" id="exampleInputBorder"
                                               placeholder="2021-01-30 00:00:00" value="{{ $task['deadline'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Приоритет</label>
                                        <select class="custom-select form-control-border" name="priority" id="exampleSelectBorder">
                                            <option value="Низкий" {{ ($task['priority'] == "Низкий" ? "selected":"") }}>Низкий</option>
                                            <option value="Средний" {{ ($task['priority'] == "Средний" ? "selected":"") }}>Средний</option>
                                            <option value="Высокий" {{ ($task['priority'] == "Высокий" ? "selected":"") }}>Высокий</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Статус</label>
                                        <select class="custom-select form-control-border" name="status" id="exampleSelectBorder">
                                            <option value="Новая" {{ ($task['status'] == "Новая" ? "selected":"") }}>Новая</option>
                                            <option value="В работе" {{ ($task['status'] == "В работе" ? "selected":"") }}>В работе</option>
                                            <option value="Завершена" {{ ($task['status'] == "Завершена" ? "selected":"") }}>Завершена</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Принять</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
