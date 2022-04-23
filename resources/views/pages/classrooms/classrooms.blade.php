@extends('layouts.master')
@section('css')
    @include('includes.helper.data-table')
    @include('includes.helper.modal')
    @include('includes.helper.notify')
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
@endsection

@section('title')
    Classroom List
@endsection

@if (session()->has('Add'))
    @if (App::getLocale() == 'en')
        <script>
            let messg = "Add Classroom has been Successfully";
        </script>
    @else
        <script>
            let messg = "تم اضافة الصفوف بنجاح";
        </script>
    @endif
    <script>
        window.onload = function() {
            notif({
                msg: messg,
                type: "success",
                position: "right"
            })
        }
    </script>
@endif

@if (session()->has('edit'))
    @if (App::getLocale() == 'en')
        <script>
            let messg = "update Classroom has been Successfully";
        </script>
    @else
        <script>
            let messg = "تم تعديل الصف الدراسي بنجاح";
        </script>
    @endif
    <script>
        window.onload = function() {
            notif({
                msg: messg,
                type: "success",
                position: "right"
            })
        }
    </script>
@endif

@if (session()->has('trashed'))
    @if (App::getLocale() == 'en')
        <script>
            let messg = "Trashed Classroom has been Successfully";
        </script>
    @else
        <script>
            let messg = "تم نقل الصف الدراسي الى المسودة بنجاح بنجاح";
        </script>
    @endif
    <script>
        window.onload = function() {
            notif({
                msg: messg,
                type: "warning",
                position: "right"
            })
        }
    </script>
@endif




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
                                                            <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameEngHolder')}}" required/>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.nameAr')}}</label>
                                                            <input type="text" name="list[]" class="form-control" placeholder="{{trans('classes.nameArHolder')}}" required />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.selectGrade')}}</label>
                                                            <select class="form-control" name="list[]" >
                                                                <option value="0">{{trans('classes.selectEngHolder')}}</option>
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
                                                        <input type="text" value="" name="list[]" class="form-control" placeholder="{{trans('classes.nameEngHolder')}}" />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="text" value="" name="list[]" class="form-control" placeholder="{{trans('classes.nameArHolder')}}" />
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
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{trans('grade_trans.GRADE TABLE')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%">
                            <strong>{{ session()->get('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())

                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mg-b-0 mb-2" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{trans('grade_trans.Oh snap!')}}</strong> {{ $error }}
                            </div>
                        @endforeach


                    @endif
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <td>{{trans('classes.nameEng')}}</td>
                                <td>{{trans('classes.nameAr')}}</td>
                                <td>{{trans('classes.selectGrade')}}</td>
                                <td>{{trans('general.Processes')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($classrooms->isEmpty())
                                <tr><td colspan="4" class="text-center text-danger">{{trans('general.No Data Available')}}</td></tr>
                            @else
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($classrooms as $classroom)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$classroom->getTranslation('name_class', 'en')}}</td>
                                        <td>{{$classroom->getTranslation('name_class', 'ar') }}</td>
                                        <td>{{$classroom->grades->grade_name}}</td>
                                        <td>
                                            {{--EDIT BUTTONS --}}
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $classroom->id }}"
                                                    title="{{trans('general.Edit')}}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <!-- edit modal -->
                                            <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        {{----------header Modal ---------}}
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{trans('classes.Edit Classroom')}}</h6>
                                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        {{---------End header Modal --------}}


                                                        {{---------End Body Modal --------}}
                                                        <div class="modal-body">
                                                            <form class="" id="add-grade-form" action="{{ route('classrooms-list.update', $classroom->id) }}" method="POST">
{{--                                                                <input id="text" type="text" name="id" class="form-control" value="{{ $classroom->id }}">--}}
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.nameEng')}}</label>
                                                                    <input type="text" name="class_en" class="form-control" placeholder="{{trans('classes.nameEngHolder')}}" value="{{$classroom->getTranslation('name_class','en')}}"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.nameAr')}}</label>
                                                                    <input type="text" name="class_ar" class="form-control" placeholder="{{trans('classes.nameArHolder')}}" value="{{$classroom->getTranslation('name_class','ar')}}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="formGroupExampleInput"><span class="text-danger">*</span> {{trans('classes.selectGrade')}}</label>
                                                                    <select class="form-control" name="class_grade" >
                                                                        <option value="{{$classroom->grades->id}}">{{$classroom->grades->grade_name}}</option>
                                                                        @foreach($grades as $grade)
                                                                            <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="d-flex" style="justify-content: flex-end;gap:0.2rem;">
                                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('general.Close')}}</button>
                                                                    <input class="btn ripple btn-info" type="submit" value="{{trans('general.Edit')}}">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        {{---------End Body Modal --------}}

                                                        {{----------Footer Modal ---------}}
                                                        <div class="modal-footer">
                                                        </div>
                                                        {{---------End Footr Modal --------}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End edit modal -->

                                            {{--DELETE BUTTONS --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $classroom->id }}"
                                                    title="{{ trans('general.Trash') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- delete modal -->
                                            <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        {{----------header Modal ---------}}
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{trans('classes.Delete Classroom')}}</h6>
                                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

                                                        </div>
                                                        {{---------End header Modal --------}}

                                                        <form action="{{route('classrooms-list.destroy','test')}}" method="post">
                                                            @method('Delete')
                                                            @csrf
                                                            {{--------- Body Modal --------}}
                                                            <div class="modal-body">


                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $classroom->id }}">
                                                                {{trans('general.warning trash')}}


                                                            </div>
                                                            {{---------End Body Modal --------}}



                                                            {{----------Footer Modal ---------}}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{trans('general.Close')}}</button>
                                                                <button type="submit"
                                                                        class="btn btn-warning">{{trans('general.Trash')}}</button>
                                                            </div>
                                                        </form>
                                                        {{---------End Footr Modal --------}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End delete modal -->

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
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
    @include('includes.helper.data-table-script')
    @include('includes.helper.modal-script')
    @include('includes.helper.notify-script')
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
