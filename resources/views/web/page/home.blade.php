@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.home'))

<?php
$homepage = $page['homepage'] ?? [];
?>

@section('css')
    @parent
@stop

@section('content')
    
@stop

@section('script-bottom')
    @parent
@stop
