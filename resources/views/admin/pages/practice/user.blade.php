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
                    text: "{{$practice->title}}"
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
                        @foreach($practice->options as $option)
                        { y: '{{$practice->userPractices()->count() ? ($option->userPractices()->count() / $practice->userPractices()->count()) * 100 : 0}}', label: "{{$option->option}}" },
                        @endforeach
                    ]
                }]
            });
            chart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('d6827af667bcd97eda46', {
            cluster: 'eu',
            forceTLS: true
        });

        var channel = pusher.subscribe('voting');
        channel.bind('VotingEvent', function(data) {
            window.location.reload();
        });
    </script>
@endsection

@section('content')
    <div class="main-content">
        <h1 class="page-title">{{$practice->title}}</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Users</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                @foreach($practice->options as $option)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-6">{{$option->option}}</div>
                            <div class="col-lg-6 text-right">
                                {{$practice->userPractices()->count() ? '('.$option->userPractices()->count() .' users ) '.($option->userPractices()->count() / $practice->userPractices()->count()) * 100 : 0}}%
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
