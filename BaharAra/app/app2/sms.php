<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function sendTextMessage() {

        var phoneNumber = $("#phoneNumberField").val();

        var accountSid = 'ACOUNTSID';
        var authToken = 'AUTHTOKEN';

        var client = require('twilio')(accountSid, authToken);

        client.messages.create({
            to: phoneNumber,
            from: "+989105005289",
            body: "Hellow from Twilio?",
        }, function(err, message) {
            console.log(message.sid);
        });

    }
</script>

<input type="text" id="phoneNumberField" />
<button type="button" onclick="sendTextMessage()">Send Text Message</button>