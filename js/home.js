jQuery('#popupbtn').click(function(e){

  document.querySelector('.popup-session').style.display = 'flex';

});

jQuery('.close-form').click(function(e){

  document.querySelector('.popup-session').style.display = 'none';

});


jQuery('.popup-form-select').on("change", function(e){

  var optionSelected = jQuery(this).find("option:selected");

  jQuery('#old-form-items').html('');
    jQuery('#new-form-items').html('');

  if(optionSelected.val() == "default"){
    jQuery('.select-payment-options').css('display', 'none');
    jQuery('.all-forms').css('display', 'none');
    return;
  }else{
    jQuery('.select-payment-options').css('display', 'initial');
    jQuery('.all-forms').css('display', 'initial');
  }

  var oldForm = document.querySelector('#old-form-items');
  var newForm = document.querySelector('#new-form-items');


  input_items_form(oldForm, optionSelected, "old");
  input_items_form(newForm, optionSelected, "new");

});

function input_items_form(form, optionSelected, type){

  var input1 = document.createElement('input');
  input1.type = "text";
  input1.name = "purchase-option-text";
  input1.value = optionSelected.text();
  input1.hidden = true;
  input1.readOnly = true;

  form.append(input1);

    var input2 = document.createElement('input');
    input2.type = "number";
    input2.name = "purchase-option-amount";

    if(type == "old"){
      input2.id = "purchase-option-amount-old";
    }else if(type == "new"){
      input2.id = "purchase-option-amount-new";
    }

    value = optionSelected.val();

  if(!(value == 1)){
    input2.value = optionSelected.val();
    input2.hidden = true;
    input2.readOnly = true;
  }else{
    input2.placeholder = "Amount of Sessions";
    input2.min = 1;
    input2.required = true;
    input2.className = "form-control mb-3 StripeElement StripeElement--empty";
  }


  form.append(input2);

var input3 = document.createElement('input');
  input3.type = "number";
  input3.name = "purchase-option-price";
  input3.value = optionSelected.attr('id');
  input3.hidden = true;
  input3.readOnly = true;

  form.append(input3);

}

jQuery('.select-payment-options').on("change", function(e){

  var optionSelected = jQuery(this).find("option:selected");

    var paymentDisplay = document.querySelector('#payment-info');

  if(optionSelected.val() == "old"){
jQuery('#payment-card-form').css('display', 'none');
jQuery('#old-card-form').css('display', 'block');
  }else if(optionSelected.val() == "new"){
jQuery('#payment-card-form').css('display', 'block');
jQuery('#old-card-form').css('display', 'none');
  }else{
    jQuery('#old-card-form').css('display', 'none');
    jQuery('#payment-card-form').css('display', 'none');
  }


});

	// jQuery('#payment-form').submit(function(event) {
  //             event.preventDefault();
  //
  //   jQuery(this).find(':input').each(function(index, value){
  //     var that = jQuery(this),
  //         name = that.attr('id'),
  //         value = that.val();
  //
  //       if (!jQuery(that).is(":button")){
  //           if (value == ""){
  //             alert("Indicated a empty field. Please fill in the empty field.");
  //             console.log(that);
  //             event.preventDefault();
  //             return false;
  //           }
  //       }
  //
  //
  //   });
  //
  // });

  jQuery('#old-form').submit(function(event) {

    jQuery(this).find(':input').each(function(index, value){
      var that = jQuery(this),
          name = that.attr('id'),
          value = that.val();

        if (!jQuery(that).is(":button")){
            if (value == ""){
              alert("Indicated a empty field. Please fill in the empty field.");
              event.preventDefault();
              return false;
            }
        }


    });

});

jQuery('.pre-confirm-submit').on('click', function(e) {

    document.querySelector('.popup-confirm').style.display = 'flex';

    var price = document.querySelector('[name = "purchase-option-price"]').value;

    var confirmBtn = document.querySelector('#confirmBtn');

    confirmBtn.value = jQuery(this).val();

    if(jQuery(this).val() == "old"){
      var sessionAmount = document.querySelector('#purchase-option-amount-old').value;
    }else if(jQuery(this).val() == "new"){
      var sessionAmount = document.querySelector('#purchase-option-amount-new').value;
    }

    var total = price * sessionAmount;

    var content = document.querySelector('#confirm-content');

    content.innerHTML = "Confirm Total: $" + total + " (" + sessionAmount + " sessions @ $" + price + "/session)";

});

jQuery('#confirmBtn').on('click', function(e){
  var btnVal = jQuery(this).val();

  if(btnVal == "new"){
    var submitBtn = document.querySelector('#new-form-btn');
    submitBtn.click();
    document.querySelector('.popup-confirm').style.display = 'none';
  }else if(btnVal = "old"){
    var submitBtn = document.querySelector('#old-form-btn');
    submitBtn.click();
    document.querySelector('.popup-confirm').style.display = 'none';
  }else{
    alert("We apologize, we are having issues processing the form. Please Contact us directly or try again.")
  }

});

jQuery('#cancelBtn').on('click', function(e){
    document.querySelector('.popup-confirm').style.display = 'none';
});
