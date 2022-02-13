@extends('layouts.master')
@section('title')
    {{ trans('grade_trans.Grade Page') }}
@endsection
@section('css')
    @toastr_css
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    {{--MODAL CSS--}}
    <!---Internal Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <style>
        #toast-container>.toast-success{
            background: darkseagreen !important;
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
                                        <td></td>
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



    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>

    {{--Modal script--}}
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>


    @endsection
