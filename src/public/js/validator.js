function Validator(decimalSeparator, groupingSeparator) {

  this.decimalSeparator = decimalSeparator;
  this.groupingSeparator = groupingSeparator;
  this.messages = [];

  /**
  * Validate a form
  */
  this.validateForm = function(form) {
    var that = this;
    this.messages = [];
    $(form).find(':input[type="text"]').each(function() {
      that.validateInput(this);
    });

    if(this.messages.length > 0) {
      $('#validationMessages').empty();
      this.messages.forEach(function(message) {
        $('#validationMessages').append('<div class="small help-block">' + message + '</div>');
      });
      return false;
    }

    // Be sure to convert the price to a valid float before submit
    var priceElement = $(form).find(':input[id="price"]');
    priceElement.val(this.parsePrice(priceElement.val()));

    return true;
  }

  /**
  * Validate a single input form field
  */
  this.validateInput = function(element) {
    if(element.id == 'description') {
      this.setValid(element, element.value.search('.{2,}') >= 0, 'Bitte eine Beschreibung eingeben.');
    }
    else if(element.id == 'price') {
      var price = this.parsePrice(element.value);
      console.log(price);
      this.setValid(element, price > 0, 'Bitte Preis korrekt eingeben.');
    }
  }

  /**
  * Set the appropriate CSS class and add the error message
  */
  this.setValid = function(element, valid, errorMessage) {
    if(valid) {
      $(element).parent().removeClass('has-error');
    }
    else {
      $(element).parent().addClass('has-error');
      this.messages.push(errorMessage);
    }
  };

  /**
  * Convert the localized input into a JavaScript float
  */
  this.parsePrice = function(value) {
    var s = value
      .replace(new RegExp(this.quoteRegEx(groupingSeparator), 'g'), '')
      .replace(new RegExp(this.quoteRegEx(decimalSeparator), 'g'), '.');
    return parseFloat(s);
  };

  /**
  * Quote all special characters that could be found in a RegEx string
  */
  this.quoteRegEx = function(s) {
    return s.replace(/([.?*+^$[\]\\(){}|-])/g, '\\$1');
  };
}
