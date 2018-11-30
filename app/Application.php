<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Application extends Model
{
  use HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'motivation_letter', 'curriculum', 'source', 'situation', 'university', 'grade_average', 'topics', 'stata', 'plans', 'mexican', 'reason_to_work', 'reason_to_hire', 'comments', 'vacancy_id'
  ];

  public function vacancy()
  {
    return $this->belongsTo('App\Vacancy');
  }
}
