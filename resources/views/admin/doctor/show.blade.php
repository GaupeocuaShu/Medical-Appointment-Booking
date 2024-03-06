
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
            <h2 class="section-title">Doctor Details</h2>
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
                            <div>
                                <h5 class="mb-4">Working Time</h5>

                                <hr>
                            </div>
                            <div>
                                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                    @foreach ($datesFrWTime as $key => $wTimes)
                                        @php
                                            $date = Carbon\Carbon::create($key); 
                                        @endphp
                                        @if ($loop->index == 0)
                                            <li class="nav-item">
                                                <a class="nav-link active" id="{{$key}}-tab" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}" aria-selected="true">{{$date->isoFormat("DD-MM")}}</a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link " id="{{$key}}-tab" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}" aria-selected="false">{{$date->isoFormat("DD-MM")}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="tab-content mb-4" id="myTabContent">
                                        @foreach ($datesFrWTime as $key => $wTimes)
                                            @if ($loop->index == 0)
                                                <div class="tab-pane tab-pane-{{$key}} fade show active " id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
                                                    @foreach ($wTimes as $wtime)
                                                        @php
                                                            $time = explode("/",$wtime)[0]; 
                                                            $isBusy = !empty(explode("/",$wtime)[1]);
                                                            $endTime = Carbon\Carbon::create($time);
                                                            $endTime->addMinutes(30);
                                                        @endphp
                                                        <span  class="working-time-button mb-3 btn btn-lg {{$isBusy ? 'btn-outline-warning' : 'btn-outline-primary'}}">{{$time}}-{{$endTime->isoFormat("HH-mm")}}</span>&emsp;
                                                    @endforeach
                                                </div>
                                            @else 
                                                <div class="tab-pane tab-pane-{{$key}} fade" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
                                                    @foreach ($wTimes as $wtime)
                                                        @php     
                                                            $time = explode("/",$wtime)[0]; 
                                                            $isBusy = !empty(explode("/",$wtime)[1]);
                                                        @endphp
                                                        <span  class="working-time-button mb-3 btn btn-lg {{$isBusy ? 'btn-outline-warning' : 'btn-outline-primary'}}">{{$time}}-{{$endTime->isoFormat("HH-mm")}}</span>&emsp;
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="card schedule-card ">
                                            <div class="card-body">
                                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo prov
                                                ident eligendi modi impedit commodi natus vitae debitis odio error sint vo
                                                luptates molestiae pariatur, neque laudantium. Atque eligendi eum d
                                                olore nobis.''
                                            </div>
                                        </div>
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
                            <a href="{{route("admin.doctor.index")}}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i>&emsp;Back</a>
                        </div>
                        
                     
                    </div>

                  </div>
            </div>
        </div>
  </section>
    
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $(".schedule-card").hide();
            $(".nav-link").on("click",  function () {
                $(".tab-pane").removeClass("show active");
                const id = $(this).attr("id");
                const tabID = id.substring(0,id.length-4);
                $(".tab-pane-"+tabID).addClass("show active");
            });
            $(".working-time-button").on("click", function () {
                $(this).toggleClass("btn-warning");
                $(".schedule-card").slideToggle(500);
            });
        });
    </script>
@endpush