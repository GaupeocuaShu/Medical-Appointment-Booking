
@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Doctor</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Doctor</a></div>
              <div class="breadcrumb-item">Show</div>
            </div>
          </div>

        <div class="section-body">
            <h2 class="section-title">Doctor Show Forms</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img width="200" alt="{{getFullName($doctor->user)}}" src="{{asset($doctor->user->avatar)}}"/>
                                <div> 
                                    <h3 class="font-weight-bold">{{$doctor->academic_degree." ".getFullName($doctor->user)}}</h3>
                                    <p><span class="font-weight-bold text-primary">Doctor</span> | <span class="font-weight-bold">{{$doctor->experience_year}}</span> experiences year</p>
                          
                                    <p><span>Speciality</span> &emsp;
                                        @foreach ($doctor->specializations as $s)
                                            <span class="text-primary font-weight-bold">
                                                    {{$s->name}} &emsp13;
                                            </span>
                                        @endforeach
                                    </p>

                                    <p>
                                        <span>Title</span> &emsp;
                                            <span class="text-primary font-weight-bold">
                                                    {{$s->name}} &emsp13;
                                            </span>
                                    </p>
                                </div>
                            </div>
                            @if ($doctor->note)             
                                <div>
                                    <h5>Note</h5>
                                    <p>{!!$doctor->note!!}</p>
                                </div>
                            @endif
                            @if ($doctor->introduction)                      
                                <div>
                                    <h5>Introduction</h5>
                                    <p>{!!$doctor->introduction!!}</p>
                                </div>
                            @endif
                            @if ($doctor->training_process)
                                <div>
                                    <h5>Training Process</h5>
                                    <p>{!!$doctor->training_process!!}</p>
                                </div>
                            @endif
                            @if ($doctor->experience_list)
                                <div>
                                    <h5>Experience List</h5>
                                    <p>{!!$doctor->experience_list!!}</p>
                                </div>
                            @endif
                            @if ($doctor->prize_and_research)                     
                                <div>
                                    <h5>Prizes & Research</h5>
                                    {{Str::length($doctor->prize_and_research)}}
                                    <p>{!!$doctor->prize_and_research!!}</p>
                                </div>
                            @endif
                            <a href="{{route("admin.doctor.index")}}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
                        </div>
                        
                     
                    </div>

                  </div>
            </div>
        </div>
  </section>
    
@endsection
