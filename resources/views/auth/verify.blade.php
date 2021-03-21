@extends('layouts.frontend.app')
@section('title','Verify Your Email Address')
@push('css')
@endpush

@section('content')
<section class="page-not-found pt-90 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h2>Verify Your Email Address</h2>
            </div>
            <div class="col-md-6">
                <div class="box-shadow login_register_box">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js') 
@endpush
