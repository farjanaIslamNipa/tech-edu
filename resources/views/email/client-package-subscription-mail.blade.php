<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geeks Learning</title>
</head>
<body style="background-color: #fff; color: #414141; margin: 0;">
<div style="background-color: #FFF; max-width:700px; margin: 0 auto;">
    <div style="margin-top:50px;">
        <div style="background-color: #FFF; border: 5px solid white;">
            <div style="width: 100%;text-align:center;">
                <a href="https://geekslearning.au" target="_blank"><img style="max-width: 280px;" src="{{ asset('images/email/logo.png') }}" alt="Geeks Learning Logo"></a>
            </div>
            <div style="background-color: #EDECF0; margin-top: 30px; text-align: center;">
                <div style="padding: 40px 30px 30px;">
                    <h2 style="text-transform: uppercase;">Thank you for your SUBSCRIPTION!</h2>
                    <h3 style="margin-bottom:5px; margin-top: 50px; line-height:1px; text-transform: capitalize; font-size: 22px;"><span style="font-weight: 300;">Hi</span><b>&nbsp;{{ $mailData['first_name'] }} {{ $mailData['last_name'] }}</b></h3>
                    <p style="margin-bottom: 25px; font-size: 18px;">This email confirms your Subscription.</p>
                    <p style="margin-bottom: 5px; font-size: 18px;">We are pleased to advise, you have subscribed our</p>
                    <p style="color: #7162AB; margin: 0; font-size: 18px; text-transform: capitalize;"><b>{{ $mailData['package_name'] }}</b></p>
                </div>
                <div style="background-color: #7162AB; text-align: center; color: white;padding: 15px 10px;">
                    <p style="margin: 0; font-size: 18px; padding-bottom: 5px;">Subscription ID #<span>{{ $mailData['reference'] }}</span></p>
                    <p style="margin: 0; font-size: 20px;"><b>{{ $mailData['start_date'] }}</b></p>
                </div>
            </div>
            <div style="padding: 20px 0; margin:20px 0 10px; border-radius: 5px; background-color: #F5F5F5;">
                <table cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody>
                    <tr style="vertical-align: middle; text-align: center;">
                        <td style="padding:4px 0; width: 50%;">
                            <b style="text-transform:capitalize;">{{ $mailData['type'] }}</b>
                        </td>
                        <td style="padding:4px 0; width: 50%; border-left: 1px solid #bbbbbb;">
                            <b style="text-transform:capitalize;">${{ $mailData['total_price']/100 }}</b>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle; text-align: center;">
                        <td style="padding:4px 0; width: 50%;">
                            <b style="text-transform:capitalize; color: #9E9E9E;">Package Duration</b>
                        </td>
                        <td style="padding:4px 0; width: 50%; border-left: 1px solid #bbbbbb;">
                            <b style="text-transform:capitalize; color: #9E9E9E;">Total Price</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 style="text-transform: uppercase; color: #7162AB; text-align: center; margin-top: 40px;">Your package subscription details</h3>
            <div style="padding: 20px 0; margin-top:10px; border-radius: 5px; background-color: #F5F5F5;">
                <table cellpadding="0" cellspacing="0" style="width:100%;">
                    <tbody>
                    <tr style="vertical-align: middle;">
                        <td style="padding: 20px 30px 10px;">
                            <p style="font-size: 17px; margin:0; padding-bottom: 10px;"><b>Package name:</b>&nbsp;{{ $mailData['package_name'] }} </p>
                            <p style="font-size: 17px; margin:0;"><b>Courses name:</b></p>
                            <ul>

                                @foreach($mailData['customizedCourseModules'] as $customizedCourseModule)
                                    <li style="text-transform: capitalize; padding-bottom: 10px;">{{ $customizedCourseModule->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style=" border:1px dashed #7162AB; padding: 15px 5px; margin: 30px 0; text-align: center;">
                <span style="font-size: 14px;text-transform: uppercase;">Pay your subscription fee - <a style="text-decoration: none" target="_blank" href="{{ $mailData['payment_link'] }}"><span style="color: #7162AB"><b>CLICK HERE</b></span></a></span>
            </div>
            <div style="text-align: center;">
                <p style="margin:0; font-size: 17px;">For any questions or concerns, please contact our customer support team on <b>02 9160 0075</b>  or email <b>hello@geekslearning.au</b></p>
                <p style="margin:0; font-weight: 300; padding-top: 20px; font-size: 17px;">Have a good day!</p>
                <p style="margin:0; font-size: 17px;"><b>Geeks Learning Team</b></p>
            </div>

            <div style="margin-top: 30px;">
                <a href="https://geekscrs.com.au/book-online" target="_blank" style="display:block;height: 100%; width: 100%; margin-top: 20px;">
                    <img style="height: auto; width: 100%;" src="{{ asset('images/email/geekify-ad-image.png') }}" alt="Add Banner">
                </a>
            </div>
            <div style="background-color: #F5F5F5; padding: 30px; margin-bottom: 30px;">
                <div style="margin-top: 30px;">
                    <a href="" style="display: block; color: #424242; text-decoration: none; padding: 2px 10px; border-left: 1px solid #424242; font-size: 16px; margin-bottom: 10px;">Privacy policy</a>
                    <a href="" style="display: block; color: #424242; text-decoration: none; padding: 2px 10px; border-left: 1px solid #424242; font-size: 16px; margin-bottom: 10px;">Terms & conditions</a>
                    <a href="" style="display: block; color: #424242; text-decoration: none; padding: 2px 10px; border-left: 1px solid #424242; font-size: 16px; margin-bottom: 10px;">Manage my communication</a>
                    <a href="" style="display: block; color: #424242; text-decoration: none; padding: 2px 10px; border-left: 1px solid #424242; font-size: 16px; margin-bottom: 10px;">Unsubscribe</a>
                    <a href="" style="display: block; color: #424242; text-decoration: none; padding: 2px 10px; border-left: 1px solid #424242; font-size: 16px; margin-bottom: 10px;">FAQ</a>
                </div>
                <div style="margin-top: 20px;">
                    <ul style="margin: 0; padding: 0;">
                        <li style="list-style: none; display: inline-block; margin-right: 10px;"><a href=""><img style="height: 20px;" src="{{ asset('images/email/facebook.png') }}" alt="Facebook"></a></li>
                        <li style="list-style: none; display: inline-block; margin-right: 10px;"><a href=""><img style="height: 20px;" src="{{ asset('images/email/instagram.png') }}" alt="Instagram"></a></li>
                        <li style="list-style: none; display: inline-block; margin-right: 10px;"><a href=""><img style="height: 20px;" src="{{ asset('images/email/linkedin.png') }}" alt="Linkedin"></a></li>
                        <li style="list-style: none; display: inline-block; margin-right: 10px;"><a href=""><img style="height: 20px;" src="{{ asset('images/email/you-tube.png') }}" alt="Youtube"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
