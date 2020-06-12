@extends('layouts.app')

@section('title','About')

@section('content')
<about-section :user="{{ $user }}"></about-section>
@endsection

@section('footer')

@include('layouts.footer')

@endsection