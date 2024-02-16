@extends('layouts.main')
@section('content')

    <!-- Main content -->
    <div class="content-wrapper">
        <section class="h-custom py-3" id="">
            <div class="card card-primary w-75 shadow">
                <div class="card-header">
                    <h3 class="card-title">Add User <small>form</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('user.store')}}" novalidate method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                   value="{{ old('name') }}" required>
                            @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" placeholder="Surname"
                                   value="{{ old('surname') }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                   value="{{ old('email') }}" required>
                            @error('email')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            @error('password')
                            <div class="alert alert-danger">This field is required.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirm Password" required>
                            @error('password_confirmation')
                            <div class="alert alert-danger">This field is required.</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Age"
                                   value="{{ old('age') }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                   value="{{ old('address') }}">
                        </div>
                        <div class="form-group w-25">
                            <select name="gender" class="custom-select form-control">
                                <option disabled selected>Gender</option>
                                <option {{old('gender') == 1 ? 'selected' : ''}} value="1">Male</option>
                                <option {{old('gender') == 2 ? 'selected' : ''}} value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- /.content -->
@endsection
