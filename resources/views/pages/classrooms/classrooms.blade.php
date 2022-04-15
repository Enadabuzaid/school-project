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
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#addModal">{{trans('classes.AddClass')}}</a>
        </div>


        <!-- Add modal -->
        <div class="modal" id="addModal">
            <div class="modal-dialog" role="document" style="max-width: 60%">
                <div class="modal-content modal-content-demo">
                    {{----------header Modal ---------}}
                    <div class="modal-header">
                        <h6 class="modal-title">{{trans('classes.AddClass')}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    {{---------End header Modal --------}}

                    {{---------End Body Modal --------}}
                    <div class="modal-body">
                            <form class="" id="add-grade-form" action="{{ route('classrooms-list.store') }}" method="POST">
                                @csrf
                                <div class="form-repeater-container" id="form-repeater">
                                    <div class="row mt-5 mb-5">
                                        <div class="col">

                                            <div class="form-group fieldGroup mt-3" style="">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.nameEng')}}</label>
                                                            <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameEngHolder')}}" />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.nameAr')}}</label>
                                                            <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameArHolder')}}" />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.selectGrade')}}</label>
                                                            <select class="form-control" name="list[]">
                                                                <option>{{trans('classes.selectEngHolder')}}</option>
                                                                @foreach($grades as $grade)
                                                                    <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <a href="javascript:void(0)" class="btn btn-success addMore" style="margin-top: 1.8rem"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                            </div>


                                            <div class="form-group fieldGroupCopy" style="display: none;">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameEngHolder')}}" />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameArHolder')}}" />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <select class="form-control" name="list[]">
                                                            <option>{{trans('classes.selectEngHolder')}}</option>
                                                            @foreach($grades as $grade)
                                                                <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>
                                                    </div>
                                                </div>
                                            </div>

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
    <script>
        $(document).ready(function() {
            // max of form
            var maxGroup = 100;

            //process
            $(".addMore").click(function() {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                } else {
                    alert('Maximum ' + maxGroup + ' groups are allowed.');
                }
            });

            //remove form
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });
    </script>
@endsection
