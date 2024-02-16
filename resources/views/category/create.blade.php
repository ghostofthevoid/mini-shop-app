@extends('layouts.main')
@section('content')


    <!-- Main content -->
    <section class="h-custom py-3" id="">

        <div class="row align-items-start mx-3 ">
            <div class="col-6 rounded-10">
                <form action="{{route('category.store')}}" class="bg-info rounded-10" method="POST" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                   placeholder="Category name">
                            @error('title')
                            <div class="alert alert-danger">This field is required.</div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                </form>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
