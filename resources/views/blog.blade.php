@extends('layouts.app')

@section('title','Blog')

@section('content')
<blog-nav :blogs="{{ $blogs }}"></blog-nav>
@endsection

@section('footer')

@include('layouts.footer')

@endsection