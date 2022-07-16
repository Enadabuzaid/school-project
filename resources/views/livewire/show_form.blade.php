@extends('layouts.master')
@section('css')
    <link href="{{URL::asset('css/wizard.css')}}" rel="stylesheet">

    <style>
    .form-row{
        margin-bottom: 1.4rem;
    }
    </style>

@endsection

@section('title')
    {{trans('parent.addPa.title')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        @include('includes.breadcrumb')
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @livewire('add-parent')
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    @livewireScripts
@endsection
