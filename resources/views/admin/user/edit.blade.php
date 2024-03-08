
@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">User</a></div>
              <div class="breadcrumb-item">Edit</div>
            </div>
          </div>

        <div class="section-body">
            <h2 class="section-title">User Edit Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                      <form method="POST" enctype="multipart/form-data" action="{{route("admin.user.update",$user->id)}}"> 
                        @method("PUT")
                        @csrf
                        <div class="card-body">
                            <div>
                                <label>User Avatar</label>
                                <br/>
                                <img width="300" src="{{asset("$user->avatar")}}"
                                alt="{{$user->name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input name="avatar" type="file" class="form-control">
                             </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label>First Name</label>
                                    <input value="{{$user->first_name}}" name="first_name" type="text" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label>Middle Name</label>
                                    <input value="{{$user->middle_name}}" name="middle_name" type="text" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label>Last Name</label>
                                    <input value="{{$user->last_name}}" name="last_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Address</label>
                                <textarea  name="address" class="form-control summernote-simple">
                                    {!!$user->address!!}
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6 ">
                                    <label>Phone</label>
                                    <input value="{{$user->phone}}" name="phone" type="text" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6 ">
                                    <label>Date Of Birth</label>
                                    <input value="{{$user->date_of_birth}}" name="date_of_birth" type="date" class="form-control">
                                </div> 
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input value="{{$user->email}}" name="email" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select  name="gender" class="form-control">
                                    <option value="1" {{$user->gender==1 ? "selected" : " "}}>Male</option>
                                    <option value="0" {{$user->gender==0 ? "selected" : " "}}>Female</option>
                                </select>   
                            </div>
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea  name="description" class="form-control summernote-simple">
                                    {!!$user->description!!}
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>Status</label>
                                    <select  name="status" class="form-control">
                                        <option value="1" {{$user->status==1 ? "selected" : " "}}>Active</option>
                                        <option value="0" {{$user->status==0 ? "selected" : " "}}>Inactive</option>
                                    </select>   
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="admin" {{$user->role=="admin" ? "selected" : " "}}>Admin</option>
                                        <option value="doctor" {{$user->role=="doctor" ? "selected" : " "}}>Doctor</option>
                                        <option value="user" {{$user->role=="user" ? "selected" : " "}}>User</option>
                                    </select>   
                                </div>
                            </div>
                            <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                            <a href="{{route("admin.user.index")}}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>
                      </form>
                     
                    </div>

                  </div>
            </div>
        </div>
  </section>
    
@endsection
