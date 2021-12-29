@extends('admin.master')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Статистика</h1></div>
                    <div class="col-md-1">
{{--                        <button type="button" class="btn btn-primary" onclick="createBus()">--}}
{{--                            <span class="btn-label">--}}
{{--                                <i class="fa fa-plus"></i>--}}
{{--                            </span>--}}
{{--                            Добавить Клиент--}}
{{--                        </button>--}}
                    </div>
                </div>
                <hr>
                <div class="card-body">

                    <div class="row">

                        <div class="col-xl-10 col-lg-10">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($month) !!}');
        var _xdata=JSON.parse('{!! json_encode($count) !!}');
    </script>



@endsection

