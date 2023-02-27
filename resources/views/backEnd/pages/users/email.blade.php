<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geeks Learning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        body {
            font-family: 'Lato', sans-serif;
            /* overflow-x: hidden;
            overflow-y: scroll; */
        }

        .middle {
            margin: 0 auto !important;
            width: 600px !important;
        }


    </style>
</head>

<body>

<div style="background-color:white !important;">
    <div class="middle" style="width: 600px; !important">
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <tbody>
            <tr style="width: 100%; ;">
                <td style="text-align: center;">
                    <div style="background-color: white;padding: 15px 0px !important;">
                        <a href="https://geekscrs.com/" style="text-decoration: none;">
                            <img alt="" src="https://geekscrs.com.au/frontend-new/images/header.png"
                                 style="max-width: 100%;" />
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" style="width:100%;border-bottom: 2px dashed #fff;">
            <tbody>
            <tr style="width: 100%; ;">
                <td style="text-align: left;">
                    <div  style="background-color: #fff;padding: 50px 25px 50px 25px !important;">
                        <div style="margin-bottom: 15px !important; font-size: 22px !important;">Hi  <span style="font-weight: 600 !important;">{{ $mailData['first_name'] }},</span> </div>
                        <div  style="margin-bottom: 15px !important; font-size: 15px !important;">Congratulations! Your account is created.</div>
                        <div  style="margin-bottom: 15px !important; font-size: 15px !important;">Please use the following credential for the login Geeks Learning admin dashboard. </div>
                        <div  style="margin-bottom: 0px !important; font-size: 15px !important;"><span style="font-weight: 600 !important;">Email: </span>{{ $mailData['email'] }}</div>
                        <div  style="margin-bottom: 0px !important; font-size: 15px !important;"><span style="font-weight: 600 !important;">Password: </span>{{ $mailData['password'] }}</div>
                        <div  style="margin-top: 40px !important; font-size: 15px !important;">Have a good day!</div>
                        <div  style="margin-bottom: 0px !important; font-size: 15px !important;">Geeks Learning Team</div>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" style="width:100%;">
            <tbody>
            <tr style="width: 100%; ;">
                <td style="text-align: center;">
                    <div style="background-color: white;padding: 15px 0px !important;">
                        <a href="https://geekscrs.com/" style="text-decoration: none;">
                            <img alt="" src="https://geekscrs.com.au/frontend-new/images/footer.png"
                                 style="max-width: 100%;" />
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>
