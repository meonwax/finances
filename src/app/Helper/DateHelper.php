<?php
namespace App\Helper;

use \IntlDateFormatter;
use \Locale;

class DateHelper {

  /**
  * Generate a list of months in a year with locale specific names
  */
  public static function getMonths() {
    $formatter = IntlDateFormatter::create(Locale::getDefault(), null, null, null, null, 'MMMM');
    for($i = 1; $i <= 12; $i++) {
      $months[$i] = $formatter->format(mktime(0, 0, 0, $i));
    }
    return $months;
  }
}
