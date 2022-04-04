    function Message(message, status) {
        if (status == true) {
            $("#success-message").html(message).slideDown();
            $("#error-message").slideUp();
            setTimeout(function() {
                $("#success-message").slideUp();
            }, 2000);
        } else if (status == false) {
            $("#error-message").html(message).slideDown();
            $("#success-message").slideUp();
            setTimeout(function() {
                $("#error-message").slideUp();
            }, 2000);
        }
    }