@extends('layouts.auth')

@section('signup')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/login.css">
    <title>KULAKU</title>
    <font></font>
  </head>
  <body>
    <div class="flex">
        <div class="container">
            <div class="header">
                <div class="arrow">
                    <a href=""><img src="/assets/arrow-left.png" alt="arrow-left"></a>
                </div>
            </div>

            <div class="space"></div>
            <div class="flex">
                <img src="/assets/logo.png" alt="Logo KULAKU">
            </div>  
            
            <form action="{{ route('signup') }}" method="post" class="form-login">
                @csrf
                <div class="form-group has-feedback @error('email') has-error @enderror">
                    <input type="email" name="email" class="username" placeholder="    Enter Email" required value="{{ old('email') }}" autofocus>
                    @error('email')
                        <span class="help-block">{{ $message }}</span>
                    @else
                        <span class="help-block with-errors"></span>
                    @enderror
                </div>
                    
                <div class="form-group has-feedback @error('password') has-error @enderror">    
                    <input type="password" name="password" class="password" placeholder="    Enter Password" required>
                    @error('password')
                        <span class="help-block">{{ $message }}</span>
                    @else
                        <span class="help-block with-errors"></span>
                    @enderror
                </div>
                <div class="space-1"></div>
                    <div class="submit" link="">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        
                        <div class="space-2"></div>
                        <div class="text">
                            Belum memiliki Akun? <a href="">Daftar</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        </div>
    </div>
        
    </div>
  </body>
</html>
@endsection