@extends('layouts.admin_layout')

@section('title', 'Создать задачу')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Список задач</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                                        Новые
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        В работе
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">
                                        Завершенные
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-striped projects">
                                                    <x-tables.head_tasks/>
                                                    <tbody>
                                                    @foreach($tasks as $task)
                                                        @if($task['status'] === 'Новая')
                                                            <x-tables.tasks id="{{ $task['id'] }}" title="{{ $task['title'] }}" description="{{ $task['description'] }}" created="{{ $task['created_at'] }}" deadline="{{ $task['deadline'] }}" priority="{{ $task['priority'] }}" status="{{ $task['status'] }}" />
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-striped projects">
                                                    <x-tables.head_tasks/>
                                                    <tbody>
                                                    @foreach($tasks as $task)
                                                        @if($task['status'] === 'В работе')
                                                            <x-tables.tasks id="{{ $task['id'] }}" title="{{ $task['title'] }}" description="{{ $task['description'] }}" created="{{ $task['created_at'] }}" deadline="{{ $task['deadline'] }}" priority="{{ $task['priority'] }}" status="{{ $task['status'] }}" />
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-striped projects">
                                                    <x-tables.head_tasks/>
                                                    <tbody>
                                                    @foreach($tasks as $task)
                                                        @if($task['status'] === 'Завершена')
                                                            <x-tables.tasks id="{{ $task['id'] }}" title="{{ $task['title'] }}" description="{{ $task['description'] }}" created="{{ $task['created_at'] }}" deadline="{{ $task['deadline'] }}" priority="{{ $task['priority'] }}" status="{{ $task['status'] }}" />
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
