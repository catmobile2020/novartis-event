@extends('admin.layouts.master')

@section('title','Sessions')

@section('content')
    <div class="main-content">
        <h1 class="page-title">{{$day->title}}  Sessions</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>{{$day->date}}   Sessions</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <a href="{{route('admin.sessions.create',$day->id)}}" class="btn btn-primary" style="float: right;">Add Session</a>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                               <h4>{{session()->get('message')}}</h4>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>location</th>
                                    <th>time from</th>
                                    <th>time to</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->location}}</td>
                                        <td>{{$row->time_from}}</td>
                                        <td>{{$row->time_to}}</td>
                                        <td><a href="{{route('admin.sessions.rates',[$day->id,$row->id])}}">{{$row->total_rate}}</a></td>
                                        <td class="size-80">
                                            <div class="dropdown">
                                                <a href="" data-toggle="dropdown" class="more-link"><i class="icon-dot-3 ellipsis-icon"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{route('admin.sessions.edit',[$day->id,$row->id])}}">Edit</a></li>
                                                    <li><a href="{{route('admin.sessions.destroy',[$day->id,$row->id])}}">Delete</a></li>
                                                    <li><a href="{{route('admin.sessions.rates',[$day->id,$row->id])}}">Rates</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
