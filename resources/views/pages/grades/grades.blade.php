@extends('layouts.master')
@section('title')
    {{ trans('grade_trans.Grade Page') }}
@endsection
@section('css')
    @toastr_css
    @include('includes.helper.data-table')
    @include('includes.helper.modal')

    <style>
        #toast-container>.toast-success{
            background: darkseagreen !important;
        }

        #toast-container>.toast-error{
            background: red !important;
        }
    </style>

@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                @if (App::getLocale() == 'en')
                    <h4 class="content-title mb-0 my-auto">{{$pages['parent_page']}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$pages['current_page']}}</span>
                @else
                    <h4 class="content-title mb-0 my-auto">{{$pages['parent_page_ar']}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$pages['current_page_ar']}}</span>
                @endif
            </div>
        </div>

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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{trans('grade_trans.GRADE TABLE')}}</h4>
                    </div>

                </div>
                <div class="card-body">
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
                                <td>{{trans('grade_trans.Name Grade')}}</td>
                                <td>{{trans('grade_trans.Notes')}}</td>
                                <td>{{trans('grade_trans.Processes')}}</td>
                            </tr>
                            </thead>
                                <tbody>
                            @if($grades->isEmpty())
                                <tr><td colspan="4" class="text-center text-danger">{{trans('grade_trans.No Data Available')}}</td></tr>
                            @else
                                @php
                                $i = 1;
                                @endphp
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$grade->grade_name}}</td>
                                        <td>{{$grade->notes}}</td>
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
                                                                    <input id="text" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
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
    @toastr_js
    @toastr_render

    @include('includes.helper.data-table-script')
    @include('includes.helper.modal-script')

    @endsection
