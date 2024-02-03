$(function () {
    /* BOOTSNIPP FULLSCREEN FIX */
    if (window.location == window.parent.location) {
        $('#back-to-bootsnipp').removeClass('hide');
    }

    $('[data-toggle="tooltip"]').tooltip();

    $('a[href="#add-contact-modal"]').on('click', function (event) {
        event.preventDefault();
        $('#add-contact-modal').modal('show');
    });

    $('[data-command="toggle-search"]').on('click', function (event) {
        event.preventDefault();
        $(this).toggleClass('hide-search');

        if ($(this).hasClass('hide-search')) {
            $('.c-search').closest('.row').slideUp(100);
        } else {
            $('.c-search').closest('.row').slideDown(100);
        }
    })

    $('#contact-list').searchable({
        searchField: '#contact-list-search',
        selector: 'li',
        childSelector: '.col-xs-12',
        show: function (elem) {
            elem.slideDown(100);
        },
        hide: function (elem) {
            elem.slideUp(100);
        }
    });
});

function validContactForm(name, contact, email, alertArea) {
    if (name.val().trim().length < 5 || name.trim().length > 255) return alertArea.text("Please, enter a valid name").show();
    if (!contact.val().trim().length) return alertArea.text("The contact field is required").show();
    if (contact.val().trim().length != 9) return alertArea.text("The contact can only contain 9 digits").show();
    if (!email.val().trim().length) return alertArea.text("The email field is required").show();
    if (!email.val().trim().length) return alertArea.text("The email field is required").show();

    name.prop("disabled", 1);
    contact.prop("disabled", 1);
    email.prop("disabled", 1);
    alertArea.hide();
    return null;
}

function addContact() {
    let name = $("#contact-name"),
        contact = $("#contact-contact"),
        email = $("#contact-mail"),
        alertArea = $(".alert-error");

    if (validContactForm(name, contact, email, alertArea) !== null) return;

    $.post("/api/contacts", {
        name: name,
        contact: contact,
        email: email
    }, () => {

    }).fail((err) => {

    });
}

function editContactModal(e) {

}

function deleteContact(e) {
    let data = $(e).data();

    if (confirm(`Are you sure you want to delete contact "${data.name}"? This action is irreversible and the data cannot be recovered!`)) {
        $.post("/api/contact/" + data.id + "/delete", () => alert("Contact deleted successfully!") && window.location.reload())
            .fail((err) => alert(err.responseJSON.message || "Unknown error"));
    }
}