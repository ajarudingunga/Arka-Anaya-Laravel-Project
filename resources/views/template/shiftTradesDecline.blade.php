<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Shift Trades Declined</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; ">
<table style="width:600px; margin:0 auto; background:#303f56; padding:0px 20px 0 20px;">
	<tr>
    	<td style="text-align:center; padding:30px 0 30px 0;">
			<a href="{{ url('/') }}"><img src="{{ env('MAIL_LOGO') }}" alt="{{ env('PROJECT_NAME') }}" /></a>
		</td>
    </tr>
    <tr>
    	<td style="padding:35px 0px; background:#303f56;">
        	<table>
				<tr>
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello {{ $name }},</td>
                </tr>
                <tr>
                    <td style="padding:0 40px;"><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;">Your manager has declined the following work shift from your schedule:</p></td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;"> {{ $dayDate }} {{ $time }} - {{ $scheduleCategoryName }} {{ $shiftNote }}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;"> Login to <a style="font-size:13px; color:#FFF; font-weight:normal;" href="{{ url('/') }}">{{ env('PROJECT_NAME') }}</a> to see the entire schedule.</td>
                </tr>
                <tr>
                	<td style="font-size:16px; line-height:20px; color:#FFF; font-weight:normal; padding:50px 0 0 40px;">
                    	Thank you,<br>
						<strong style="color:#ffac3e;">{{ env('PROJECT_NAME') }}</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td style="font-size:11px; color:#FFF; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">&copy; <?php echo date('Y'); ?> {{ env('PROJECT_NAME') }}, ALL RIGHTS RESERVED</td>
    </tr>
</table>
</body>
</html>
