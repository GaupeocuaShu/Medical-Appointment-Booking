@extends('doctor.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Post</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Post</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Post Create Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <form enctype="multipart/form-data" action="{{ route('doctor.post.update', $post->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <img width="300" alt="Thumb Image" src="{{ asset($post->thumb_image) }}" /><br>
                                    <label>Thumb Image</label>
                                    <input name="thumb_image" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input value="{{ $post->title }}" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control summernote-simple ">
                                        {!! $post->short_description !!}
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Content</label>
                                    <textarea id="editor" name="content" class="form-control ">
                                        {!! $post->content !!}
                                    </textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                                <a href="{{ route('doctor.post.index') }}" class="btn btn-danger"><i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
