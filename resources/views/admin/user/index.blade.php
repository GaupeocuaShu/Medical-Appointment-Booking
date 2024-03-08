
@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">User</a></div>
              <div class="breadcrumb-item">Table</div>
            </div>
          </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>User Table</h4>
                      <div class="card-header-action">
                        <div class="input-group-btn">
                        </div>
                            
                      </div>
                    </div>
                    <div class="card-body">
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
@endpush