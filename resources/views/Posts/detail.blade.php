@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-lg-10">

            <div class="video-background mb-4">
                <video autoplay loop muted>
                    <source src="https://res.cloudinary.com/ddhaiaedw/video/upload/v1756523994/9318020-uhd_2560_1440_24fps_qwdwiv.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <h1 class="mb-3">{{ $post->title }}</h1>
            <p class="text-muted">{{ $post->created_at->format('F j, Y') }}</p>

            {{-- Centered image --}}
            <div class="d-flex justify-content-center mb-4">
                <img src="{{ $post->img_url }}"
                     class="img-fluid"
                     style="max-width:700px; width:100%; height:auto;"
                     alt="Blog Image">
            </div>

            {{-- Wide filled text box (almost full width) placed BELOW the image --}}
            @if ($post->video_url)
                <div class="mx-auto mb-4" style="width:95%; max-width:1400px;">
                    <div class="video-box bg-light border rounded p-4">
                        @php
                            // Normalize and trim
                            $raw = trim($post->video_url);

                            // Split into paragraphs by two-or-more newlines first.
                            $paragraphs = preg_split('/\r?\n\s*\r?\n/', $raw);

                            // If only one paragraph found, fall back to splitting by single newline
                            if (count($paragraphs) === 1) {
                                $paragraphs = preg_split('/\r?\n/', $raw);
                            }

                            // Clean up empty lines
                            $paragraphs = array_values(array_filter(array_map('trim', $paragraphs), function($v) {
                                return $v !== '';
                            }));
                        @endphp

                        @foreach ($paragraphs as $p)
                        @php
                            // Escape first
                            $escaped = e($p);

                            // Highlight keywords
                            $highlighted = preg_replace(
                                '/\((Maksud|Fadhilat|Cara untuk memperolehnya)\)/i',
                                '<strong>($1)</strong>',
                                $escaped
                            );
                        @endphp
                        <p class="video-paragraph">{!! $highlighted !!}</p>
                    @endforeach
                    </div>
                </div>
            @endif

            {{-- Main content (below the wide box) --}}
            <div class="mb-5" style="width:95%; max-width:1200px;">
                <p style="text-align:justify; line-height:1.7;">{{ $post->content }}</p>
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="col-11 col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Related Posts</h5>
                    <ul class="list-unstyled">
                        <li><a href="./detail.html">Post 1</a></li>
                        <li><a href="./detail.html">Post 2</a></li>
                        <li><a href="./detail.html">Post 3</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Local styles for justification (put into your main stylesheet if you prefer) --}}
<style>
.video-box {
  white-space: normal;             /* allow normal wrapping so justification works */
  line-height: 1.7;
  text-align: justify;
  text-justify: inter-word;
  -webkit-hyphens: auto;
  -moz-hyphens: auto;
  hyphens: auto;
  -webkit-font-smoothing: antialiased;
  box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

/* Make each paragraph justified with consistent spacing */
.video-box .video-paragraph {
  margin-bottom: 1rem;
  text-align: justify;
  text-justify: inter-word;
  hyphens: auto;
}

/* Trick to make the last line stretch similarly, reducing raggedness */
.video-box:after {
  content: "";
  display: inline-block;
  width: 100%;
}

/* Mobile: avoid large gaps from justification on very small screens */
@media (max-width: 576px) {
  .video-box, .video-box .video-paragraph {
    text-align: left;
    text-justify: auto;
  }
}
</style>

@endsection
