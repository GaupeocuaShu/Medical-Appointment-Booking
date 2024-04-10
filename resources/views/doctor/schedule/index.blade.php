@extends('doctor.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Doctor Schedule</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Doctor Schedule</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Doctor Schedule Table</h4>
                            <div class="card-header-action">
                                <div class="input-group-btn">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="my-3">
                                Doctor {{ getFullName($user) }}
                            </h4>
                            <form action="">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Filter By Date</label>
                                        <select name="date_filter" class="date-filter form-control ">
                                            <option selected value=""></option>
                                            @foreach ($uniqueBDates as $date)
                                                <option value="{{ $date }}">
                                                    {{ Carbon\Carbon::create($date)->isoFormat('DD-MM-YYYY') }}</option>
                                            @endforeach
                                        </select>&emsp;
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Filter By Status</label>
                                        <select name="status_filter" class="status-filter form-control ">
                                            <option selected value=""></option>
                                            <option value="canceled">Canceled</option>
                                            <option value="pending">Pending</option>
                                            <option value="confirmed">Confirmed</option>
                                            <option value="completed">Completed</option>
                                        </select>&emsp;
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <span class="btn btn-outline-primary btn-lg filter">Filter</span>&emsp;
                                    <span class="btn btn-outline-danger btn-lg reset-filter">Reset</span>
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $(".filter").on("click", function() {
                const date = $(".date-filter").val();
                const status = $(".status-filter").val();
                const table = $("table").DataTable();
                if (date && status)
                    table.search(date + " " + status).draw();


                else if (date) table.search(date).draw();
                else table.search(status).draw();
            });
            $(".reset-filter").on("click", function() {
                const table = $("table").DataTable();
                const date = $(".date-filter").val(" ");
                const status = $(".status-filter").val(" ");
                table.search("").draw();
            })
        });
    </script>
@endpush
