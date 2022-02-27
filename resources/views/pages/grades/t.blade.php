<div class="modal" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            {{----------header Modal ---------}}

            <div class="modal-header">
                <h6 class="modal-title">Basic Modal</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            {{---------End header Modal --------}}


            {{---------End Body Modal --------}}
            <div class="modal-body">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                           <ul class="nav panel-tabs main-nav-line">
                               <li><a href="#tab1" class="nav-link active" data-toggle="tab">{{trans('grade_trans.English')}}</a></li>
                               <li><a href="#tab2" class="nav-link" data-toggle="tab">{{trans('grade_trans.Arabic')}}</a></li>
                           </ul>
                    </div>
                </div>

                <div class="panel-body tabs-menu-body main-content-body-right ">
                    <form class="mt-lg-4" id="add-grade-form" action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('grade_trans.Add Grade in English')}}</label>
                                    <input type="text" name="grade_name" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{trans('grade_trans.Add Grade Notes in English')}}</label>
                                    <textarea class="form-control" name="notes" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="tab-pane" id="tab2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('grade_trans.Add Grade in Arabic')}}</label>
                                    <input type="text" name="grade_name_ar" class="form-control" id="exampleInputEmail1" placeholder="{{trans('grade_trans.Enter Grade')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{trans('grade_trans.Add Grade Notes in Arabic')}}</label>
                                    <textarea name="notes_ar" class="form-control" placeholder="{{trans('grade_trans.Add Grade Notes')}}" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="justify-content: flex-end;">
                            <input class="btn ripple btn-primary" type="submit" value="{{trans('grade_trans.Add')}}">
                        </div>
                    </form>
                </div>
            </div>
            {{---------End Body Modal --------}}



            {{----------Footer Modal ---------}}
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('grade_trans.Close')}}</button>
            </div>
            {{---------End Footr Modal --------}}
        </div>
    </div>
</div>
