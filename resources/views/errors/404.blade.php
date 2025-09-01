@extends('layouts.master')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-block-size: 100vh;
        }
        .error-container {
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .error-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            max-inline-size: 600px;
        }
        .error-number {
            font-size: 12rem;
            font-weight: 700;
            line-height: 1;
            background: linear-gradient(45deg, #4b6cb7 0%, #182848 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(75, 108, 183, 0.2);
        }
        .btn-home {
            background: linear-gradient(45deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(75, 108, 183, 0.3);
        }
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(75, 108, 183, 0.4);
            background: linear-gradient(45deg, #3a5aa0 0%, #152238 100%);
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center min-vh-100 p-4">
        <div class="error-container text-center">
            <div class="error-card p-5">
                <div class="mb-4">
                    <i class="bi bi-robot display-1 text-primary"></i>
                </div>
                <h1 class="error-number">404</h1>
                <h2 class="fw-bold mb-3">Oops! Page Not Found</h2>
                <p class="fs-5 text-muted mb-4">The page you're looking for doesn't exist or has been moved.</p>
                <a href="/" class="btn btn-home btn-lg">
                    <i class="bi bi-house-door me-2"></i>Back to Homepage
                </a>
            </div>
            <div class="mt-4 text-muted">
                <small>Check the URL or use the button above to navigate back</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

@endsection