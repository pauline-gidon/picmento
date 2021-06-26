grecaptcha.ready(function() {
    grecaptcha.execute('6LefU_YaAAAAAH4NSe1qGr5kNh086h3QMfyWDRtR', {action: 'homepage'}).then(function(token) {
        document.getElementById('recaptchaResponse').value = token
    });
});

