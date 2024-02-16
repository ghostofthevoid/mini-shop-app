@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="col-1 mb-3 mt-3">
                <a href="{{route('product.create')}}" class="btn btn-block btn-primary ">Add</a>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->title}}</td>
                                        <td><a href="{{route('product.show', $product->id)}}" class="text-indigo"><i
                                                    class="fas fa-regular fa-eye"></i></a></td>
                                        <td><a href="{{route('product.edit', $product->id)}}"
                                               class="text-success"><i class="fas fa-solid fa-pen"></i></a></td>

                                        <td>
                                            <form action="{{route('product.delete',  $product->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-transparent">
                                                    <i class="fas fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
