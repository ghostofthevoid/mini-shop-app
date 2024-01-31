@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
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

    {{--main section--}}
    <div class="content-wrapper ml-3 shadow" style="min-height: 1604.44px;">
        <section class="content ">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{$product->title}}</h3>
                            <div class="col-12">
                                <img src="{{url('storage/' . $product->preview_image)}}" class="product-image"
                                     alt="Product Image" style="height: 550px; width: 500px;">
                            </div>
                            <div class="container mt-3">
                                <h2>#Tags</h2>
                                @foreach($tags as $tag)
                                    @if(in_array($tag->id, $product->tags->pluck('id')->toArray()))
                                        <span class="badge  bg-info">#{{$tag->title}}</span>
                                    @else
                                        @continue
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-12 product-image-thumbs">
                                <div class="product-image-thumb active"><img
                                        src="{{url('storage/' . $product->preview_image)}}" alt="Product Image"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">{{$product->title}}</h3>
                            <p>{{$product->description}}</p>

                            <hr>
                            <h4>Available Colors</h4>
                            <div class="btn-group btn-group-toggle " data-toggle="buttons">

                                @if(isset($colors))

                                    @foreach($colors as $color)
                                        @if(in_array($color->id, $product->colors->pluck('id')->toArray()))
                                            <label class="btn btn-default text-center active ">
                                                <input type="radio" name="color_option" id="color_option_a1"
                                                       autocomplete="off" checked="">
                                                {{$color->title}}
                                                <br>
                                                <i class="fas fa-circle fa-2x "
                                                   style="color: {{strtolower($color->title) ?? 'white'}};"></i>
                                            </label>
                                        @else
                                            @continue
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="bg-gray py-2 px-3 mt-4 w-25">
                                <h2 class="mb-0">
                                    ${{$product->price}}
                                </h2>
                            </div>
                            <div class="bg-transparent mt-3 d-flex w-50 ">

                                <a href="{{route('product.edit', $product->id)}}" class="btn btn-app ml-0">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{route('product.delete',  $product->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-app">
                                        <i class="fas fa-solid fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                       href="#product-content" role="tab" aria-controls="product-comments"
                                       aria-selected="false">Content</a>
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                       href="#product-desc" role="tab" aria-controls="product-desc"
                                       aria-selected="true">Description</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="product-desc" role="tabpanel"
                                     aria-labelledby="product-desc-tab"> {{$product->description}}
                                </div>
                                <div class="tab-pane fade" id="product-content" role="tabpanel"
                                     aria-labelledby="product-comments-tab"> {{$product->content}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content -->
@endsection
