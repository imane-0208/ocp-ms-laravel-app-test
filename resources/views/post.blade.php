@extends('layouts.app')

@section('content')
    <div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
        @endif
        @if ($errors->has('content'))
            <div class="alert alert-danger">{{ $errors->first('content') }}</div>
        @endif
    </div>


    <div class="container">

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <img src="{{ asset($post->img_path) }}" alt="" class="card-img-top">
                    <div class="card-body">
                        <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp" alt="avatar"
                                width="40" height="40" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-primary fw-bold mb-0">
                                        {{ $post->user->name }}
                                    </h6>

                                </div>
                            </div>
                            <div class="d-flex flex-end ms-auto">
                                @if ($post->user->id == Auth::user()->id)
                                    <form action="{{ route('post.delete', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 btn text-danger"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg></button>
                                    </form>
                                    <a href="#!" onclick="editPost()" class="btn text-success p-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg></a>
                                @endif

                            </div>
                        </div>

                        <h5 class="card-title ms-15 ">{{ $post->name }}</h5>
                        <p class="card-text ms-15">{{ $post->description }}</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div id="editPostForm" class="container px-20" style="display: none">
        <div class="row">
            <div class="col-lg-12 mb-12 ">
                <div class="card p-17">
                    <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class=" mb-3 ">
                            <label for="nompartenaire" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nompartenaire" name="name"
                                value="{{ $post->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="nompartenaire" class="form-label">Description</label>
                            <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="description">{{ $post->description }}</textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <div class="">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light p-2">
        <form action="{{ route('comment.store') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="d-flex flex-row align-items-start">
                <textarea style="height: 60px" class="form-control ml-1 shadow-none textarea" name="content"></textarea>
            </div>
            <button class="text-end mt-3 btn btn-primary btn-sm shadow-none" type="submit">Post comment <span><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-send" viewBox="0 0 16 16">
                        <path
                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                    </svg></span></button>
        </form>
    </div>
    <br>
    <br>

    {{-- {{dd($post)}} --}}
    @foreach ($post->comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-start">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp" alt="avatar" width="40"
                        height="40" />
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-primary fw-bold mb-0">
                                {{ $comment->user->name }}
                                <span class="text-dark ms-2">{{ $comment->content }}</span>
                            </h6>
                            <p class="mb-0">{{ $comment->created_at }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="small mb-0" style="color: #aaa;">
                                @if ($comment->user->id == Auth::user()->id)
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger mt-4 me-3">Remove</button>
                                    </form>
                                    <button href="#!" onclick="editComment({{ $comment->id }})"
                                        class="btn btn-link text-success me-3">Edit</button>
                                @endif
                            <form action="{{ route('reply.store') }}" method="post">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" placeholder="Reply" name="content">
                                    <button class="btn btn-primary btn-sm shadow-none" type="submit"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                            <path
                                                d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                        </svg></button>
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            </form>

                            </p>

                        </div>
                    </div>
                </div>
                <br>
                <form id="editCommentForm{{ $comment->id }}" style="display: none"
                    action="{{ route('comment.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex">
                        <input type="text" class="form-control" placeholder="" name="content"
                            value="{{ $comment->content }}">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-send" viewBox="0 0 16 16">
                                <path
                                    d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                            </svg></button>
                    </div>
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                </form>
            </div>
        </div>
        @if (count($comment->replies) > 0)
            @foreach ($comment->replies as $reply)
                <div class="card mb-3 ms-20">
                    <div class="card-body p-5">
                        <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp" alt="avatar"
                                width="40" height="40" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-primary fw-bold mb-0">
                                        {{ $reply->user->name }}
                                        <span class="text-dark ms-2">{{ $reply->content }}</span>
                                    </h6>
                                    <p class="mb-0">{{ $reply->created_at }}</p>
                                </div>
                                <div class="d-flex  align-items-center">
                                    <p class="small mb-0" style="color: #aaa;">
                                        @if ($reply->user->id == Auth::user()->id)
                                            <form action="{{ route('reply.delete', $reply->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link link-danger mt-4 me-3">Remove</button>
                                            </form>
                                            <a href="#!" onclick="editReply({{ $reply->id }})"
                                                class="btn text-success me-3">Edit</a>
                                        @endif
                                    </p>
                                </div>

                            </div>
                        </div>
                        <form id="editReplyForm{{ $reply->id }}" style="display: none"
                            action="{{ route('reply.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" placeholder="" name="content"
                                    value="{{ $reply->content }}">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                        <path
                                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                    </svg></button>
                            </div>
                            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
@endsection

<script>
    //disply edit form for comment
    function editComment(id) {

        var x = document.getElementById("editCommentForm" + id);
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    //disply edit form for reply
    function editReply(id) {

        var x = document.getElementById("editReplyForm" + id);
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    //disply edit form for reply
    function editPost() {

        var x = document.getElementById("editPostForm");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
