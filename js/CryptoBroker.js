Crypto = {

    init:function() {

        $('#login-submit').on('click', function(e) {
            e.preventDefault();
            Crypto.login($('#login-form'));
        });

        $('#register-submit').on('click', function(e) {
            e.preventDefault();
            Crypto.register($('#register-form'));
        });

    },

    login:function(form) {

        var serializedData = form.serialize();
        var inputs = form.find("input, select, button, textarea");
        inputs.prop("disabled", true); //disable buttons etc so can't double submit

        //POST 'serializedData' to 'parseLogin.php'
        var request = $.post("parseLogin.php", serializedData, function(response) {
            //console.log(response);
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            var obj = $.parseJSON(response);
            if (obj.success) {
                window.location = "dashboard";
            } else {
                var message = obj.message || "Login failed";
                $('div.error').html(message);
            }
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            inputs.prop("disabled", false);
        });

    },

    register:function(form) {

        var serializedData = form.serialize();
        var inputs = form.find("input, select, button, textarea");
        inputs.prop("disabled", true); //disable buttons etc so can't double submit

        //POST 'serializedData' to 'parseRegister.php'
        var request = $.post("parseRegister.php", serializedData, function(response) {
            //console.log(response);
        });

        //Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            var obj = $.parseJSON(response);
            if (obj.success) {
                window.location = 'dashboard';
            } else {
                var message = obj.message || "Registration failed";
                $('div.error').html(message);
            }
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            //console.log("finished register request");
            inputs.prop("disabled", false);
        });

    },

}

$(document).ready(Crypto.init);