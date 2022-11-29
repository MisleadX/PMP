@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.product_category'))

<?php
$categoryProduct = $page['product-category'] ?? [];
?>

@section('css')
    @parent
    <style>
        #category {
            margin-top: 8rem;
            min-height: 100vh;
        }

        .title {
            font-size: 2.5rem;
            line-height: 4rem;
        }

        .title2 {
            font-size: 2rem;
            line-height: 4rem;
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

        #background-card {
            border-radius: 10px;
            background: #D9D9D910;
            width: 85%;
        }

        .inside-card {
            background: #63886D20;
            border-radius: 10px;
        }

        .card-link:hover {
            background: #63886D50;
        }

        .mh-category {
            min-height: 14rem;
            max-height: 14rem;
            max-width: 14rem;
            border-radius: 10px;
        }

        @media(min-width: 576px) {
            .title2 {
                font-size: 3.5rem;
                line-height: 5.5rem;
                color: #FFC65A !important;
            }

            .title {
                font-size: 3.5rem;
                line-height: 5.5rem;
            }
        }
    </style>
@stop

@section('content')
    <section id="category" class="text-white">
        <div class="d-flex flex-column justify-content-center">
            <h1 class="title2 text-center">{{ $categoryProduct['title'] ?? 'Title' }}</h1>
            <div id="background-card" class="card align-self-center">
                <div class="card-body">
                    <div class="row">
                        @if ($product_category && count($product_category) > 0)
                            @foreach ($product_category as $category)
                                <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                                    <a href="{{ route('product', $category->name) }}" class="no-style">
                                        <div class="card inside-card p-2 h-100 card-link">
                                            <img src="{{ $category->image_full }}"
                                                class="img-responsive img-fluid w-100 mh-category align-self-center"
                                                alt="{{ $category->name }}" />
                                            <p class="title3 text-center m-2 p-1 inside-card">{{ $category->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <h3 class="title3 text-center m-2 p-1 inside-card">Empty</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
@stop
