<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

  protected $table = 'expense';

  public function category() {
    return $this->belongsTo('App\Model\Category');
  }

  public function person() {
    return $this->belongsTo('App\Model\Person');
  }
}
