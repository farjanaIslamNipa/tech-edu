<!DOCTYPE html>
<html>
<body style="background-color: #EFEFEF;">
<div style="background-color: #fff; max-width:700px; margin: 20px auto 0;">
    <div style="margin: 0;">
        <div style="width: 100%;"><img src="{{ asset('images/email/admin_email_header.png') }}" class="img-fluid"
                                       alt="Header Banner"></div>
        <div style="padding: 40px 30px 20px;">
            <div><h2 style="color: #F9A033; margin-bottom:20px; line-height:1px;">Hi Admin</h2>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">A new contact request has been submitted by <b>{{ $mailData['first_name'] }}</b>. </p>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">Please Check and give the client a call with the contact reference number <b>#{{ $mailData['reference'] }}</b>,  as soon as you can.</p></div>

            <div style="padding:10px 0;">
                <table>
                    <tbody>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Contact Reference:</b></td>
                        <td style="color: #F9A033;padding: 4px 0;">&nbsp{{$mailData['reference']}}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Client Name:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['first_name'] }}&nbsp;{{ $mailData['last_name'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Client Email:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['email'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Client Phone Number:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['phone_number'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Request Submitted At:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['created_at'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-bottom: 25px;"><p style="margin-bottom: 5px; font-size: 17px; padding: 0;">Have a good
                    day!</p>
                <p style="margin: 0; padding: 0;"><b>Geeks Learning</b> Team</p></div>
        </div>
    </div>
    <div style="width: 100%;"><img src="{{ asset('images/email/admin_email_footer.png') }}" class="img-fluid"
                                   alt="Footer Image"></div>
</div>
</body>
</html>
