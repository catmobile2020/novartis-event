@extends('admin.layouts.master')

@section('title','Users')
@section('js')
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "{{$poll->title}}"
                },
                data: [{
                    type: "pie",
                    startAngle: 25,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}%",
                    dataPoints: [
                        @foreach($poll->options as $option)
                        { y: '{{$poll->userPolls()->count() ? ($option->userPolls()->count() / $poll->userPolls()->count()) * 100 : 0}}', label: "{{$option->option}}" },
                        @endforeach
                    ]
                }]
            });
            chart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection

@section('content')
    <div class="main-content">
        <h1 class="page-title">{{$poll->title}}</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Users</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            @foreach($poll->options as $option)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-6">{{$option->option}}</div>
                                        <div class="col-lg-6 text-right">
                                            {{$poll->userPolls()->count() ? '('.$option->userPolls()->count() .' users ) '.($option->userPolls()->count() / $poll->userPolls()->count()) * 100 : 0}}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-8">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
