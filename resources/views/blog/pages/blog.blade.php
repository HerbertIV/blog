@extends('blog.layouts.app')
@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-preview">
                    <h2 class="post-title">{{ $blog->title }}</h2>
                    <div>
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
