@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Doctor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Doctor</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Doctor Create Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <form enctype="multipart/form-data" action="{{ route('admin.doctor.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Academic Degree</label>
                                    <input name="academic_degree" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Experience Year</label>
                                    <input name="experience_year" type="text" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label>Title</label>
                                    <input name="title" class="form-control " type="text" />


                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Note</label>
                                    <textarea name="note" class="form-control summernote">
                                    
                                </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Introduction</label>
                                    <textarea name="introduction" class="form-control summernote">
                                    
                                </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Training Process</label>
                                    <textarea name="training_process" class="form-control summernote">
                                    
                                </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Experience List</label>
                                    <textarea name="experience_list" class="form-control summernote">
                                    
                                </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Prize And Research</label>
                                    <textarea name="prize_and_research" class="form-control summernote">
                                    
                                </textarea>
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Specialization</label>
                                    <select name="specialization_id[]" class="form-control select2" multiple="multiple">
                                        @foreach ($specializations as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Workplace</label>
                                    <select name="workplace_id" class="form-control" m>
                                        @foreach ($workplaces as $w)
                                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                                <a href="{{ route('admin.doctor.index') }}" class="btn btn-danger"><i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
