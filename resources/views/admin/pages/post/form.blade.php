@extends('admin.layouts.master')

@section('title','Posts')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Posts</strong></li>
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
                        <form action="{{isset($post->id) ? route('admin.posts.update',$post->id) : route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($post->id)
                                @method('PUT')
                            @endisset
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="content">content</label>
                                    <textarea name="content" rows="6" class="form-control" id="content" placeholder="Write Your Post">{{$post->content}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photo">
                                </div>
                            </div>
                            @isset($post->id)
                                <div class="col-lg-6">
                                    <img src="{{$post->photo}}" style="height: 200px;width: auto">
                                </div>
                            @endisset
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.posts.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
