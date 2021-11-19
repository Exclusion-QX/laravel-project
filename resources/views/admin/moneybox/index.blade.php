@extends('layouts.admin_layout')

@section('title', 'Копилка')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Копилка</h1>
                </div>
            </div>
            @if (session('success'))
                <x-status.success/>
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if(!$moneybox)
                            <div class="col-md-6">
                                <!--.card-body -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Создать копилку</h3>
                                    </div>
                                    <form action="{{ route('moneybox.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body moneybox-form">
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5>Название</h5>
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="0">
                                                </div>
                                                <div class="col-4">
                                                    <h5>Размер накопления</h5>
                                                    <input type="text" name="purpose" class="form-control"
                                                           placeholder="0">
                                                </div>
                                                <div class="col-4">
                                                    <h5>Картинка</h5>
                                                    <input type="file" name="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h5>Потрачено сегодня:</h5>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn bg-primary float-right">Принять
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4">
                                <div class="progress-group">
                                    {{ $moneybox->title }}
                                    <span
                                        class="float-right"><b>{{ $moneybox->in_stock }} / {{ $moneybox->purpose }}</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger progress-bar-money"
                                             style="width: {{ $moneybox->progress }}%; border-radius: 10px"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="{{ route('moneybox.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="{{ route('moneybox.update') }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="in_stock"
                                                       placeholder="В копилку">
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-info btn-flat">Добавить</button>
                                                 </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 offset-1">
                                <div class="position-relative">
                                    <img src="/admin/test.jpg" alt="Photo 1" class="img-fluid">
                                    <div class="ribbon-wrapper ribbon-lg">
                                        <div class="ribbon bg-success text-lg">
                                            {{ $moneybox->progress }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
