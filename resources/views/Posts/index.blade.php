@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Background Video -->
    <div class="video-background">
        <video autoplay loop muted>
            <source src="https://res.cloudinary.com/ddhaiaedw/video/upload/v1756523994/9318020-uhd_2560_1440_24fps_qwdwiv.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Rest of your content -->
    <div class="row justify-content-center g-4">
        <div class="col-12 mx-auto" style="max-inline-size: 1200px;">
            <div class="row my-4">
                <div class="col text-center">
                    <h2>6 SIFAT PARA SAHABAT</h2>
                </div>
            </div>

            @if ($posts && $posts->count())
                @php
                    $chunks = $posts instanceof \Illuminate\Pagination\LengthAwarePaginator
                              ? $posts->getCollection()->chunk(2)
                              : $posts->chunk(2);
                @endphp

               @foreach($chunks as $chunk)
                    <div class="row justify-content-center g-4 mb-5">
                        @foreach($chunk as $post)
                            <div class="col-md-5 col-sm-10">
                                <a href="{{ route('post.detail', ['slug' => $post->slug]) }}" class="text-decoration-none">
                                    <div class="post-image-container" 
                                        onmouseenter="removeOverlay(this)" 
                                        onmouseleave="restoreOverlay(this)">
                                        <img src="{{ trim($post->img_url) }}" alt="{{ $post->title }}" class="post-image">
                                        <div class="post-overlay"></div>
                                        <div class="post-title-overlay">{{ $post->title }}</div>
                                        <div class="read-more">Read More</div>
                                        <i class="bi bi-arrow-right-circle overlay-arrow"></i>
                                    </div>
                                </a>
                                <div class="post-content">
                                    <h3 class="h5 mb-3">{{ $post->title }}</h3>
                                    <p class="custom-post-text">{{ $post->text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @if (method_exists($posts, 'links'))
                    <div class="row">
                        <div class="col text-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @endif
            @else
                <p class="text-center">No posts found.</p>
            @endif
        </div>
    </div>
</div>
@endsection