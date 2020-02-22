@extends('admin.layouts.master')

@section('title','Home Page')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                            @foreach($rows as $row)
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h1><a href="{{route('admin.polls.users',$row->id)}}">{{$row->title}}</a></h1>
                                            </div>
                                            <a href="{{route('admin.polls.users',$row->id)}}" class="btn btn-primary btn-rounded">Open</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
