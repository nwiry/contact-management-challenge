$(document).ready(() => {
    $("#form-login").submit((e) => {
        e.preventDefault();

        let email = $("#email"),
            password = $("#password"),
            btn = $("#btn-login"),
            alertError = $(".alert-error");

        if (!email.val().trim().length) return alertError.text("E-mail field is required").show();
        if (!password.val().trim().length) return alertError.text("Password field is required").show();

        alertError.hide();
        email.prop("disabled", 1);
        password.prop("disabled", 1);
        btn.prop("disabled", 1);

        $.post("/login", {
            email: email.val(),
            password: password.val(),
            _token: $("#_token").val(),
        }, (data) => window.location.replace(data.redirect_url))
            .fail((err) => {
                alertError.text(err.responseJSON.message || "Unknown error").show();
                email.prop("disabled", 0);
                password.prop("disabled", 0);
                btn.prop("disabled", 0);
            });
    });
});