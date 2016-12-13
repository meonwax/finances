<?php

class CurrencySymbol extends Twig_Extension {

  public function getFunctions() {
    return array(
      'currencySymbol' => new Twig_Function_Method($this, 'currencyFunction'),
    );
  }

  public function currencyFunction() {
    $formatter = new NumberFormatter(Locale::getDefault(), NumberFormatter::CURRENCY);
    return $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
  }
}
