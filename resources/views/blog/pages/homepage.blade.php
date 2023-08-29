@extends('blog.layouts.app')
@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach($blogs as $blog)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{ route('blog-blogs.show', ['blog' => $blog->getKey()]) }}">
                            <h2 class="post-title">{{ $blog->title }}</h2>
                            <h3 class="post-subtitle">{{ $blog->short }}</h3>
                        </a>
                        <p class="post-meta">
                            {{ \Illuminate\Support\Carbon::make($blog->created_at)->format('Y-m-d') }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
                <!-- Divider-->
                <hr class="my-4" />
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
            </div>
        </div>
    </div>
@endsection
