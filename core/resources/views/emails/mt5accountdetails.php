<!DOCTYPE html>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Account Details</title>
</head>

<body style="width:100%;font-family:Poppins,sans-serif;background-color:#f6f6f6;margin:0;padding:0;">
    <div class="es-wrapper-color" style="background-color:#f6f6f6;">
        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%;background-color:#f6f6f6;">
            <tbody>
                <tr>
                    <td valign="top">

                        <!-- HEADER -->
                        <table align="center" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" style="padding:0;">
                                                                        <p style="text-align:center;padding:40px 0;background:#eeeeee;font-size:1.5rem;border-radius:30px 30px 0 0;font-weight:600;margin:0;">
                                                                            Account Details
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="font-size:0;">
                                                                        <a href="https://profxleague.com">
                                                                            <img src="https://profxleague.com/assets/frontend/images/accountdetails.png"
                                                                                 alt="PROFXSPORTSCLUB" style="display:block;border:0;width:100%;">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- CONTENT -->
                        <table align="center" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:30px 20px;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center">
                                                                        <h1 style="margin:0;line-height:32px;font-size:20px;font-weight:600;color:#333;">
                                                                            Dear <?php echo $name ?>,
                                                                        </h1>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="padding:15px 0;">
                                                                        <p style="margin:0;font-size:15px;color:#333;line-height:22px;text-align:center;">
                                                                            Welcome to <b>PROFXSPORTSCLUB – <?php echo $type ?></b>.<br>
                                                                            Your contest account has been successfully set up, and you are ready to join this week’s event.
                                                                            <span>Here are your account details:</span>
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <!-- ACCOUNT DETAILS -->
                                                                <tr>
                                                                    <td style="padding:20px;">
                                                                        <table width="100%" cellpadding="10" cellspacing="0" style="background:#f9f9f9;border-radius:8px;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><b>Account ID:</b></td>
                                                                                    <td><?php echo $trade_id ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Master Password:</b></td>
                                                                                    <td><?php echo $trader_pwd ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Investor Password:</b></td>
                                                                                    <td><?php echo $investor_pwd ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Leverage:</b></td>
                                                                                    <td><?php echo $leverage ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>MT5 Server:</b></td>
                                                                                    <td><?php echo $server_name ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <p style="margin:0;font-size:14px;color:#333;line-height:21px;text-align:center;">
                                                                            Please keep these credentials safe.<br>
                                                                            The <b>main password</b> password allows you to participate in the 
                                                                            contest, while the <b>investor password</b> is for view-only access.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                               <tr>
                                                                    <td>
                                                                        <p style="margin:0;font-size:14px;color:#333;line-height:21px;text-align:center;">
                                                                            If you need assistance connecting your account or have any contest-related questions, please
                                                                            contact us at <a href="mailto:support@profxleague.com" ><b>support@profxleague.com</b></a>.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                <td >
                                                                    <p style="margin:0;font-size:16px;color:#333;line-height:24px;text-align:center;font-weight:500;">
                                                                        We wish you the best of luck in Pre League Week 2. Let’s make this week exciting!
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                                <tr>
                                                                    <td style="padding-top:15px;">
                                                                        <p style="margin:0;font-size:14px;color:#333;line-height:21px;text-align:center;">
                                                                            Best regards,<br>The PROFXSPORTSCLUB Team<br><a href="https://www.profxleague.com/" ><b>www.profxleague.com</b></a>.
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- FOOTER -->
                        <table align="center" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#051c35;">
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="padding:15px 0;">
                                                        <table cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding-right:40px">
                                                                        <a href="https://facebook.com/profxleague">
                                                                            <img src="https://msucns.stripocdn.email/content/assets/img/social-icons/logo-white/facebook-logo-white.png"
                                                                                 alt="Fb" width="32">
                                                                        </a>
                                                                    </td>
                                                                    <td style="padding-right:40px">
                                                                        <a href="https://x.com/profxleague" style="text-decoration:none;color:white;font-size:22px;">𝕏</a>
                                                                    </td>
                                                                    <td style="padding-right:40px">
                                                                        <a href="https://www.instagram.com/profxleague/">
                                                                            <img src="https://msucns.stripocdn.email/content/assets/img/social-icons/logo-white/instagram-logo-white.png"
                                                                                 alt="IG" width="32">
                                                                        </a>
                                                                    </td>
                                                                    <td style="padding-right:40px">
                                                                        <a href="https://wa.me/971585948900">
                                                                            <img src="https://fnnrzjq.stripocdn.email/content/guids/CABINET_bcd0e915a4d9b738a3a23a162c83acabc786c7c8ff239aeac5fc2573e6644e78/images/whatsappico.png"
                                                                                 alt="Whatsapp" width="25" style="padding-top:3px">
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="https://www.youtube.com/@ProfxLeague">
                                                                            <img src="https://msucns.stripocdn.email/content/assets/img/social-icons/logo-white/youtube-logo-white.png"
                                                                                 alt="YT" width="32">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style="margin-top:10px;font-size:12px;color:#aaa;">&copy; <?php echo date('Y') ?> PROFXSPORTSCLUB. All rights reserved.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
