<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\StoreGrades;
use App\Models\Grade\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
//      $data = ['page_name' =>'Grade List'];

      $pages = [
          "parent_page" => "Grade",
          "current_page" => "Grade List",
          "parent_page_ar" => "المراحل الدراسية",
          "current_page_ar" => "قائمة المراحل الدراسية"
      ];

      $grades = Grade::all();
      return view('pages.grades.grades',compact('grades'))
          ->with('pages',$pages);
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
  public function store(StoreGrades $request)
  {
    try{
        $validated = $request->validated();

        $grade = new Grade();

        $grade->grade_name = [
            'en' => $request->grade_name_en ,
            'ar' => $request->grade_name_ar
        ];

        $grade->notes = [
            'en' => $request->notes_en ,
            'ar' => $request->notes_ar
        ];

        $grade->save();

        toastr()->success(trans('message.success'));

        return redirect()->route('grades.index');
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
  public function update(StoreGrades $request)
  {
      try{
          $validated = $request->validated();

          $grades = Grade::findOrFail($request->id);

          $grades->update([
              $grades->grade_name = ['en'=>$request->grade_name_en,'ar' => $request->grade_name_ar],
              $grades->notes = [ 'en' => $request->notes_en , 'ar' => $request->notes_ar]
          ]);

          toastr()->success(trans('message.update'));
          return redirect()->route('grades.index');
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
  public function destroy(Request $request)
  {
      $grades = Grade::findOrFail($request->id)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('grades.index');
  }

}

?>
