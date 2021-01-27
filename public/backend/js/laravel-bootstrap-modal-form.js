/*!
 * Laravel-Bootstrap-Modal-Form (https://github.com/JerseyMilker/Laravel-Bootstrap-Modal-Form)
 * Copyright 2015 Jesse Leite - MIT License
 *
 * Bromance:
 * Adam Wathan has nice boots. Thank you for BootForms magic.
 * Matt Higgins has nice beard. Thank you for JS wizardry.
 */

$("document").ready(function () {
    // Prepare reset.
    function resetModalFormErrors() {
        $(".form-group").removeClass("has-error");
        $(".form-group").find(".help-block").remove();
    }

    // Intercept submit.
    $("form.bootstrap-modal-form").on("submit", function (submission) {
        submission.preventDefault();
        // Set vars.
        var form = $(this),
            url = form.attr("action"),
            submit = form.find("[type=submit]");
        // Check for file inputs.

        if (form.find("[type=file]").length) {
            // If found, prepare submission via FormData object.
            var input = form.serializeArray(),
                data = new FormData(),
                contentType = false;

            // Append input to FormData object.
            $.each(input, function (index, input) {
                data.append(input.name, input.value);
            });

            // Append files to FormData object.
            $.each(form.find("[type=file]"), function (index, input) {
                if (input.files.length == 1) {
                    data.append(input.name, input.files[0]);
                } else if (input.files.length > 1) {
                    data.append(input.name, input.files);
                }
            });
        }
        // If no file input found, do not use FormData object (better browser compatibility).
        else {
            var data = form.serialize(),
                contentType = "application/x-www-form-urlencoded; charset=UTF-8";
        }

        // Please wait.
        if (submit.is("button")) {
            var submitOriginal = submit.html();
            submit.attr("disabled", "disabled");
            submit.html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Please wait");
        } else if (submit.is("input")) {
            var submitOriginal = submit.val();
            submit.val("Please wait...");
        }

        // Request.
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: contentType,
            processData: false
            // Responses.
        }).always(function (response) {
            // Reset errors.
            resetModalFormErrors();
            if (response.status == 201) {
                $(".bootstrap-modal-form").closest(".modal").modal("hide");
                $(".content-wrapper").find("#ajaxQuickAddAlert").remove();
                $(".quickAddModal").modal("hide");
                if (response.data !== undefined) {
                    if (typeof (response.data.name) != "undefined" && response.data.name !== null) {
                        var newOption = new Option(response.data.name, response.data.id, false, false);
                        if (response.data.is_warehouse === true) {
                            $(".is_warehouse").append(newOption).trigger("select2");
                        }
                        if (response.data.is_contact === true) {
                            var contactType = response.data.contact_type.split(",");
                            $.each(contactType, function (key, value) {
                                $(".is_" + value).append(newOption).trigger("select2");
                            });
                            if ($(document).find('.is_contact').length !== 0) {
                                $(".is_contact").append(newOption).trigger("select2");
                            }
                        }
                        if (response.data.is_tax) {
                            if (response.data.is_tax === 'Is_tax') {
                                $(".is_tax").append(newOption).trigger("select2");
                            }
                            if (response.data.is_tax === 'Is_tds') {
                                $(".is_tds").append(newOption).trigger("select2");
                            }
                            if (typeof taxes !== 'undefined') {
                                var newTax = jQuery.parseJSON(response.newTax);
                                $.extend(true, taxes, newTax);
                            }
                        }
                        if (response.data.is_currency) {
                            $(".is_currency").append(newOption).trigger("select2");
                        }
                        if (response.data.is_chart_of_accounts) {
                            $(".is_chart_of_account").html(response.data.view).trigger("select2");
                        }
                        if (response.data.is_location) {
                            $(".is_location").append(newOption).trigger("select2");
                        }
                        if (response.data.is_reloadable === false) {
                            var message = "<div class=\"box-body\" id='ajaxQuickAddAlert' style=\"padding-left: 15px; padding-right: 15px;\">" +
                                "<div class=\"alert alert-success alert-dismissible no-margin\">" +
                                "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×" +
                                "</button>" + "<h4><i class=\"icon fa fa-check\"></i> Success!</h4>" +
                                response.data.message +
                                "</div></div>";
                            $(message).insertBefore("#app");
                        }
                    }
                }
                if (submit.is("button")) {
                    submit.removeAttr("disabled");
                    submit.html(submitOriginal);
                } else if (submit.is("input")) {
                    submit.val(submitOriginal);
                }
                $(".bootstrap-modal-form").trigger("reset");
            }
            // Check for errors.
            if (response.status == 422) {
                var errors = $.parseJSON(response.responseText).errors;
                // Iterate through errors object.

                $.each(errors, function (field, message) {
                    // $(".bootstrap-modal-form").find($.attr("autofocus")).focus();
                    //handle arrays
                    if (field.indexOf('.') != -1) {
                        field = field.replace('.', '[');
                        //handle multi dimensional array
                        for (i = 1; i <= (field.match(/./g) || []).length; i++) {
                            field = field.replace(".", '][');
                        }
                        field = field + "]";
                    }
                    var fieldElement = $('[name="' + field + '"]', form);
                    if (fieldElement.length > 0) {
                        var formGroup = fieldElement.closest('.form-group');
                        if (fieldElement.attr('type') === 'hidden') {
                            fieldElement.parent().append('<div class="col-md-12 col-md-offset-2">' +
                                '<p class="help-block">' + message + '</p>' +
                                '</div>');
                        } else {
                            if (fieldElement.parent().hasClass('input-group'))
                                fieldElement.parent('.input-group').parent().append('<p class="help-block">' + message + '</p>');
                            else
                                fieldElement.parent().append('<p class="help-block">' + message + '</p>');
                        }
                    } else {
                        var fieldElement = form.find('label[for=' + field + ']');
                        var formGroup = fieldElement.closest('.form-group');
                        if (fieldElement.siblings().hasClass('input-group'))
                            fieldElement.siblings('.input-group').parent().append('<p class="help-block">' + message + '</p>');
                        else
                            fieldElement.siblings().append('<p class="help-block">' + message + '</p>');
                    }
                    formGroup.addClass("has-error");
                    var currentForm = $(".bootstrap-modal-form").find(".has-error");
                    if (currentForm.length > 0) {
                        let a = $(".bootstrap-modal-form").find(".has-error:first").find("input");
                        if (a.hasClass('datepicker')) {

                        } else {
                            a.focus();
                        }
                        currentForm.animate({scrollTop: 0}, "slow");
                    }
                });

                // Reset submit.
                if (submit.is("button")) {
                    submit.removeAttr("disabled");
                    submit.html(submitOriginal);
                } else if (submit.is("input")) {
                    submit.val(submitOriginal);
                }

                // If successful, reload.
            } else {
                if (response.data !== undefined ? (response.data.is_reloadable === true || (response.data.is_reloadable === undefined)) : true) {
                    location.reload();
                }
            }
        });
    });

// Reset errors when opening modal.
    $('.bootstrap-modal-form-open').click(function () {
        resetModalFormErrors();
    });
    $('.modal').on('hide.bs.modal', function () {
        resetModalFormErrors();
    })

});
