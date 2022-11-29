@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.product_category'))

<?php
$productPage = $page['product'] ?? [];
?>

@section('css')
    @parent
    <style>
        #product {
            margin-top: 8rem;
            min-height: 100vh;
        }

        .title {
            font-size: 3.5rem;
            line-height: 5.5rem;
        }

        .title2 {
            font-size: 2rem;
            line-height: 4rem;
            color: #FFC65A !important;
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
        }

        .inside-card {
            background: #63886D20;
            border-radius: 10px;
        }

        .mh-category {
            min-height: 14rem;
            max-height: 14rem;
            max-width: 14rem;
            border-radius: 10px;
        }

        hr {
            border-top: 1px solid #FFFFFF;
        }

        .other-category {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .card-link:hover {
            cursor: default;
            background: #63886D50;
        }

        input[type="text"]
        {
            background: transparent !important;
            color: white !important;
        }

        .breadcrumbs {
            color: #74A8F9;
        }

        .breadcrumbs:hover {
            color: #74A8F9;
        }

        .content {
            font-size: 0.75rem;
        }

        @media(min-width: 576px) {
            .title2 {
                font-size: 3.5rem;
                line-height: 5.5rem;
                color: #FFC65A !important;
            }
        }
    </style>
@stop

@section('content')
    <section id="product" class="text-white">
        <div class="d-flex flex-column justify-content-center pl-4 pr-4">
            <h1 class="title2 text-center">{{ $productPage['title'] ?? 'Title' }}</h1>
            <p class="text-center">
                <a class="breadcrumbs" href="{{ route('product-category') }}">Product Category</a> 
                <span class="text-white">></span> 
                <a class="breadcrumbs" href="{{ route('product', $category->name) }}">{{ $category->name }}</a> 
            </p>
            <br />
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="title3">{{ $productPage['other_category_text'] ?? 'Other Category' }}</h5>
                            <hr />
                            @if ($other_category && count($other_category) > 0)
                                <ul class="pl-4">
                                    @foreach ($other_category as $other)
                                        <li class="mt-2">
                                            <div class=" other-category">
                                                <a href="{{ route('product', $other->name) }}"
                                                    class="text-white links">{{ $other->name }}</a>
                                            </div>
                                        </li>
                                    @endforeach
                            @endif
                        </div>
                        <div class="col-12 mt-3">
                            <h5 class="title3">{{ $productPage['filter_text'] ?? 'Filter' }}</h5>
                            <hr />
                            {{ Form::open(['route' => ['product', $category->name], 'method' => 'GET', 'files' => true, 'id'=>'form', 'role' => 'form'])  }}
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                    {{ Form::text("search", old("search", $search), ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'Search']) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div id="background-card" class="card align-self-center w-100">
                        <div class="card-body">
                            <div class="row">
                                @if ($product && count($product) > 0)
                                    @foreach ($product as $product)
                                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                            <a href="#" class="no-style">
                                                <div class="card inside-card p-2 h-100 card-link">
                                                    <img src="{{ $product->image_full }}"
                                                        class="img-responsive img-fluid w-100 mh-category align-self-center"
                                                        alt="{{ $product->name }}" />
                                                    <p class="title3 text-center m-2 p-1 inside-card">{{ $product->name }}</p>
                                                    <p class="text-white content mt-2 ml-2 mr-2 p-1">
                                                        {{ $product->desc }}
                                                    </p>
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
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
@stop
