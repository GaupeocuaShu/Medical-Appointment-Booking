@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Post</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Post</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger"><i
                                    class="fa-solid fa-right-from-bracket"></i></a>
                            &emsp;
                            <h4>Creator {{ $post->user->doctor->academic_degree . ' ' . getFullName($post->user) }}</h4>
                        </div>
                        <div class="card-body">
                            {!! $post->content !!}
                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger"><i
                                    class="fa-solid fa-right-from-bracket"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
