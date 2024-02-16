@extends('layouts.main')
@section('content')


    <!-- Main content -->
    <section class="h-custom py-3" id="">

        <div class="row align-items-start ml-3">
            <div class="col-6 rounded-10">
                <form action="{{route('category.update', $category->id)}}" class="bg-gray-dark rounded-10"
                      method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="Category">Category</label>
                            <input type="text" class="form-control " name="title"
                                   value="{{$category->title}}">
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
