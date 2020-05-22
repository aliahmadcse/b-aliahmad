@extends('layouts.app')

@section('title','Admin')

@section('content')

<admin-navbar :project_categories="{{ $project_categories }}"></admin-navbar>

@endsection