<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Job Created</title>
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
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello {{ $ownerName }},</td>
                </tr>
                <tr>
                    <td style="padding:0 40px;"><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;">Here's the URL for your job opening: <a style="font-size:13px; color:#FFF; font-weight:normal;" href="javascript:;">{{ url('job') }}/{{ $jobId }}/{{ $titleSlug }}</a></p></td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">The best way to promote the job opening is to share this URL on your Twitter and Facebook pages. Also, feel free to post it to Craigslist and to ask your team to email it to good people.</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">Good luck finding awesome people to work for your team!</td>
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
