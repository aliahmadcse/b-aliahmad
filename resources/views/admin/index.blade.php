@extends('layouts.app')

@section('title','Admin')

@section('content')

<admin-navbar :projects="{{ $project_categories }}"></admin-navbar>

@endsection