@extends('layouts.admin_layout')

@section('title', 'Затраты')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Финансы</h1>
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
            <div class="row">
                {{--Формамои финансы--}}
                <div class="col-md-8">
                    <!--.card-body -->
                    <div class="card card-teal">
                        <div class="card-header">
                            <h3 class="card-title">Мои финансы</h3>
                        </div>
                        <form action="{{ route('finances.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <h5>Доход в месяц</h5>
                                        <input type="text" name="income" class="form-control" placeholder="0"
                                               value="{{ $finance->income ? $finance->income : '' }}">
                                    </div>
                                    <div class="col-3">
                                        <h5>Вынужденные затраты</h5>
                                        <input type="text" name="forced_expenses" class="form-control" placeholder="0"
                                               value="{{ $finance->forced_expenses ? $finance->forced_expenses : '' }}">
                                    </div>
                                    <div class="col-3">
                                        <h5>Затраты</h5>
                                        <input type="text" name="expenses" class="form-control" placeholder="0"
                                               value="{{ $finance->expenses ? $finance->expenses : '' }}">
                                    </div>
                                    <div class="col-3">
                                        <h5>Накопления</h5>
                                        <input type="text" name="saving" class="form-control" placeholder="0"
                                               value="{{ $finance->saving ? $finance->saving : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <button type="submit" class="btn bg-teal float-right">Принять</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                {{--Форма потрачено--}}
                <div class="col-md-4">
                    <!--.card-body -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Потрачено</h3>
                        </div>
                        <form action="{{ route('expenses.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Затрачено</h5>
                                        <input type="text" name="spent" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-6">
                                        <h5>Дата</h5>
                                        <input type="date" name="date_spent" class="form-control" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Потрачено сегодня: {{ $expensesToday ? $expensesToday : 0 }}</h5>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn bg-danger float-right">Принять</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                {{--Таблица доступных средств--}}
                <div class="col-12">
                    <div class="card">
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Доступно в день</th>
                                    <th>Доступно в неделю</th>
                                    <th>Доступно в месяц</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $availableFinances['day'] }}</td>
                                    <td>{{ $availableFinances['week'] }}</td>
                                    <td>{{ $availableFinances['month'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                {{--Диаграмма 1--}}
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Area Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="areaChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 516px;"
                                        width="516" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                {{--Диаграмма 2--}}
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Stacked Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="stackedBarChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 516px;"
                                        width="516" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        getAreaChartData({{ $arrAvailableFinances }}, {{ $arrExpenses }});
    </script>
@endsection
