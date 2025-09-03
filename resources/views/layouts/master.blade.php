<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Inline Styles -->
    <style>
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Layout */
        main {
            flex: 1 0 auto;
            position: relative;
            z-index: 1;
        }
        
        /* Video background container */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            z-index: -1;
        }

        .video-background video {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }

        /* Content wrapper */
        .content-wrapper {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Make sure your content containers have transparent backgrounds */
        .container, .row, .col {
            background-color: transparent !important;
        }

        /* Image and overlay styles */
        .post-image-container {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .post-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scale(1.02);
        }

        .post-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            transition: opacity 0.3s ease;
        }

        .post-title-overlay {
            position: absolute;
            top: 25px;
            left: 25px;
            right: 25px;
            color: white;
            font-size: 1.25rem;
            font-weight: 500;
            text-shadow: 0 2px 4px rgba(0,0,0,0.7);
            z-index: 10;
            padding: 8px 16px;
            border-radius: 6px;
            font-family: "Inter", sans-serif;
            background: rgba(0, 0, 0, 0.5);
        }

        .post-content {
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            margin: 2rem auto;
            max-width: 56ch;
            font-weight: 400;
        }

        .post-content h3 {
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto;
            color: #000000;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .post-content p {
            font-size: 1.125rem;
            color: #363c43ff;
            margin-bottom: 1.5rem;
        }

        .read-more {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            z-index: 20;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 3px 6px rgba(0,0,0,0.9);
            opacity: 1;
            font-family: "Inter", sans-serif;
            padding: 10px 20px;
            transition: transform 0.3s ease;
        }

        .post-image-container:hover .read-more {
            transform: translate(-50%, -50%) scale(1.1);
        }

        .overlay-arrow {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 2rem;
            color: white;
            z-index: 20;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
            transform: none;
            left: auto;
            top: auto;
        }

        .post-image-container:hover .overlay-arrow {
            opacity: 1;
        }

        .post-image-container:hover .post-overlay {
            opacity: 0.7;
        }

        /* Sticky footer */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            left: 0;
            background: #000000ff; 
            color: #f5f5dc; 
            border-block-start: 1px solid #000000ff;
            font-family: Georgia, 'Times New Roman', serif;
            padding: 15px 0;
        }
    </style>
</head>
<body class="@yield('body-class')">
    <!-- Add the video background container -->
    <div class="video-background">
        <video autoplay loop muted playsinline class="background-video">
            <source src="https://res.cloudinary.com/ddhaiaedw/video/upload/v1756523994/9318020-uhd_2560_1440_24fps_qwdwiv.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Wrap content to ensure it appears above the video -->
   <div class="content-wrapper">
        @include('layouts.includes.header')

        <main class="flex-grow-1">
            @yield('content')
        </main>

        @include('layouts.includes.footer')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        function removeOverlay(element) {
            const overlay = element.querySelector('.post-overlay');
            if (overlay) overlay.style.opacity = '0';
        }
        
        function restoreOverlay(element) {
            const overlay = element.querySelector('.post-overlay');
            if (overlay) overlay.style.opacity = '1';
        }
    </script>
</body>
</html>