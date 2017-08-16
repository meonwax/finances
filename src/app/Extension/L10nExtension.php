<?php
namespace App\Extension;

use \Twig_Extension;
use \Twig_SimpleFilter;
use \Twig_SimpleFunction;
use \NumberFormatter;
use \Locale;

class L10nExtension extends Twig_Extension {

  public function getFilters() {
    return array(
      new Twig_SimpleFilter('toLocalizedNumber', array($this, 'localizedNumber'))
    );
  }

  public function getFunctions() {
    return array(
      new Twig_SimpleFunction('decimalSeparator', array($this, 'decimalSeparator')),
      new Twig_SimpleFunction('groupingSeparator', array($this, 'groupingSeparator')),
      new Twig_SimpleFunction('currencySymbol', array($this, 'currencySymbol'))
    );
  }

  function localizedNumber($number, $decimals = 0) {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, $decimals);
    $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $decimals);
    return $formatter->format($number);
  }

  public function decimalSeparator() {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::DECIMAL);
    return $formatter->getSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
  }

  public function groupingSeparator() {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::DECIMAL);
    return $formatter->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
  }

  public function currencySymbol() {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::CURRENCY);
    return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
  }
}
