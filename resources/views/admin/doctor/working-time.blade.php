
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
            <h2 class="section-title">Doctor Working Time </h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">         
                            @for ($i=1 ; $i<=7 ; $i++)
                            @php                        
                                $today->addDay();
                                $today->setHour(7);
                                $today->setMinutes(30);
                            @endphp   
                            <div class="mb-4">
                                <div class="mb-4" >
                                    <span class="badge badge-info">{{$today->isoFormat("dddd, m-DD")}}</span>
                                </div>
                                <div class="form-group">
                                   
                                    <select name="specialization_id[]" class="form-control select2" multiple="multiple" >
                                        @for ($j=1 ; $j<=25 ; $j++)
                                            <option value="{{$j}}">{{$today->addMinutes(30)->isoFormat("HH:mm")}}-{{$today->addMinutes(30)->isoFormat("HH:mm")}}</option>
                                            @php
                                                $today->subMinutes(30)->isoFormat("HH:mm")
                                            @endphp
                                        @endfor 
                                    </select>
                                </div>
                            </div>
                            @endfor                     
                        </div>
                    </div>
                  </div>
            </div>
        </div>
  </section>
    
@endsection
