@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add product</h1>
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
    <section class="h-custom py-3">
        <div class="row  align-items-start justify-content-start ">
            <div class="col-10 mx-5 rounded-10">
                <form action="{{route('product.store')}}" method="POST" class="shadow bg-white" novalidate
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body ">
                        <div class="form-group w-50">
                            <label>Title</label>
                            <input type="text" class="form-control fw-bolder" name="title" value="{{ old('title') }}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Price</label>
                            <input type="text" class="form-control fw-bolder" name="price" value="{{ old('price') }}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Old Price</label>
                            <input type="text" class="form-control fw-bolder" name="old_price" value="{{ old('old_price') }}">
                            @error('old_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Count</label>
                            <input type="number" class="form-control fw-bolder" name="count" value="{{ old('count') }}">
                            @error('count')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea  class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea  class="form-control" rows="5" name="content">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group w-50" data-select2-id="95">
                            <label class="form-label">Category</label>
                            <select class="form-control select2 " style="width: 100%;"
                                    aria-hidden="true" name="category_id">
                                <option selected >Not selected</option>
                                @foreach($categories as $category)
                                    <option
                                        {{old('category_id') == $category->id ? 'selected': ''}}
                                        value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label>Tags</label>
                            <select class="tags" name="tag_ids[]" multiple="multiple"
                                    data-placeholder="select tags" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option
                                        {{is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'selected' : ''}} value="{{$tag->id}}">
                                        {{$tag->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label>Colors</label>
                            <select class="colors" name="color_ids[]" multiple="multiple"
                                    data-placeholder="select colors" style="width: 100%;">
                                @foreach($colors as $color)
                                    <option
                                        {{is_array(old('color_ids')) && in_array($color->id, old('color_ids')) ? 'selected' : ''}} value="{{$color->id}}">
                                        {{$color->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label>Preview Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="preview_image">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-50">
                            <label>Image 1</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_images[]">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-50">
                            <label>Image 2</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_images[]">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
