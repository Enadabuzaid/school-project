@extends('layouts.master')
@section('css')
    @include('includes.data-table')
    @include('includes.modal')
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <!--Internal  treeview -->
    <link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
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
                                                    data-target="#edit{{ $grade->id }}"
                                                    title="{{trans('grade_trans.Edit')}}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <!-- edit modal -->
                                            <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        {{----------header Modal ---------}}
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{trans('grade_trans.Edit Grade')}}</h6>
                                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

                                                        </div>
                                                        {{---------End header Modal --------}}


                                                        {{---------End Body Modal --------}}
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <span class="text-danger ml-3 mr-2">*</span><p class="tx-gray-400">{{trans('grade_trans.you must fill all required field in English and Arabic')}}</p>
                                                            </div>

                                                            <div class=" tab-menu-heading">
                                                                <div class="tabs-menu1">
                                                                    <!-- Tabs -->
                                                                    <ul class="nav panel-tabs main-nav-line">
                                                                        <li><a href="#tab{{$grade->id}}" class="nav-link active" data-toggle="tab">{{trans('grade_trans.English')}}</a></li>
                                                                        <li><a href="#tab{{$grade->id + 1}}" class="nav-link" data-toggle="tab">{{trans('grade_trans.Arabic')}}</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body tabs-menu-body main-content-body-right mt-lg-3">

                                                                <form class="" id="add-grade-form" action="{{ route('grades.update','test') }}" method="POST">
                                                                    <input id="text" type="text" name="id" class="form-control" value="{{ $grade->id }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="tab{{$grade->id}}">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">{{trans('grade_trans.Edit Grade in English')}}</label><span class="text-danger ml-1">*</span>
                                                                                <input type="text" name="grade_name_en" value="{{$grade->getTranslation('grade_name', 'en')}}" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">{{trans('grade_trans.Edit Grade Notes in English')}}</label>
                                                                                <textarea class="form-control" name="notes_en" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3">{{$grade->getTranslation('notes', 'en')}}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="tab-pane" id="tab{{$grade->id + 1}}">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">{{trans('grade_trans.Add Grade in Arabic')}}</label><span class="text-danger ml-1">*</span>
                                                                                <input type="text" name="grade_name_ar" value="{{$grade->getTranslation('grade_name', 'ar')}}" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">{{trans('grade_trans.Add Grade Notes in Arabic')}}</label>
                                                                                <textarea name="notes_ar" class="form-control" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3">{{$grade->getTranslation('notes', 'ar')}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex" style="justify-content: flex-end;gap:0.2rem;">
                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('grade_trans.Close')}}</button>
                                                                        <input class="btn ripple btn-info" type="submit" value="{{trans('grade_trans.Edit')}}">
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
                                            <!-- End edit modal -->

                                            {{--DELETE BUTTONS --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $grade->id }}"
                                                    title="{{ trans('grade_trans.Delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- delete modal -->
                                            <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        {{----------header Modal ---------}}
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{trans('grade_trans.Edit Grade')}}</h6>
                                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

                                                        </div>
                                                        {{---------End header Modal --------}}

                                                        <form action="{{route('grades.destroy','test')}}" method="post">
                                                            @method('Delete')
                                                            @csrf
                                                            {{--------- Body Modal --------}}
                                                            <div class="modal-body">


                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                                                                {{trans('grade_trans.warning delete')}}


                                                            </div>
                                                            {{---------End Body Modal --------}}



                                                            {{----------Footer Modal ---------}}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{trans('grade_trans.Close')}}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{trans('grade_trans.Delete')}}</button>
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
    <!-- Internal Treeview js -->
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
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
