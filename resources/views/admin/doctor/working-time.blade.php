
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
                                        <span class="badge badge-info">{{$today->isoFormat("dddd, DD-MM")}}</span>
                                    </div>
                                    <form class="update-working-time-form-{{$i}}">
                                        <div class="form-group">   
                                            <input type="hidden" name="doctor_id" value="{{$id}}"/>
                                            <input type="hidden" name="day" value="{{$today->day}}"/>  
                                            <input type="hidden" name="month" value="{{$today->month}}"/>  
                                            <input type="hidden" name="select_id" value="{{$i}}"/>
                                            <select  data-id="{{$i}}" name="working_time[]" class="form-control select2 select2-{{$i}}" multiple="multiple" >
                                                @for ($j=1 ; $j<=25 ; $j++)
                                                    @php
                                                        $today->addMinutes(30)->isoFormat("HH:mm")
                                                    @endphp
                                                    <option value="{{$today->hour."-".$today->minute}}">{{$today->isoFormat("HH:mm")}}-{{$today->addMinutes(30)->isoFormat("HH:mm")}}</option>
                                                    @php
                                                        $day = new Carbon\Carbon($today);
                                                        $today->subMinutes(30)->isoFormat("HH:mm")
                                                    @endphp
                                                @endfor 
                                            </select>
                                        </div>
                                        <button data-id="{{$i}}" class="btn btn-danger update-working-time update-working-time-{{$i}}">
                                            <span class="loading loading-{{$i}}">Update Working time for {{$day->isoFormat("dddd, DD-MM")}}</span>
                                        </button>
                                    </form>
                                </div>
                            @endfor                     
                        </div>
                    </div>
                  </div>
            </div>
        </div>
  </section>
    
@endsection



@push("scripts")
    <script>
        $(document).ready(function() {
            // Show working Time on select2 
            $.ajax({
                type: "GET",
                url: "{{route('admin.working-time.get-working-time')}}",
                dataType: "JSON",
                success: function (datas) {
                    $.each(datas, function (i,v) {             
                        $('.select2-'+k).select2().val(v).trigger('change');
                    });
                },
            });
            // Hide update working time button 
            $(".update-working-time").hide();
            // Show update working time button when changing
            $(".select2").on("change",function(){
                const id = $(this).data("id");
                $(".update-working-time-"+id).show();
            })
            // Update working Time by sending AJAX
            $(".update-working-time").on("click", function (e) {
                e.preventDefault();
                const id = $(this).data("id"); 
                const data = $(".update-working-time-form-"+id).serialize();
                const text = $(".loading-"+id).html();
                $.ajax({
                    type: "PUT",
                    url: "{{route('admin.working-time.update')}}",
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        $(".loading-"+id).html('<i class="fas fa-sync fa-spin"></i>');
                    },
                    success:function(data){
                        if(data.status == "success") { 
                            $(".loading-"+id).html(text);
                            $(".update-working-time").hide();
                            Toastify({
                            text: data.message,
                            className:"info",  
                            style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                            }).showToast();
                        }
                    },
                });
                
            });
        });
    </script>
@endpush