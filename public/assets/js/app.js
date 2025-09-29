function handleFormSubmit(formId, submitButtonId, loaderId, ajaxOptions) {
    $(formId).on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this); // Define formData within the event handler

        // Show loader and disable submit button
        $(loaderId).show();
        $(submitButtonId).prop('disabled', true);

        $.ajax({
            type: ajaxOptions.type,
            url: ajaxOptions.url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (ajaxOptions.success) {
                    ajaxOptions.success(response);
                }

                // Hide loader and enable submit button
                $(loaderId).hide();
                $(submitButtonId).prop('disabled', false);
            },
            error: function(response) {
                if (ajaxOptions.error) {
                    ajaxOptions.error(response);
                }

                // Hide loader and enable submit button
                $(loaderId).hide();
                $(submitButtonId).prop('disabled', false);
            }
        });
    });
}
