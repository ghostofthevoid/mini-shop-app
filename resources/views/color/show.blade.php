@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <a class="btn btn-app" href="{{route('color.edit', $color->id)}}"><i class="fas fa-edit"></i>
                        Edit</a>
                    <form action="{{route('color.delete',  $color->id)}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-app">
                            <i class="fas fa-solid fa-trash text-danger"></i>Delete
                        </button>
                    </form>
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
    <div class="card col-7 mx-3 shadow">
        <div class="row align-items-start justify-content-center ">
            <div class=" card-body table-responsive rounded-10">
                <table class="table table-hover text-nowrap " style="text-align: center">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{$color->id}}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{$color->title}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
