
@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Specialization</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Specialization</a></div>
              <div class="breadcrumb-item">Edit</div>
            </div>
          </div>

        <div class="section-body">
            <h2 class="section-title">Specialization Edit Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                      <form method="POST" enctype="multipart/form-data" action="{{route("admin.specialization.update",$specialization->id)}}"> 
                        @method("PUT")
                        @csrf
                        <div class="card-body">
                            <div>
                                <label>Specialization Image</label>
                                <br/>
                                <img width="300" src="{{asset("$specialization->image")}}"
                                alt="{{$specialization->name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input name="image" type="file" class="form-control">
                             </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{$specialization->name}}" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea name="description" name="description" class="form-control summernote-simple">
                                    {{$specialization->description}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select  name="status" class="form-control">
                                    <option value="1" {{$specialization->status==1 ? "selected" : " "}}>Active</option>
                                    <option value="0" {{$specialization->status==0 ? "selected" : " "}}>Inactive</option>
                                </select>   
                            </div>
                            <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                            <a href="{{route("admin.specialization.index")}}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>
                      </form>
                     
                    </div>

                  </div>
            </div>
        </div>
  </section>
    
@endsection
