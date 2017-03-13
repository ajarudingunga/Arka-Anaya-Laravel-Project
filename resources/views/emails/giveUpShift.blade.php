<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>GiveUp Shift Information</title>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; ">
<table style="width:600px; margin:0 auto; background:#303f56; padding:0px 20px 0 20px;">
	<tr>
    	<td style="text-align:center; padding:30px 0 30px 0;">
			<a style="font-size:13px; color:#FFF; font-weight:normal;" href="{{ url('/') }}">
				<img src="{{ env('MAIL_LOGO') }}" alt="{{ env('PROJECT_NAME') }}" />
			</a>
		</td>
    </tr>
    <tr>
    	<td style="padding:35px 0px; background:#303f56;">
        	<table>
            	<!-- <tr>
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello,</td>
                </tr> -->
                <tr>
                    <td style="padding:0 40px;"><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;">{{$offeringToUserDetails->firstName}}, the following shift was offered to you by <?php echo Auth::user()->firstName.' '.Auth::user()->lastName; ?>. To Pickup this shift - click one of the links below</p></td>
                </tr>
                <tr>
                	<td style="padding:0 0 0 40px; font-size:13px; color:#FFF; font-weight:normal;">
                        <p style="margin:4px 0;"><strong style="width:300px;">Schedule: </strong> {{$scheduleDetails->scheduleCategoryName}}</p>
						<p style="margin:4px 0;"><strong style="width:300px;">Day: </strong> <?php echo date('l m/d',strtotime($scheduleDetails->scheduleDate)); ?></p>
						<?php
							$shiftStartTime = date('h:i A',strtotime($scheduleDetails->startTime));
							$shiftEndTime = date('h:i A',strtotime($scheduleDetails->endTime));
						?>
						<p style="margin:4px 0;"><strong style="width:300px;">Time: </strong> {{$shiftStartTime}} - {{$shiftEndTime}} ({{$scheduleDetails->shiftNote}})</p>
					</td>
                </tr>
				<tr>
                	<td style="padding:0 0 0 40px; font-size:13px; color:#FFF; font-weight:normal;">
						<?php
							$actualShiftUserDetail = Helper::getUserDetail($scheduleDetails->userId);
							$actualShiftUserDetail = $actualShiftUserDetail[0];
						?>
						<p style="margin:4px 0;"><strong style="width:300px;">Comments: </strong>{{$giveUpComment}}</p>
						<p style="margin:4px 0;"><strong style="width:300px;">Phone: </strong>{{$actualShiftUserDetail->cellPhone}}</p>
						<p style="margin:4px 0;"><strong style="width:300px;">Email: </strong>
							<a href="mailto:{{$actualShiftUserDetail->email}}">{{$actualShiftUserDetail->email}}</a></p>
					</td>
				</tr>
				<tr>
                	<td style="padding:0 0 0 40px; font-size:13px; color:#FFF; font-weight:normal;">
						<p style="margin:4px 0;">
							<?php $userType = Helper::getUserRole($offeringToUserDetails->userId); ?>
							<a style="color:#FFF" href="{{url('/')}}/{{$userType}}/view/trades">Click here to pickup</a>
						</p>
					</td>
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
