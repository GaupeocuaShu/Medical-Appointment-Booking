
@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Schedule</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Schedule</a></div>
              <div class="breadcrumb-item">Table</div>
            </div>
          </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Schedule Table</h4>
                      <div class="card-header-action">
                        <div class="input-group-btn">

                        </div>
                            
                      </div>
                    </div>
                    <div class="card-body">
                      <form>
                        <input type="hidden" name="schedule" value="{{$schedule}}"/>
                        <div class="form-group">
                          <label>Filter By Date</label>
                          <div class="d-flex ">
                            <select name="date_filter" class="form-control col-md-5"> 
                              @foreach ($uniqueBDates as $date)
                                <option value="{{$date}}">{{Carbon\Carbon::create($date)->isoFormat("DD-MM-YYYY")}}</option>
                              @endforeach
                            </select>&emsp;
                            <button class="btn btn-outline-primary btn-lg filter-date">Filter</button>
                          </div>
                        </div>
                      </form>
                        {{ $dataTable->table() }}
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
      $("form").submit(function (e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.ajax({
          type: "GET",
          url: "{{route('admin.schedule.filter-schedule')}}",
          data: data,
          dataType: "JSON",
          success: function (data) {
            console.log(data);
          },
        });
      });
    });
  </script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush