@extends('admin.layouts.master')

@section('title','Settings')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Settings</strong></li>
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
                        <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="company_name">company name</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="company name" value="{{$setting->company_name}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="event_name">event name</label>
                                    <input type="text" name="event_name" class="form-control" id="event_name" placeholder="event name" value="{{$setting->event_name}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="address" value="{{$setting->address}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="lat">lat</label>
                                    <input type="text" name="lat" class="form-control" id="lat" placeholder="lat" value="{{$setting->lat}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="lng">lng</label>
                                    <input type="text" name="lng" class="form-control" id="lng" placeholder="lng" value="{{$setting->lng}}">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
