@extends('admin.layouts.master')

@section('title','Practice')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Practice</strong></li>
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
                        <form action="{{isset($practice->id) ? route('admin.practices.update',$practice->id) : route('admin.practices.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($practice->id)
                                @method('PUT')
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{$practice->title}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Status</label>
                                    <select class="form-control" name="active">
                                        <option value="1" {{$practice->active ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$practice->active ? '' : 'selected'}}>DisActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.practices.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
