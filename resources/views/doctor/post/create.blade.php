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

                        <form enctype="multipart/form-data" action="{{ route('doctor.post.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Thumb Image</label>
                                    <input name="thumb_image" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label>Short Description</label>
                                    <textarea id="editor2" name="short_description" class="form-control ">
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Content</label>
                                    <textarea id="editor" name="content" class="form-control ">
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
