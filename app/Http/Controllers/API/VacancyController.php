<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vacancy;

class VacancyController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:api', ['except' => ['index']]);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return Vacancy::latest()->paginate(5);
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
      'description' => 'required'
    ]);

    return Vacancy::create([
      'name' => $request['name'],
      'description' => $request['description'],
      'department' => $request['department'],
      'status' => $request['status'],
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
    $vacancy = Vacancy::findOrFail($id);
    return $vacancy;
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
    $vacancy = Vacancy::findOrFail($id);

    $this->validate($request,[
      'name' => 'required|string',
      'description' => 'required'
    ]);

    $vacancy->update($request->all());

    return ['message' => 'Updated the vacancy info'];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $vacancy = Vacancy::findOrFail($id);

    $vacancy->delete();

    return ['message' => 'Vacancy deleted!'];
  }
  public function search(){
    if ($search = \Request::get('q')) {
      $vacancies = Vacancy::where(function($query) use ($search){
        $query->where('name','LIKE',"%$search%")->orWhere('department','LIKE',"%$search%");
      })->paginate(20);
    }else{
      $vacancies = Vacancy::latest()->paginate(10);
    }
    return $vacancies;
  }
}
