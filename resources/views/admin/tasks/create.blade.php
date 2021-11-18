@extends('layouts.admin_layout')

@section('title', 'Создать задачу')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Создать задачу</h1>
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
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputBorder">Название</label>
                                            <input type="text" class="form-control form-control-border"
                                                   name="title" id="exampleInputBorder"
                                                   placeholder="Моя задача">
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="form-control" name="description" rows="3"
                                                      placeholder="Описание задачи..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
{{--                                        <div class="form-group">--}}
{{--                                            <label>Плановое завершение задачи</label>--}}
{{--                                            <div class="input-group date" id="reservationdatetime"--}}
{{--                                                 data-target-input="nearest">--}}
{{--                                                <input type="text" class="form-control datetimepicker-input"--}}
{{--                                                       name="deadline"--}}
{{--                                                       data-target="#reservationdatetime">--}}
{{--                                                <div class="input-group-append" data-target="#reservationdatetime"--}}
{{--                                                     data-toggle="datetimepicker">--}}
{{--                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="exampleInputBorder">Плановое завершение задачиние</label>
                                            <input type="date" class="form-control form-control-border"
                                                   name="deadline" id="exampleInputBorder"
                                                   placeholder="2021-01-30 00:00:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Приоритет</label>
                                            <select class="custom-select form-control-border" name="priority" id="exampleSelectBorder">
                                                <option value="Низкий">Низкий</option>
                                                <option value="Средний">Средний</option>
                                                <option value="Высокий">Высокий</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
