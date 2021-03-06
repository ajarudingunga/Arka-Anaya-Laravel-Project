<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Conflicting Time Off Requests</title>
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
            	<tr>
                	<td style="font-size:16px; color:#FFF; padding:0 40px 20px 40px;">Hello {{ $name }},</td>
                </tr>
                <tr>
                    <td style="padding:0 40px;"><p style="font-size:14px; line-height:20px; color:#FFF; font-weight:normal;">We have found following conflict time off requests during copy shifts:</p></td>
					<?php foreach($requestOffGroupObj as $key => $item): ?>
				        <tr>
		                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">
								<strong style="width:150px; display:inline-block;"><?php echo date('D - M d', strtotime($key)); ?></strong>
							</td>
		                </tr>

						<?php for ($r=0; $r<count($requestOffGroupObj[$key]); $r++): ?>
							<tr>
								<tr>
				                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">
										<span style="width:150px; display:inline-block;">Employee:</span>
										<?php echo $requestOffGroupObj[$key][$r]->firstName.' '.$requestOffGroupObj[$key][$r]->lastName; ?>
									</td>
				                </tr>

			                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">
									<span style="width:150px; display:inline-block;">Daypart:</span>
									<?php
										if (strtolower($requestOffGroupObj[$key][$r]->isPermRequest) == "no") {
											echo $requestOffGroupObj[$key][$r]->dayPartName;
										} else {
											echo $requestOffGroupObj[$key][$r]->dayPartName.' (Perm Request)';
										}
									?>
								</td>

								<tr>
				                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">
										<span style="width:150px; display:inline-block;">Notes:</span>
										<?php echo $requestOffGroupObj[$key][$r]->requestOffNote; ?>
									</td>
				                </tr>

								<tr>
				                	<td style="background:#303f56; padding:11px 0 11px 40px; font-size:13px; color:#FFF; font-weight:normal;">
										<span style="width:150px; display:inline-block;">Perm Notes:</span>
										<?php echo $requestOffGroupObj[$key][$r]->permNote; ?>
									</td>
				                </tr>
			                </tr>
						<?php endfor; ?>
					<?php endforeach; ?>
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
