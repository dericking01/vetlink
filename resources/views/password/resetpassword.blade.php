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
    <form action="{{ route('resetpassword.post') }}" method="POST">
        @csrf
        <input type="text" name="token" hidden value="{{$token}}"
        <div class="container">
            <h2>Reset Your Password</h2>
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" id="email" placeholder="Enter your Email" required>
            <label for="email"><b>New Password</b></label>
            <input type="password" name="password" id="password" placeholder="Enter your Email" required>
            <label for="email"><b>Confirm New Password</b></label>
            <input type="password" name="password_confirmation" id="password" placeholder="Enter your Email" required>

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
