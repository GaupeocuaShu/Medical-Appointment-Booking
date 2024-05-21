@extends('frontend.layout.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <h3 style="margin: 20px 0">Thông Tin Cá Nhân</h3>
                    <div>
                        <button onclick="window.location.href='/'">Trở lại</button>
                    </div>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Mã bệnh nhân</th>
                            <td>{{ $user->patient->patient_id }}</td>
                        </tr>
                        <tr>
                            <th>Tên Đầy Đủ</th>
                            <td>{{ getFullName($user) }}</td>
                        </tr>
                        <tr>
                            <th>Ngày Sinh</th>
                            <td>{{ Carbon\Carbon::create($user->date_of_birth)->isoFormat('DD/MM/YYYY') }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Giới Tính</th>
                            <td>{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Thông Tin Cá Nhân --}}
            <div style="margin: 40px 0">

                <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST">
                    @method('PUT')
                    @csrf

                    <h3 style="margin: 20px 0">Thay Đổi Thông Tin Cá Nhân</h3>
                    <div class="col-md-3" style="overflow: hidden">
                        <img src="{{ asset($user->avatar) }}" class="profile-img mb-3 " style="border-radius: 100%"
                            width="200" alt="Avatar">
                        <input name="avatar" type="file" class="form-control-file mb-3">
                    </div>
                    <div class="col-md-9">
                        @if ($errors->any())
                            <div class="row"
                                style=" border-radius:5px;margin:20px 0;background-color: rgba(222, 145, 145, 0.47);padding:10px">
                                @foreach ($errors->all() as $err)
                                    <h5 style="color: rgb(169, 24, 24)">{{ $err }}</h5>
                                @endforeach
                            </div>
                        @endif
                        @if (Session::has('status'))
                            <div class="row"
                                style=" border-radius:5px;margin:20px 0;background-color: rgba(52, 176, 65, 0.47);padding:10px">
                                <h5 style="color: rgb(30, 105, 52)">{{ session('status') }}</h5>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="userName">Họ</label>
                                <input value="{{ $user->last_name }}" name="last_name" type="text" class="form-control"
                                    id="userName" placeholder="Tên Người Dùng">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="userName">Tên Đệm</label>
                                <input value="{{ $user->middle_name }}" name="middle_name" type="text"
                                    class="form-control" id="userName" placeholder="Tên Người Dùng">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="userName">Tên</label>
                                <input value="{{ $user->first_name }}" name="first_name" type="text"
                                    class="form-control" id="userName" placeholder="Tên Người Dùng">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Ngày Sinh: </label>
                            <input value="{{ $user->date_of_birth }}" name="date_of_birth" type="date"
                                class="form-control" id="userEmail" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email:</label>
                            <input value="{{ $user->email }}" name="email" type="email" class="form-control"
                                id="userEmail" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="userPhone">Số điện thoại:</label>
                            <input value="{{ $user->phone }}" name="phone" type="text" class="form-control"
                                id="userPhone" placeholder="0123456789">
                        </div>
                        <div class="form-group">
                            <label for="userPhone">Địa chỉ</label>
                            <input value="{{ $user->address }}" name="address" type="text" class="form-control"
                                id="userPhone" placeholder="2D Tân Trang">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Giới Tính</label>
                            <select name="gender" class="form-control" id="exampleFormControlSelect1">
                                <option {{ $user->gender == 1 ? 'selected' : '' }} value="1">Nam</option>
                                <option {{ $user->gender == 0 ? 'selected' : '' }} value="0">Nữ</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Mật Khẩu --}}
        <br>
        <div style="margin: 40px 0">
            <form enctype="multipart/form-data" action="{{ route('profile.password-update') }}" method="POST">
                @method('PUT')
                @csrf
                <h3 style="margin: 20px 0">Thay Đổi Mật Khẩu</h3>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Mật Khẩu Hiện Tại</label>
                        <input class="form-control" type="password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label>Mật Khẩu Mới</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Nhập Lại Mật Khẩu Mới</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
