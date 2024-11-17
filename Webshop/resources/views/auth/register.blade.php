@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="form_area">
    <p class="title">SIGN UP</p>
    <form action="/register" method="POST">
        @csrf
        <input class="form_style" type="text" name="name" placeholder="Enter your full name">
        <input class="form_style" type="email" name="email" placeholder="Enter your email">
        <input class="form_style" type="password" name="password" placeholder="Enter your password">
        <div class="form_group">
            <label class="sub_title" for="address">Address</label>
            <input placeholder="Enter your address" name="address" id="address" class="form_style" type="text">
        </div>
        
        <div class="form_group">
            <label class="sub_title" for="phone">Phone Number</label>
            <input placeholder="Enter your phone number" name="phone" id="phone" class="form_style" type="text">
        </div>
        
        <div class="form_group">
            <label class="sub_title" for="postal_code">Postal Code</label>
            <input placeholder="Enter your postal code" name="postal_code" id="postal_code" class="form_style" type="text">
        </div>
        
        <button class="btn">SIGN UP</button>
    </form>
    
    <p>Have an Account? <a href="/login">Login Here!</a></p>
</div>
@endsection
