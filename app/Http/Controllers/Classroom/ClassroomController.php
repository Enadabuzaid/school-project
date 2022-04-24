<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $classrooms = Classroom::all();
      $grades = Grade::all();
      return view('pages.classrooms.classrooms',compact('grades','classrooms'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassroom $request)
  {

      try {
//          $validated =  $request->validated();

          $all_list_without_empty  = array_filter($request->list);
          $remove_last_one = array_pop($all_list_without_empty);
          $rows = array_chunk($all_list_without_empty,3);

          for ($i=0;$i<count($rows);$i++){
              $classroom = new Classroom();
              $classroom->name_class = [
                  'en' => $rows[$i][0],
                  'ar' => $rows[$i][1],
              ];
              $classroom->grade_id = $rows[$i][2];
              $classroom->save();
          }
          session()->flash('Add', 'add class success');
          return redirect()->route('classrooms-list.index');
      }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
       }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreClassroom $request,$id)
  {
      if(Classroom::where('name_class->ar',$request->class_ar)->orWhere('name_class->en',$request->class_an)->exists()){
          return redirect()->back()->withErrors(trans('message.exist'));
      }

      try{
          $classes = Classroom::findOrFail($id);

          $classes->update([
              $classes->name_class = ['en'=>$request->class_en,'ar' => $request->class_ar],
              $classes->grade_id = $request->class_grade
          ]);

          session()->flash('edit', 'update classroom success');
          return redirect()->route('classrooms-list.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request  $request)
  {
      try{
          $id = $request->id;
          Classroom::findOrFail($id)->delete();
          session()->flash('trashed', 'update classroom success');
          return redirect()->route('classrooms-list.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
      }
  }

  public function delete_all(Request $request){
      $delete_all_id = explode(",", $request->delete_all_id);

      if(in_array('on',$delete_all_id)){
          array_shift($delete_all_id);
      }

      Classroom::whereIn('id', $delete_all_id)->delete();
      session()->flash('trashed', 'trashed classroom success');
      return redirect()->route('classrooms-list.index');
  }

}

?>
