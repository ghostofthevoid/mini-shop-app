@extends('layouts.main')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="col-1 mb-3">
                <a href="{{route('tag.create')}}" class="btn btn-block btn-primary ">Add</a>
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
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->title}}</td>
                                        <td><a href="{{route('tag.show', $tag->id)}}" class="text-indigo"><i
                                                    class="fas fa-regular fa-eye"></i></a></td>
                                        <td><a href="{{route('tag.edit', $tag->id)}}"
                                               class="text-success"><i class="fas fa-solid fa-pen"></i></a></td>

                                        <td>
                                            <form action="{{route('tag.delete',  $tag->id)}}" method="POST">
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
                        {{$tags->links()}}
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
