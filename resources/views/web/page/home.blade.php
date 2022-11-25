@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.home'))

<?php
$homepage = $page['homepage'] ?? [];
?>

@section('css')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #landing {
            background: url("{{ isset($homepage['landingpage_background']) ? asset($homepage['landingpage_background']) : asset('assets/cms/images/no-img.png') }}");
            background-size: cover;
            min-height: 100vh;
        }

        #home {
            background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .4)), url("{{ isset($homepage['homepage_background']) ? asset($homepage['homepage_background']) : asset('assets/cms/images/no-img.png') }}");
            background-size: cover;
            min-height: 100vh;
        }

        .title {
            font-size: 3.5rem;
            line-height: 5.5rem;
        }

        .title2 {
            font-size: 3.5rem;
            line-height: 5.5rem;
            color: #FFC65A !important;
        }

        .content {
            font-size: 1rem;
            text-align: justify;
        }

        .subtitle {
            color: #74A8F9;
        }

        .title3 {
            color: #FFC65A;
        }

        .form-control {
            border-radius: 10px;
        }

        .card-body {
            color: #CDCDCD;
        }

        #sub {
            border-radius: 30px;
            font-size: 1.5rem;
        }

        #contact, #about {
            margin-top: 5rem;
        }

        input[type="text"], input[type="email"], textarea
        {
            background: transparent !important;
            color: white !important;
        }
    </style>
@stop

@section('content')
    <section id="landing" class="d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="text-white title">{!! $homepage['landingpage_title'] ?? 'Landing Page Title' !!}</h1>
            <br />
            <a href="{{ route('product-category') }}" class="btn btn-warning px-4 py-3" style="border-radius: 30px">
                Our Product <i class="pl-1 fa fa-arrow-right fa-lg"></i>
            </a>
        </div>
    </section>
    <section id="home" class="d-flex align-items-center">
        <div class="text-white col-lg-9 px-5 content">
            <h2 class="text-white title">{{ $homepage['homepage_title'] ?? 'Homepage Title' }}</h2>
            {!! $homepage['homepage_content'] ?? 'Homepage Content' !!}
        </div>
    </section>
    <section id="about" class="pr-md-3 pl-3 pl-md-0 mb-4">
        <div class="row text-white">
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <img src="{{ $homepage['about_image'] ?? asset('assets/cms/images/no-img.png') }}"
                    class="img-responsive img-fluid w-75 h-100" alt="About Logo" />
            </div>
            <div class="col-md-7 content">
                <h2 class="text-white title2">{!! $homepage['about_title'] ?? 'About Title' !!}</h2>
                {!! $homepage['about_content'] ?? 'About Content' !!}
            </div>
        </div>
    </section>
    <section id="contact" class="row text-white">
        <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ $homepage['contact_logo'] ?? asset('assets/cms/images/no-img.png') }}"
                class="img-responsive img-fluid w-75 h-100 mb-3" alt="About Logo" />
                <div class="w-75">
                    <h3 class="subtitle">{{ $homepage['contact_name'] ?? 'Contact Title' }}</h3>
                    {!! $homepage['contact_details'] ?? 'Contact Details' !!}
                </div>
        </div>
        <div class="col-md-7 pl-4 pl-md-0 pr-md-4">
            <div class="card-body">
                <h2 class="text-center title3">{{ $homepage['contact_title'] ?? "Contact Title" }}</h2>
                <br />
                {{ Form::open(['route' => ['postContact'], 'files' => true, 'id'=>'form', 'role' => 'form'])  }}
                    @captcha
                    <div class="form-outline mb-3">
                        <label for="email">{{ __("general.email") }} <span class="text-red">*</span></label>
                        {{ Form::email("email", old("email"), ['id' => 'email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'placeholder' => 'Your email']) }}
                        @if($errors->has("email")) <div class="invalid-feedback">{{ $errors->first("email") }}</div> @endif
                    </div>

                    <div class="form-outline mb-3">
                        <label for="phone">{{ __("general.phone") }}</label>
                        {{ Form::text("phone", old("phone"), ['id' => 'phone', 'class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control', 'required' => false, 'placeholder' => 'Your phone number']) }}
                        @if($errors->has("phone")) <div class="invalid-feedback">{{ $errors->first("phone") }}</div> @endif
                    </div>

                    <div class="form-outline mb-3">
                        <label for="message">{{ __("general.message") }} <span class="text-red">*</span></label>
                        {{ Form::textarea("message", old("message"), ['id' => 'subject', 'class' => $errors->has('message') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'rows' => 5]) }}
                        @if($errors->has("message")) <div class="invalid-feedback">{{ $errors->first("message") }}</div> @endif
                    </div>

                    <button type="submit" class="btn btn-warning btn-block text-white" id="sub" title="@lang('general.send')">
                        <span class="text-bold"> @lang('general.send')</span></i>
                    </button>

                {{ Form::close() }}
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
@stop
