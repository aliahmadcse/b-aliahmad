@extends('layouts.app')

@section('title','Portfolio')

@section('content')

<portfolio-main :projects="{{ $projects }}"></portfolio-main>

@endsection