@extends('layouts.auth.base')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('summernote/reset_password.css') }}">

</head>
<body>
    <form action="{{ route('forgotpwd') }}" method="POST">
        @csrf
        <div class="container">
            <h2>Reset Password</h2>
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" id="email" placeholder="Enter your Email" required>
            <div class="clearfix">
                <button type="submit" class="btn"><b>Submit</b></button>
            </div>
        </div>
    </form>

    <div class="youtubeBtn">
        <a href="{{ route('admin.login') }}">
            <span>Back to Login</span>
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
</body>
</html>

@endsection
