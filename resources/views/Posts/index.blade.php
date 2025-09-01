@extends('layouts.master')

@section('content')
<div class="container">
    <!-- Background Video - Fixed Position -->
    <div class="video-background">
        <video autoplay loop muted playsinline class="background-video">
            <source src="https://res.cloudinary.com/ddhaiaedw/video/upload/v1756523994/9318020-uhd_2560_1440_24fps_qwdwiv.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Content with proper z-index -->
    <div class="content-wrapper">
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
</div>

<style>
    /* Ensure the video stays in the background */
    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }
    
    .background-video {
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    /* Ensure content stays above the video */
    .content-wrapper {
        position: relative;
        z-index: 1;
        background-color: rgba(255, 255, 255, 0.9); /* Slight overlay for readability */
    }
</style>
@endsection