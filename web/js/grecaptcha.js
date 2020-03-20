grecaptcha.ready(function() {
    grecaptcha.execute(site_key, {action: yii.getCurrentUrl()}).then(function(token) {
        console.log(token);
        document.getElementById('g-recaptcha-response').value = token;
    });
});