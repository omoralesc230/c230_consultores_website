<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Application;

class ApplicationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:api', ['except' => ['store']]);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return Application::latest()->paginate(10);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request,[
      'name' => 'required|string',
      'email' => 'required|email',
      'source' => 'required|string',
      'situation' => 'required|string',
      'university' => 'required|string',
      'grade_average' => 'required',
      'mexican' => 'required',
      'reason_to_work' => 'required',
      'reason_to_hire' => 'required'
    ]);

    $motivation_letter_data = explode(',', $request->motivation_letter)[1];
    $motivation_letter_name = time().'.' . explode('/', explode(':', substr($request->motivation_letter, 0, strpos($request->motivation_letter, ';')))[1])[1];
    $motivation_letter_uploadPath = public_path(). "/files/applications/ml/" . $motivation_letter_name;
    $motivation_letter_data = base64_decode($motivation_letter_data);
    file_put_contents($motivation_letter_uploadPath , $motivation_letter_data);
    $request->merge(['motivation_letter' => $motivation_letter_name]);


    $curriculum_data = explode(',', $request->curriculum)[1];
    $curriculum_name = time().'.' . explode('/', explode(':', substr($request->curriculum, 0, strpos($request->curriculum, ';')))[1])[1];
    $curriculum_uploadPath = public_path(). "/files/applications/cv/" . $curriculum_name;
    $curriculum_data = base64_decode($curriculum_data);
    file_put_contents($curriculum_uploadPath , $curriculum_data);
    $request->merge(['curriculum' => $curriculum_name]);

    return Application::create([
      'name' => $request['name'],
      'email' => $request['email'],
      'motivation_letter' => $motivation_letter_name,
      'curriculum' => $curriculum_name,
      'source' => $request['source'],
      'situation' => $request['situation'],
      'university' => $request['university'],
      'grade_average' => $request['grade_average'],
      'topics' => $request['topics'],
      'stata' => $request['stata'],
      'plans' => $request['plans'],
      'mexican' => $request['mexican'],
      'reason_to_work' => $request['reason_to_work'],
      'reason_to_hire' => $request['reason_to_hire'],
      'comments' => $request['comments'],
      'vacancy_id' => $request['vacancy_id'],
    ]);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
