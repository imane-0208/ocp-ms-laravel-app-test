@extends('layouts.app')

@section('content')
    <div class="container">


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Post
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Partenaires</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">
                            {!! csrf_field() !!}
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <div class="mb-3">
                                <label for="nompartenaire" class="form-label">Name</label>
                                <input type="text" class="form-control" id="nompartenaire" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="nompartenaire" class="form-label">Description</label>
                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="nompartenaire" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" name="img_path">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div style="height:300px; width:100%;"><img src="{{ asset($post->img_path) }}"
                                style="height:100%; width:100%; object-fit:cover"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->name }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <a href="{{ route('post', $post->id) }}" class="btn btn-success btn-sm">More Details</a>
                            <a href="" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-heart"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    </div>
@endsection
