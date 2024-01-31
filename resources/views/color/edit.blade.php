@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit color</h1>
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
    <section class="h-custom py-3" id="">

        <div class="row align-items-start ml-3">
            <div class="col-6 rounded-10">
                <form action="{{route('color.update', $color->id)}}" class="bg-gray-dark rounded-10"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="Category">Category</label>
                            <input type="text" class="form-control " name="title"
                                   value="{{$color->title}}">
                            @error('title')
                            <div class="alert alert-danger">This field is required.</div>
                            @enderror
                        </div>
                        <div class="border-dark">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
