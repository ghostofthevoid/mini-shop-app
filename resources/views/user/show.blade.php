@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Information</h1>
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
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Name</h6></div>
                    <div class="col-sm-9 text-secondary">{{$user->name}}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Surname</h6></div>
                    <div class="col-sm-9 text-secondary">{{$user->surname}}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Age</h6></div>
                    <div class="col-sm-9 text-secondary">{{$user->age}}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Gender</h6></div>
                    <div class="col-sm-9 text-secondary"> {{$user->genderTitle}}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                    <div class="col-sm-9 text-secondary"> {{$user->email}}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                    <div class="col-sm-9 text-secondary">{{$user->address}}</div>
                </div>
                <hr>
                <div class="bg-transparent mt-3 d-flex w-50 ">
                    <a href="{{route('user.edit', $user->id)}}" class="btn btn-app ml-0">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{route('user.delete',  $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-app">
                            <i class="fas fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
