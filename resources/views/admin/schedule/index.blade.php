
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
                        <div class="form-group">
                          <label>Filter By Date</label>
                          <div class="d-flex ">
                            <select name="date_filter" class="filter form-control col-md-5"> 
                              @foreach ($uniqueBDates as $date)
                                <option value="{{$date}}">{{Carbon\Carbon::create($date)->isoFormat("DD-MM-YYYY")}}</option>
                              @endforeach
                            </select>&emsp;
                            <span class="btn btn-outline-primary btn-lg filter-date">Filter</span>&emsp;
                            <span class="btn btn-outline-danger btn-lg reset-filter-date">Reset</span>

                          </div>
                        </div>
                        {{ $dataTable->table() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
  </section>
    
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  <script> 
    $(document).ready(function() {
      $(".filter-date").on("click",function () {
        const date =$(".filter").val();
        const table = $("table").DataTable();
        table.search(date).draw();
      });
      $(".reset-filter-date").on("click",function(){
        const table = $("table").DataTable();
        table.search("").draw();
      })
    });
  </script>
@endpush