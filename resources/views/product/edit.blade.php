@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit product</h1>
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
    <section class="h-custom w-75 m-5 rounded shadow bg-gray">
        <div class="card-header bg-warning w-100">
            <h3 class="card-title">Product update <small>form</small></h3>
        </div>
        <div class="row  align-items-start justify-content-start ">
            <div class="col-10 ">
                <form action="{{route('product.update', $product->id)}}" method="POST" class=" " novalidate
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body ">
                        <div class="form-group w-50">
                            <label>Title</label>
                            <input type="text" class="form-control fw-bolder" name="title" value="{{$product->title}}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Price</label>
                            <input type="text" class="form-control fw-bolder" name="price" value="{{$product->price}}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Old Price</label>
                            <input type="text" class="form-control fw-bolder" name="old_price" value="{{$product->old_price}}">
                            @error('old_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Count</label>
                            <input type="number" class="form-control fw-bolder" name="count" value="{{$product->count}}">
                            @error('count')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea  class="form-control" rows="5" name="description">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea  class="form-control" rows="5" name="content">{{$product->content}}</textarea>
                        </div>
                        <div class="form-group w-50" data-select2-id="95">
                            <label class="form-label">Category</label>
                            <select class="form-control select2 " style="width: 100%;"
                                    aria-hidden="true" name="category_id">
                                @foreach($categories as $category)
                                    <option
                                        {{$category->id === $product->category->id ? 'Not selected' : ''}}
                                        value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label>Tags</label>
                            <select class="tags" name="tag_ids[]" multiple="multiple"
                                    data-placeholder="select tags" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option {{is_array($product->tags->pluck('id')->toArray()) &&
                                         in_array($tag->id, $product->tags->pluck('id')->toArray()) ?
                                          'selected' : ''}} value="{{$tag->id}}">
                                    {{$tag->title}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-50">
                            <label>Colors</label>
                            <select class="colors" name="color_ids[]" multiple="multiple"
                                    data-placeholder="select colors" style="width: 100%;">
                                @foreach($colors as $color)
                                    <option {{is_array($product->colors->pluck('id')->toArray()) &&
                                         in_array($color->id, $product->colors->pluck('id')->toArray()) ?
                                          'selected' : ''}} value="{{$color->id}}">
                                        {{$color->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="product-image-thumb">
                            <img src="{{url('storage/' . $product->preview_image)}}" alt="Product image" s>
                        </div>
                        <div class="form-group w-50">
                            <label>File input</label>
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
