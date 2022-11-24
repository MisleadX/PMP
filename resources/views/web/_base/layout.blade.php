<!DOCTYPE html>
<html lang="en">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="icon" type="image/x-icon" href="{{ asset('web/logo1.png') }}">
    @show

    <title>{{ env('WEBSITE_NAME') }} | @yield('title')</title>

    @section('css')
        <link rel="stylesheet" href="{{ asset('/assets/cms/css/app.css') }}">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap');
            body {
                position: relative;
                min-height: 100vh;
                font-family: 'Libre Baskerville', serif;
                max-width: 1280px;
                margin: 0 auto !important;
                background: #1A231F;
            }

            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            nav {
                font-size: 20px;
                background: #0B0D0C60;
            }

            .navbar-brand {
                font-size: 20px;
                color: #000000;
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            #navbarNav ul {
                display: flex;
                flex-direction: column;
            }

            @media (min-width: 993px) {
                #navbarNav ul {
                    display: flex;
                    flex-direction: row;
                    gap: 30px;
                }
            }

            .nopadding {
                padding: 0 !important;
                margin: 0 !important;
            }

            footer {
                position: relative;
                background: #1A231F;
            }

            .links:hover {
                text-decoration: none;
            }

            .links::after {
                content: "";
                display: block;
                width: 100%;
                height: 2px;
                background-color: #FFC65A;
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .links:hover::after {
                transform: scaleX(1);
            }
        </style>
    @show
    @section('script-top')
    @show
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand text-white" href="{{ route('homepage') }}">
            <img src="{{ asset('web/logo1.png') ?? asset('assets/cms/images/no-img.png') }}" width="65" height="75" class="d-inline-block align-center" alt="Perdana Mandiri Perkasa">erdana mandiri perkasa
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white links" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white links" href="{{ route('product-category') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white links" href="{{ route('homepage') }}#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white links" href="{{ route('homepage') }}#contact">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-section">
        @yield('content')
    </div>

    <footer class="mt-5">
        <div class="text-center p-3 footer text-white">
            Copyright &copy; 2022 <b>{{ env('website_name')}}</b>
        </div>
    </footer>

    @section('script-bottom')
        <script src="{{ asset('/assets/cms/js/app.js') }}"></script>
        <script src="{{ asset('/assets/cms/js/moment.min.js') }}"></script>
        @if (session()->has('message'))
        <?php
        switch (session()->get('message_alert')) {
            case 2 :
                $type = 'success';
                break;
            case 3 :
                $type = 'info';
                break;
            default :
                $type = 'danger';
                break;
        }
        ?>
        <script type="text/javascript">
            'use strict';
            $.notify({
                // options
                message: '{!! session()->get('message') !!}'
            }, {
                // settings
                type: '{!! $type !!}',
                placement: {
                    from: "bottom",
                    align: "right"
                },
            });
        </script>
    @endif
    <script type="text/javascript">
        'use strict';

        function showErrorMessage(err) {
            let textError = '';
            if (typeof err.responseJSON !== 'undefined') {
                if (typeof err.responseJSON.errors !== 'undefined') {
                    $.each(err.responseJSON.errors, function (index, item) {
                        textError = item[0];
                        $.notify({
                            // options
                            message: item[0]
                        }, {
                            // settings
                            type: 'danger',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                        });
                    });
                } else if (typeof err.responseJSON.message === 'string') {
                    textError = err.responseJSON.message;
                    $('#errorForm').html(err.responseJSON.message);
                    $.notify({
                        // options
                        message: err.responseJSON.message
                    }, {
                        // settings
                        type: 'danger',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                } else if (typeof err.responseJSON.message === 'object') {
                    textError = err.responseJSON.message[0];
                    $.notify({
                        // options
                        message: err.responseJSON.message[0]
                    }, {
                        // settings
                        type: 'danger',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                }
            }

            return textError;
        }

    </script>
    @show
</body>

</html>
