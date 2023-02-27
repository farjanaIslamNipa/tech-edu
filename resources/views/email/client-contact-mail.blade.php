<!DOCTYPE html>
<html>
<body style="background-color: #EFEFEF;">
<div style="background-color: #fff; max-width:700px; margin: 20px auto 0;">
    <div style="margin: 0;">
        <div style="width: 100%;"><img src="{{ asset('images/email/client_email_header.png') }}" class="img-fluid"
                                       alt="Header Banner"></div>
        <div style="padding: 40px 30px 20px;">
            <div><h2 style="color: #F9A033; margin-bottom:20px; line-height:1px;">Hi {{ $mailData['first_name'] }} {{ $mailData['last_name'] }}</h2>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">Thank you for contact with us. </p>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">One of our team will call you very soon with the contact reference number <b>#{{ $mailData['reference'] }}</b>, but if you don’t want to wait you can always pick up the phone and call us on <b>02 9160 0075</b>.</p></div>

            <div style="margin-bottom: 25px;"><p style="margin-bottom: 5px; font-size: 17px; padding: 0;">Have a good
                    day!</p>
                <p style="margin: 0; padding: 0;"><b>Geeks Learning</b> Team</p></div>
        </div>
    </div>
    <div style="width: 100%;"><img src="{{ asset('images/email/client_email_footer.png') }}" class="img-fluid"
                                   alt="Footer Image"></div>
</div>
</body>
</html>
