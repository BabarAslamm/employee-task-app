@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Organizations') }}</label>
                        </div>

                        {{-- Organizations --}}
                        <div class="row">
                        <div class="col-md-4"> </div>
                        <div class=" col-md-8">
                            <div class="row">
                                @foreach ($organizations as $organization)
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="organization_id" id="inlineRadio1" value="{{ $organization->id }}">
                                        <label class="form-check-label" for="inlineRadio1">{{ $organization->name }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('organization_id')
                            <span class="text-danger" role="">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        {{-- Roles --}}
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>
                        </div>
                        <div class="row">
                            <div class="col-md-4"> </div>
                            <div class=" col-md-8 mb-4">
                                <div class="row">
                                    @foreach ($roles as $role)
                                    <div class="col-md-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role_id" id="inlineRadio1" value="{{ $role->id }}">
                                            <label class="form-check-label" for="inlineRadio1">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('role_id')
                                <span class="text-danger" role="">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
