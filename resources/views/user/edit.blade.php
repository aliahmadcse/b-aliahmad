@extends('layouts.app')

@section('title','Edit User')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0">
            <div class="card-header text-center">{{ __('Update User') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('user.update',auth()->user()->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name',$user->name) }}" required autocomplete="name"
                                autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex justify-content-center">
                        <img class="img-fluid rounded-circle" style="max-width: 200px;max-height:200px"
                            src="{{ $user->avatar }}" alt="Avatar">
                    </div>

                    <div class="form-group row">
                        <label for="avatar"
                            class="col-md-4 col-form-label text-md-right">{{ __('Update Avatar') }}</label>

                        <div class="col-md-6">
                            <input id="avatar" type="file" class="custom-file @error('avatar') is-invalid @enderror"
                                name="avatar" accept="image/png, image/jpeg, image/jpg">

                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')

@include('layouts.footer')

@endsection