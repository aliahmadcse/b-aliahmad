@extends('layouts.app')

@section('title','Portfolio')

@section('content')

<portfolio-main :project_categories="{{ $project_categories }}"></portfolio-main>

@endsection

@section('footer')

@include('layouts.footer')

@endsection