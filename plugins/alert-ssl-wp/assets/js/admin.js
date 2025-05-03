jQuery(document).ready(function($) {
    var checkButton = $('#alert-ssl-wp-check-now');
    var resultDiv = $('#alert-ssl-wp-check-result');

    checkButton.on('click', function() {
        var originalText = checkButton.text();
        checkButton.prop('disabled', true).text(wpSslAlert.checkingText);
        resultDiv.removeClass('hidden').html('<div class="notice notice-info"><p>' + wpSslAlert.checkingText + '</p></div>');

        $.ajax({
            url: wpSslAlert.ajaxUrl,
            type: 'POST',
            data: {
                action: 'alert_ssl_wp_check_now',
                _ajax_nonce: wpSslAlert.nonce,
                lang: wpSslAlert.language
            },
            success: function(response) {
                if (response.success) {
                    resultDiv.html(response.data.html);
                } else {
                    resultDiv.html('<div class="notice notice-error"><p>' + response.data + '</p></div>');
                }
            },
            error: function() {
                resultDiv.html('<div class="notice notice-error"><p>Ajax request failed</p></div>');
            },
            complete: function() {
                checkButton.prop('disabled', false).text(originalText);
            }
        });
    });

    $('#alert-ssl-wp-test-notification').on('click', function() {
        var originalText = $(this).text();
        $(this).prop('disabled', true).text(wpSslAlert.testNotificationText);
        $('#alert-ssl-wp-test-result').removeClass('hidden').html('<div class="notice notice-info"><p>' + wpSslAlert.checkingText + '</p></div>');

        $.ajax({
            url: wpSslAlert.ajaxUrl,
            type: 'POST',
            data: {
                action: 'alert_ssl_wp_test_notification',
                _ajax_nonce: wpSslAlert.nonce,
                lang: wpSslAlert.language
            },
            success: function(response) {
                if (response.success) {
                    $('#alert-ssl-wp-test-result').html('<div class="notice notice-success"><p>' + response.data + '</p></div>');
                } else {
                    $('#alert-ssl-wp-test-result').html('<div class="notice notice-error"><p>' + response.data + '</p></div>');
                }
            },
            error: function() {
                $('#alert-ssl-wp-test-result').html('<div class="notice notice-error"><p>Ajax request failed</p></div>');
            },
            complete: function() {
                $(this).prop('disabled', false).text(originalText);
            }
        });
    });
});
