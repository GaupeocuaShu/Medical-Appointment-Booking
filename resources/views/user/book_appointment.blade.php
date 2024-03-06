@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Booking Appointment</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Booking Appointment</a></div>
              <div class="breadcrumb-item"></div>
            </div>
          </div>

        <div class="section-body">
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
                        @foreach ($wTimes as $time)
                            <form method="POST" action="{{route("create-appointment")}}" style="display: inline-block">
                                @csrf
                                @php
                                    $endTime = Carbon\Carbon::create($time);
                                    $endTime->addMinutes(30);
                                    $dateTime = Carbon\Carbon::create($key.$time);
                                @endphp
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                <input type="hidden" name="patient_id" value="{{Auth::user()->patient->patient_id}}"/>
                                <input type="hidden" name="doctor_id" value="{{$doctor->id}}"/>
                                <input type="hidden" name="appointment" value="{{$dateTime}}"/>
                                <button class="mb-3 time-choosing-btn btn btn-lg btn-outline-primary">{{$time}}-{{$endTime->isoFormat("HH-mm")}}</button>&emsp;
                            </form>
                                
                        @endforeach
                    </div>
                @else 
                    <div class="tab-pane tab-pane-{{$key}} fade" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
                        @foreach ($wTimes as $time)
                        <form method="POST"  action="{{route("create-appointment")}}" style="display: inline-block">
                            @csrf
                                @php
                                    $dateTime = Carbon\Carbon::create($key.$time);
                                @endphp
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                <input type="hidden" name="patient_id" value="{{Auth::user()->patient->patient_id}}"/>
                                <input type="hidden" name="doctor_id" value="{{$doctor->id}}"/>
                                <input type="hidden" name="appointment" value="{{$dateTime}}"/>
                                <button class="mb-3 time-choosing-btn btn btn-lg btn-outline-primary">{{$time}}-{{$endTime->isoFormat("HH-mm")}}</button>&emsp;
                            </form>
                        @endforeach
                    </div>
                @endif
            @endforeach
    </div>
</div>
</div>
</section>
  
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".nav-link").on("click",  function () {
                $(".tab-pane").removeClass("show active");
                const id = $(this).attr("id");
                const tabID = id.substring(0,id.length-4);
                $(".tab-pane-"+tabID).addClass("show active");

            });
            // $("form").on("submit",function(e){
            //     e.preventDefault();
            //     const data = $(this).serialize();
            //     $.ajax({
            //         type: "POST",
            //         url: "{{route('create-appointment')}}",
            //         data: data,
            //         dataType: "JSON",
            //         success: function (response) {
            //             console.log(response);
            //         },
            //     });
            // })
        });
    </script>
@endpush