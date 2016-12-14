<?php

class L10nExtension extends Twig_Extension {

  public function getFilters() {
    return array(
      new Twig_SimpleFilter('toLocalizedNumber', array($this, 'localizedNumber')),
    );
  }

  public function getFunctions() {
    return array(
      'currencySymbol' => new Twig_Function_Method($this, 'currencySymbol'),
    );
  }

  function localizedNumber($number, $decimals = 0) {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, $decimals);
    $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $decimals);
    return $formatter->format($number);
  }

  public function currencySymbol() {
    $formatter = NumberFormatter::create(Locale::getDefault(), NumberFormatter::CURRENCY);
    return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
  }
}
