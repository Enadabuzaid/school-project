<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade\Grade;
use Illuminate\Http\Request;

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
  public function store(Request $request)
  {


      dd($request);

//      try {
//          $validated =  $request->validated();
//
//          $classroom = new Classroom();
//
//          $names_en = array_filter($request->name_en);
//          $classroom->name_class = [
//              'en' => implode(",",$names_en),
//              'ar' => implode(",",$request->name_ar),
//          ];
//
//          $classroom->grade_id = [
//              'en' => $request->grade
//          ];
//
//          $classroom->save();
//
//          return redirect()->back();
//      }
//       catch (\Exception $e){
//          return redirect()->back();
//       }





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
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

}

?>
