<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Welcome to Protalic</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; ">
<style type="text/css">
.ii a[href] {
	color:#FFF !important;
	font-weight:normal;
}
a[href^="mailto:"] {
	color:#FFF !important;
	font-weight:normal;
}
</style>
<table style="width:600px; margin:0 auto; background:#303f56; padding:0px 20px 0 20px;">
	<tr>
    	<td style="text-align:center; padding:30px 0 30px 0;">
			<a style="font-size:13px; color:#FFF; font-weight:normal;" href="{{ url('/') }}">
				<img src="{{ $userDetails['logo'] }}" alt="{{ env('PROJECT_NAME') }}" />
			</a>
		</td>
    </tr>
    <tr>
    	<td style="padding:35px 0px; background:#303f56;">
        	<table>
            	<tr>
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello {{ $userDetails['name'] }},</td>
                </tr>
                <tr>
                    <td style="padding:0 40px;"><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;"> </p></td>
                </tr>
                <tr class="email" style="color:#FFF !important; font-weight:normal;">
                	<td style="padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;"> <strong style="width:120px; display:inline-block;">Email: </strong><span style="color:#FFF !important; font-weight:normal;"><a style="font-size:13px; color:#FFF; font-weight:normal;" href="javascript:;"><?php echo $userDetails['email']; ?></a></span></td>
                </tr>
                <tr>
                	<td style="padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;"> <strong style="width:120px; display:inline-block;">Password: </strong>{{ $userDetails['password'] }}</td>
                </tr>
				<tr>
                    <td style="padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;"><p>Now you can login to your account with your email address.</p></td>
                </tr>
				<tr>
                    <td style="padding:0 40px;"><a style="font-size:13px; color:#FFF; font-weight:normal;" href="{{ url('/login') }}">Click here to Login</a></td>
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
    	<td style="font-size:11px; color:#FFF; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">© <?php echo date('Y'); ?> {{ env('PROJECT_NAME') }}, ALL RIGHTS RESERVED</td>
    </tr>
</table>
</body>
</html>
