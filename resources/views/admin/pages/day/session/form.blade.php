@extends('admin.layouts.master')

@section('title','Sessions')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Sessions</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
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
                        <form action="{{isset($session->id) ? route('admin.sessions.update',[$day->id,$session->id]) : route('admin.sessions.store',$day->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($session->id)
                                @method('PUT')
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{$session->title}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="location">location</label>
                                    <input type="text" name="location" class="form-control" id="location" placeholder="location" value="{{$session->location}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="time_from">time from</label>
                                    <input type="time" name="time_from" class="form-control" id="time_from" placeholder="time from" value="{{$session->time_from}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="time_to">time to</label>
                                    <input type="time" name="time_to" class="form-control" id="time_to" placeholder="time to" value="{{$session->time_to}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 alert alert-info">
                                    <h2 class="text-center">Select Speakers</h2>
                                </div>
                                <div class="col-lg-12">
                                    @foreach($speakers as $speaker)
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="speaker_id_{{$speaker->id}}">{{$speaker->name}}</label>
                                                <input {{in_array($speaker->id,$session->speakers()->pluck('user_id')->toArray()) ? 'checked' : ''}} type="checkbox" name="speaker_id[]" class="form-control" id="speaker_id_{{$speaker->id}}" value="{{$speaker->id}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.sessions.index',$day->id)}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
