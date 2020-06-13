grecaptcha.ready(function() {
    grecaptcha.execute(site_key, {action: google_recaptcha_action}).then(function(token) {
        document.getElementById('g-recaptcha-response').value = token;
    });
});