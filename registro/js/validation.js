// Wait for the DOM to be ready
$(function() {

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='registration']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            origen:{ valueNotEquals: "0" },
            destino:{ valueNotEquals: "0" },
            salida: "required",
            regreso: "required",
            pasajeros: "required"



        },
        // Specify validation error messages
        messages: {
            origen: { valueNotEquals: "Por favor elija un origen" },
            destino: { valueNotEquals: "Por favor elija un destino" },
            salida: "Ingrese fecha de salida",
            regreso: "Ingrese fecha de regreso",
            pasajeros: "Por favor ingrese el numero de pasajeros"
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });
});