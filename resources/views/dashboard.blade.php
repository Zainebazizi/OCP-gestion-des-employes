@extends('layouts.app')
<style>
    .background{
        width: 100%;
        height: 100%;
        filter: blur(0px);
        margin-top: -20px;
    }
</style>
@section('content')
<img src="background.jpg" class="background" alt="User Image">
@endsection
