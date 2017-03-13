<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Welcome to {{ env('PROJECT_NAME') }}</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; ">
<table style="width:600px; margin:0 auto; background:#303f56; padding:0px 20px 0 20px;">
	<tr>
    	<td style="text-align:center; padding:30px 0 30px 0;">
			<a style="font-size:13px; color:#FFF; font-weight:normal;" href="{{ url('/') }}">
				<img src="{{ $trialDetails['logo'] }}" alt="{{ env('PROJECT_NAME') }}" />
			</a>
		</td>
    </tr>
    <tr>
    	<td style="padding:35px 0px; background:#303f56;">
        	<table>
            	<tr>
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello Admin,</td>
                </tr>
                <tr>
                    <td style="padding:0 40px; "><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;">There is new request form portalic. Below is the requested detail.</p></td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">First Name:</strong>{{$trialDetails['firstName']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Last Name:</strong>{{$trialDetails['lastName']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Email:</strong><a style="font-size:13px; color:#FFF; font-weight:normal;" href="javascript:;">{{$trialDetails['email']}}</a></td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Restaurant Name:</strong>{{$trialDetails['restaurantName']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Cell Phone:</strong>{{$trialDetails['cellPhone']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">City:</strong>{{$trialDetails['city']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">State:</strong>{{$trialDetails['state']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Schedule Name:</strong>{{$trialDetails['scheduleName']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Day Parts:</strong>{{$trialDetails['dayParts']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Schedule StartDay:</strong>{{$trialDetails['scheduleStartDay']}}</td>
                </tr>
                <tr>
                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal; "> <strong style=" width:150px; display:inline-block;">Hear About:</strong>{{$trialDetails['hearAbout']}}</td>
                </tr>
                <tr>
                	<td style="font-size:16px; line-height:20px; color:#FFF; font-weight:normal; padding:50px 0 0 40px; ">
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
