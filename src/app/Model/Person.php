<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

  protected $table = 'person';

  public function expenses() {
    return $this->hasMany('App\Model\Expense');
  }
}
