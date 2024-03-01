
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
                  
                      <form enctype="multipart/form-data" action="{{route("admin.doctor.store")}}" method="POST"> 
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
                                <textarea name="title"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label>Note</label>
                                <textarea name="note"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label>Introduction</label>
                                <textarea name="introduction"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label>Training Process</label>
                                <textarea name="training_process"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label>Experience List</label>
                                <textarea name="experience_list"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label>Prize And Research</label>
                                <textarea name="prize_and_research"  class="form-control summernote">
                                    
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($users as $u)
                                        <option value="{{$u->id}}">{{$u->email}}</option>
                                    @endforeach
                                </select>  
                            </div> 
                            <div class="form-group">
                                <label>Select2 Multiple</label>
                                <select class="form-control select2 select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                                  <option>Option 1</option>
                                  <option>Option 2</option>
                                  <option>Option 3</option>
                                  <option>Option 4</option>
                                  <option>Option 5</option>
                                  <option>Option 6</option>
                                </select>
                                <span class="select2 select2-container select2-container--default select2-container--above select2-container--focus" dir="ltr" style="width: 548px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Option 1"><span class="select2-selection__choice__remove" role="presentation">×</span>Option 1</li><li class="select2-selection__choice" title="Option 3"><span class="select2-selection__choice__remove" role="presentation">×</span>Option 3</li><li class="select2-selection__choice" title="Option 4"><span class="select2-selection__choice__remove" role="presentation">×</span>Option 4</li><li class="select2-selection__choice" title="Option 5"><span class="select2-selection__choice__remove" role="presentation">×</span>Option 5</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                              </div>

                            <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i></button>&emsp;
                            <a href="{{route("admin.doctor.index")}}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>
                      </form>
                     
                    </div>

                  </div>
            </div>
        </div>
  </section>
    
@endsection
