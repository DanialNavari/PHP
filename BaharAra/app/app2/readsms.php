<input type="text">
<script>
    navigator.credentials.get({
        otp: {
            transport: ['sms']
        },
        signal: ac.signal
    }).then(otp => {
        input.value = otp.code;
        if (form) form.submit();
    }).catch(err => {
        document.write(err);
    });
</script>