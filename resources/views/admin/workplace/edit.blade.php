@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Workplace</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Workplace</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Workplace Edit Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <form enctype="multipart/form-data" action="{{ route('admin.workplace.update', $wp->id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="{{ $wp->name }}" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control summernote-simple"> 
                                     {{ $wp->address }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input value="{{ $wp->city }}" name="city" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Province</label>
                                    <input value="{{ $wp->province }}" name="province" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $wp->status == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $wp->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                                <a href="{{ route('admin.workplace.index') }}" class="btn btn-danger"><i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
