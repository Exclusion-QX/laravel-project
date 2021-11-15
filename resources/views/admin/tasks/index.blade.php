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
                <x-status.success />
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
                                    <a class="nav-link active" id="custom-tabs-new-tab" data-toggle="pill" href="#custom-tabs-new" role="tab" aria-controls="custom-tabs-new" aria-selected="true">
                                        Новые
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-inwork-tab" data-toggle="pill" href="#custom-tabs-inwork" role="tab" aria-controls="custom-tabs-inwork" aria-selected="false">
                                        В работе
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-completed-tab" data-toggle="pill" href="#custom-tabs-completed" role="tab" aria-controls="custom-tabs-completed" aria-selected="false">
                                        Завершенные
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-all-tab" data-toggle="pill" href="#custom-tabs-all" role="tab" aria-controls="custom-tabs-all" aria-selected="false">
                                        Все
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                {{--Статус Новая--}}
                                <div class="tab-pane fade active show" id="custom-tabs-new" role="tabpanel" aria-labelledby="custom-tabs-new-tab">
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
                                {{--Статус В работе--}}
                                <div class="tab-pane fade" id="custom-tabs-inwork" role="tabpanel" aria-labelledby="custom-tabs-inwork-tab">
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
                                {{--Статус Завершена--}}
                                <div class="tab-pane fade" id="custom-tabs-completed" role="tabpanel" aria-labelledby="custom-tabs-completed-tab">
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
                                    </div>
                                </div>
                                {{--Все задачи--}}
                                <div class="tab-pane fade" id="custom-tabs-all" role="tabpanel" aria-labelledby="custom-tabs-all-tab">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <table class="table table-striped projects">
                                                    <x-tables.head_tasks/>
                                                    <tbody>
                                                    @foreach($tasks as $task)
                                                        <x-tables.tasks id="{{ $task['id'] }}" title="{{ $task['title'] }}" description="{{ $task['description'] }}" created="{{ $task['created_at'] }}" deadline="{{ $task['deadline'] }}" priority="{{ $task['priority'] }}" status="{{ $task['status'] }}" />
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
