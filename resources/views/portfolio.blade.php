@extends('layouts.app')

@section('title','Portfolio')

@section('content')

<portfolio-main :projects="{{ $projects }}"></portfolio-main>

@endsection

@section('footer')

@include('layouts.footer')

@endsection