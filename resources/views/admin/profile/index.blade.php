@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ $user->first_name }}</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset($user->avatar) }}"
                                class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Email</div>
                                    <div class="profile-widget-item-value">{{ $user->email }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Phone</div>
                                    <div class="profile-widget-item-value">{{ $user->phone }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Address</div>
                                    <div class="profile-widget-item-value">{!! $user->address !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $fullName }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div>{{ Auth::user()->role }}
                                </div>
                            </div>
                            {!! $user->description !!}
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form enctype="multipart/form-data" action="{{ route('admin.profile.profile-update') }}"
                            method="post" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="rounded-circle mb-5" width="200" src="{{ asset("$user->avatar") }}"
                                            alt="avatar" />
                                    </div>
                                    <div class="form-group col-12">
                                        <input class="form-control" name="avatar" type="file" />
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4 col-12">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control"
                                            value="{{ $firstName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Middle Name</label>
                                        <input name="middle_name" type="text" class="form-control"
                                            value="{{ $middleName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the middle name
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control"
                                            value="{{ $lastName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>

                                    </div>


                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control"
                                            value="{{ $user->email }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Select</label>
                                        <select name="gender" class="form-control">
                                            <option value="1" {{ $user->gender == 1 ? 'selected' : ' ' }}>Male
                                            </option>
                                            <option value="0" {{ $user->gender == 0 ? 'selected' : ' ' }}>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control summernote-simple">
                                    {{ $user->address }}
                                </textarea>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control summernote-simple">
                                        {{ $user->description }}
                                    </textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form enctype="multipart/form-data" action="{{ route('admin.profile.password-update') }}"
                            method="post" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Update Password</h4>

                            </div>

                            <div class="card-body">
                                <div class="row">


                                    <div class="form-group col-md-12 col-12">
                                        <label>Current Password</label>
                                        <input name="current_password" type="password" class="form-control"
                                            placeholder="Enter your current password" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>New Password</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="Enter new password" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>Password Confirmation</label>
                                        <input name="password_confirmation" type="password"
                                            placeholder="Password confirmation" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password confirmation
                                        </div>

                                    </div>


                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
