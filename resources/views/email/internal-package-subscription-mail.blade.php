<!DOCTYPE html>
<html>
<body>
<div style="background-color: #fff; max-width:700px; margin: 20px auto 0;">
    <div style="margin: 0;">
        <div style="width: 100%;text-align:left;line-height: 0; display: flex; justify-content: space-between; align-items: end;">
            <a href="https://geekslearning.au" target="_blank"><img style="max-width: 280px;display: block;" src="{{ asset('images/email/logo.png') }}" alt="Geeks Learning Logo"></a>
            <h2 style="color:#FF0000;">INTERNAL</h2>
        </div>
        <div style="padding: 40px 30px 20px; background-color: #EDECF0;margin-top: 20px;">
            <div><h2 style="margin-bottom:20px; line-height:1px;">Hi Admin</h2>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">A new subscription request has been submitted by <b>{{ $mailData['first_name'] }}</b>. </p>
                <p style="display:block; font-size: 16px; color:#414042; margin-bottom: 0;">Please Check and give the client a call as soon as you can.</p></div>

            <div style="padding:30px 0;">
                <table >
                    <tbody>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Subscription Id:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{$mailData['reference']}}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Package Name:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['package_name'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Package Duration:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['type'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Email:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['email'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Phone:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['phone_number'] }}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td style="padding:4px 0;"><b>Time of Subscription:</b></td>
                        <td style="padding: 4px 0;">&nbsp{{ $mailData['start_date'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="width:100%;">
            <img style="width: 100%; height: auto;" src="{{ asset('images/email/footer.png') }}" alt="Geeks Learning Footer Image">
        </div>
    </div>
</div>
</body>
</html>
