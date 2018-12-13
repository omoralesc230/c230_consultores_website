<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Post extends Model
{
  use HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'description', 'type', 'featured', 'picture', 'order', 'slug'
  ];

  public function sections()
  {
    return $this->hasMany('App\Section');
  }

  public function costumers() {
    return $this->belongsToMany('App\Costumer');
  }
}
