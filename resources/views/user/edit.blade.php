@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit user form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-wrapper">
        <section class="h-custom py-3" id="">
            <div class="card card-primary w-75 shadow">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('user.update', $user->id)}}" novalidate method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                   value="{{$user->name ?? old('name') }}">
                            @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" placeholder="Surname"
                                   value="{{$user->surname ?? old('surname') }}">
                        </div>
                        <div class="form-group w-25">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Age"
                                   value="{{$user->age ?? old('age') }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                   value="{{$user->address ?? old('address') }}">
                        </div>
                        <div class="form-group w-25">
                            <select name="gender" class="custom-select form-control">
                                <option disabled selected>Gender</option>
                                <option {{$user->gender == 1 || old('gender') == 1 ? 'selected' : ''}} value="1">Male</option>
                                <option {{$user->gender == 2 || old('gender') == 2 ? 'selected' : ''}} value="2">Female</option>
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
