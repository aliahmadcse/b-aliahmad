@extends('layouts.app')

@section('title','Admin')

@section('content')

<admin-navbar :projects="{{ $projects }}"></admin-navbar>

@endsection