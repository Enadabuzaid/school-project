@extends('layouts.master')
@section('css')
    @include('includes.data-table')
    @include('includes.modal')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        @include('includes.breadcrumb')

        <div class="d-flex my-xl-auto right-content">
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#addModal">{{trans('grade_trans.Add Grade')}}</a>
        </div>

        <!-- Add modal -->
        <div class="modal" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    {{----------header Modal ---------}}
                    <div class="modal-header">
                        <h6 class="modal-title">{{trans('grade_trans.Add Grade')}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

                    </div>
                    {{---------End header Modal --------}}


                    {{---------End Body Modal --------}}
                    <div class="modal-body">
                        <div class="row">
                            <span class="text-danger ml-3 mr-2">*</span><p class="tx-gray-400">you must fill all required field in English and Arabic</p>
                        </div>

                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#tab1" class="nav-link active" data-toggle="tab">{{trans('grade_trans.English')}}</a></li>
                                    <li><a href="#tab2" class="nav-link" data-toggle="tab">{{trans('grade_trans.Arabic')}}</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body tabs-menu-body main-content-body-right mt-lg-3">

                            <form class="" id="add-grade-form" action="{{ route('grades.store') }}" method="POST">
                                @csrf
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{trans('grade_trans.Add Grade in English')}}</label><span class="text-danger ml-1">*</span>
                                            <input type="text" name="grade_name_en" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">{{trans('grade_trans.Add Grade Notes in English')}}</label>
                                            <textarea class="form-control" name="notes_en" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{trans('grade_trans.Add Grade in Arabic')}}</label><span class="text-danger ml-1">*</span>
                                            <input type="text" name="grade_name_ar" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">{{trans('grade_trans.Add Grade Notes in Arabic')}}</label>
                                            <textarea name="notes_ar" class="form-control" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex" style="justify-content: flex-end;gap:0.2rem;">
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('grade_trans.Close')}}</button>
                                    <input class="btn ripple btn-primary" type="submit" value="{{trans('grade_trans.Add')}}">
                                </div>
                            </form>
                        </div>
                    </div>
                    {{---------End Body Modal --------}}



                    {{----------Footer Modal ---------}}
                    <div class="modal-footer">
                    </div>
                    {{---------End Footr Modal --------}}
                </div>
            </div>
        </div>
        <!-- End Add modal -->

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="container mt-5">
            <h1 class="text-center">Multiple Input Form</h1>
            <div class="row mt-5 mb-5">
                <div class="col">
                    <form method="post" action="">
                        <div class="form-group fieldGroup mt-3" style="display: none;">
                            <div class="input-group">
                                <input type="text" name="name[]" class="form-control" placeholder="Name" />
                                <input type="text" name="Address[]" class="form-control" placeholder="Address" />
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary mt-3" value="Save" />
                        <a href="javascript:void(0)" class="btn btn-success addMore float-end mt-3">+ Add</a>

                    </form>
                    <div class="form-group fieldGroupCopy" style="display: none;">
                        <div class="input-group mt-2">
                            <input type="text" name="name[]" class="form-control" placeholder="Name" />
                            <input type="text" name="Address[]" class="form-control" placeholder="Address" />
                            <div class="input-group-addon">
                                <a href="javascript:void(0)" class="btn btn-danger remove">Delete</i></a>
                            </div>
                        </div>
                    </div>
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
    @include('includes.data-table-script')
    @include('includes.modal-script')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            // max of form--}}
{{--            var maxGroup = 100;--}}

{{--            //process--}}
{{--            $(".addMore").click(function() {--}}
{{--                if ($('body').find('.fieldGroup').length < maxGroup) {--}}
{{--                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';--}}
{{--                    $('body').find('.fieldGroup:last').after(fieldHTML);--}}
{{--                } else {--}}
{{--                    alert('Maximum ' + maxGroup + ' groups are allowed.');--}}
{{--                }--}}
{{--            });--}}

{{--            //remove form--}}
{{--            $("body").on("click", ".remove", function() {--}}
{{--                $(this).parents(".fieldGroup").remove();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
