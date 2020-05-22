@extends('layouts.app')

@section('title','Portfolio')

@section('content')

<display-projects :project_categories="{{ $project_categories }}"></display-projects>

@endsection

@section('footer')

@include('layouts.footer')

@endsection