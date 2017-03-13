<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Role;
use App\ScheduleCategoriesMaster;
use App\ShiftDayPartMaster;
use App\RequestForTrial;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequestForTrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $RequestForTrialModel;

    public function __construct()
    {
        $this->RequestForTrialModel = new RequestForTrial();
    }

    public function index()
    {
        return view('admin.RequestForTrial.listing');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Update free trial request
     * Function Name: updateRequestData
     */
    public function updateRequestData(Request $request)
    {
        $response = [ 'data' => [] ];
        $statusCode = 200;
        try {
            $rules = array(
                'editFirstName'  => 'required|max:35',
                'editLastName'  => 'required|max:35',
                'editEmail'  => 'required|max:254',
                'editRestaurantName'  => 'required|max:254',
                'editCellPhone'  => 'required|max:20',
                'editCity'  => 'required|max:255',
                'editState'  => 'required|max:255',
                'editScheduleName'  => 'required|max:255',
                'editDayParts'  => 'required|max:255',
                'editScheduleStartDay'  => 'required',
                'editHearAbout'  => 'required|max:255',
            );

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = $validator->errors()->first();
            } else {
                $requestForTrial = RequestForTrial::find($request->requestId);
                $requestForTrial->firstName = trim($request->editFirstName);
                $requestForTrial->lastName = trim($request->editLastName);
                $requestForTrial->email = trim($request->editEmail);
                $requestForTrial->restaurantName = trim($request->editRestaurantName);
                $requestForTrial->cellPhone = trim($request->editCellPhone);
                $requestForTrial->city = trim($request->editCity);
                $requestForTrial->state = trim($request->editState);
                $requestForTrial->scheduleName = trim($request->editScheduleName);
                $requestForTrial->dayParts = trim($request->editDayParts);
                $requestForTrial->scheduleStartDay = trim($request->editScheduleStartDay);
                $requestForTrial->hearAbout = trim($request->editHearAbout);

                if ($requestForTrial->save()) {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = "Free trail request updated successfully.";
                } else {
                    $response['status'] = "0";
                    $response['data'] = array();
                    $response['message'] = 'Opps.. something went wrong, please try again.';
                }
            }
        } catch(Exception $e) {
            $statusCode = 400;
            $response['status'] = "0";
            $response['message'] = $e->getMessage();
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get request for trial listing
     * Function Name: getListing
     */
    public function getListing(Request $request)
    {
        $iSortCol = intval($request->iSortCol_0); // Get sorting field id
        $sSortDir = $request->sSortDir_0; // Get sort by asc or desc
        $filter   = array();

        if (isset($request->sGroupActionName)) {
            $sGroupActionName = $request->sGroupActionName; // Get action namne like Approve & Delete from selectbox
        } else {
            $sGroupActionName = ""; // Get action namne like Approve & Delete from selectbox
        }

        if (isset($request->id) && $sGroupActionName == "delete") {
            // If user selected checkbox and action is delete
            $count_chk = count($request->id); // Get user select checkbox count
        }

        $filter['name'] = "";
        $filter['email'] = "";
        $filter['restaurantName'] = "";
        $filter['city'] = "";
        $filter['state'] = "";
        $filter['scheduleName'] = "";
        $filter['dayParts'] = "";
        $filter['scheduleStartDay'] = "";
        $filter['hearAbout'] = "";
        $filter['createdAt'] = "";
        $filter['status'] = "";
        $filter['sAction'] = "";

        if (isset($request->name))
            $filter['name'] = $request->name;

        if (isset($request->email))
            $filter['email'] = $request->email;

        if (isset($request->restaurantName))
            $filter['restaurantName'] = $request->restaurantName;

        if (isset($request->cellPhone))
            $filter['cellPhone'] = $request->cellPhone;

        if (isset($request->city))
            $filter['city'] = $request->city;

        if (isset($request->state))
            $filter['state'] = $request->state;

        if (isset($request->scheduleName))
            $filter['scheduleName'] = $request->scheduleName;

        if (isset($request->dayParts))
            $filter['dayParts'] = $request->dayParts;

        if (isset($request->scheduleStartDay))
            $filter['scheduleStartDay'] = $request->scheduleStartDay;

        if (isset($request->hearAbout))
            $filter['hearAbout'] = $request->hearAbout;

        if (isset($request->createdAt))
            $filter['createdAt'] = $request->createdAt;

        if (isset($request->status))
            $filter['status'] = $request->status;

        if (isset($request->globalSearch))
            $filter['globalSearch'] = $request->globalSearch;

        if (isset($request->sAction))
            $filter['sAction'] = $request->sAction;

        // Deleted
        if ($sGroupActionName == "Delete") {
            $action_id = $request->id; // Get action id from array
            $action_id = explode(",", $action_id[0]);
            DB::table('requestForTrial')->wherein('requestId', $action_id)->update(['status' => '-1']);
        }

        $counts = $this->RequestForTrialModel->getCount($filter);

        $iTotalRecords  = $counts;
        $iDisplayLength = intval($request->iDisplayLength);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($request->iDisplayStart);
        $sEcho          = intval($request->sEcho);

        $Data = $this->RequestForTrialModel->getAllRecords($iSortCol, $sSortDir, $sGroupActionName, $iDisplayStart, $iDisplayLength, $filter, $request);

        $records           = array();
        $records["aaData"] = array();
        $end               = $iDisplayStart + $iDisplayLength;
        $end               = $end > $iTotalRecords ? $iTotalRecords : $end;

        $offset = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            if (isset($Data[$offset]->requestId) && !empty($Data[$offset]->requestId)) {
                $requestId = $Data[$offset]->requestId;
            } else {
                $requestId = "";
            }

            if (isset($Data[$offset]->firstName) && !empty($Data[$offset]->firstName)) {
                $firstName = $Data[$offset]->firstName;
            } else {
                $firstName = "";
            }

            if (isset($Data[$offset]->lastName) && !empty($Data[$offset]->lastName)) {
                $lastName = $Data[$offset]->lastName;
            } else {
                $lastName = "";
            }

            if (isset($Data[$offset]->email) && !empty($Data[$offset]->email)) {
                $email = $Data[$offset]->email;
            } else {
                $email = "";
            }

            if (isset($Data[$offset]->restaurantName) && !empty($Data[$offset]->restaurantName)) {
                $restaurantName = $Data[$offset]->restaurantName;
            } else {
                $restaurantName = "";
            }

            if (isset($Data[$offset]->cellPhone) && !empty($Data[$offset]->cellPhone)) {
                $cellPhone = $Data[$offset]->cellPhone;
            } else {
                $cellPhone = "";
            }

            if (isset($Data[$offset]->city) && !empty($Data[$offset]->city)) {
                $city = $Data[$offset]->city;
            } else {
                $city = "";
            }

            if (isset($Data[$offset]->state) && !empty($Data[$offset]->state)) {
                $state = $Data[$offset]->state;
            } else {
                $state = "";
            }

            if (isset($Data[$offset]->scheduleName) && !empty($Data[$offset]->scheduleName)) {
                $scheduleName = $Data[$offset]->scheduleName;
            } else {
                $scheduleName = "";
            }

            if (isset($Data[$offset]->dayParts) && !empty($Data[$offset]->dayParts)) {
                $dayParts = $Data[$offset]->dayParts;
            } else {
                $dayParts = "";
            }

            if (isset($Data[$offset]->scheduleStartDay) && !empty($Data[$offset]->scheduleStartDay)) {
                $scheduleStartDay = $Data[$offset]->scheduleStartDay;
            } else {
                $scheduleStartDay = "";
            }

            if (isset($Data[$offset]->hearAbout) && !empty($Data[$offset]->hearAbout)) {
                $hearAbout = $Data[$offset]->hearAbout;
                $hearAbout = wordwrap($hearAbout, 50, "<br />\n");
            } else {
                $hearAbout = "";
            }

            if (isset($Data[$offset]->createdAt) && !empty($Data[$offset]->createdAt)) {
                $createdAt = $Data[$offset]->createdAt;
                $createdAt = date("d/m/Y", strtotime($createdAt));
            } else {
                $createdAt = "";
            }

            if (isset($Data[$offset]->status)) {
                $status = $Data[$offset]->status;

                if ($status == 1) {
                    $statusCode = '<a class="rowStatus" data-status="1" href="javascript:;" id="'.$requestId.'"><span class="label label-sm label-success ">Active</span></a>';
                } else if($status == 0) {
                    $statusCode = '<a class="rowStatus" data-status="0" href="javascript:;" id="'.$requestId.'"><span class="label label-sm label-info">Inactive</span></a>';
                }
            } else {
                $status = "";
                $statusCode = "";
            }

            $action = '
            <a href="javascript:;" id="'.$requestId.'" class="btn btn-xs default approve-action"><i class="fa fa-check"></i> Approve</a>
            <a href="javascript:;" id="'.$requestId.'" class="btn btn-xs default edit-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="javascript:;" id="'.$requestId.'" class="btn btn-xs default delete-action"><i class="fa fa-trash-o"></i> Delete</a>';

            $records["aaData"][] = array(
                '<input id="requestId" type="checkbox" name="id[]" value="'.$requestId.'">',
                $firstName.' '.$lastName,
                $email,
                $restaurantName,
                $cellPhone,
                $city,
                $state,
                $scheduleName,
                $dayParts,
                $scheduleStartDay,
                $hearAbout,
                $createdAt,
                $statusCode,
                $action
            );
            $offset++;
        }

        $records["sEcho"]                = $sEcho;
        $records["iTotalRecords"]        = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        echo json_encode($records);
    }

    public function updateRequestStatus(Request $request)
    {
        $response = array();
        $statusCode = 200;

        if (isset($request->requestId) && !empty($request->requestId)) {
            $requestForTrial = RequestForTrial::find($request->requestId);

            if ($request->status == 1) {
                $request->status = 0;
            } else {
                $request->status = 1;
            }

            $requestForTrial->status = $request->status;
            if ($requestForTrial->save()) {
                $response['status'] = '1';
                $response['statusUpdate'] = $request->status;
                $response['message'] = 'Status updated successfully.';
            } else {
                $response['status'] = '0';
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        } else {
            $response['status'] = '0';
            $response['message'] = 'Invalid action.';
        }

        return response()->json($response,$statusCode);
    }

    public function approveRequest(Request $request)
    {
        $response = array();
        $statusCode = 200;

        if (isset($request->requestId) && !empty($request->requestId) && ctype_digit($request->requestId)) {
            $requestForTrial = RequestForTrial::find($request->requestId);
            $passwordString = date("Ymd").'!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
            $password = substr(str_shuffle($passwordString), 0, 12);

            $googleQuery = $requestForTrial->city.', '.$requestForTrial->state;
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($googleQuery) . '&sensor=ture';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $locationDetail = json_decode(curl_exec($ch), true);
            if(isset($locationDetail['results'][0]['geometry']['location'])){
                $latitude = $locationDetail['results'][0]['geometry']['location']['lat'];
                $longitude = $locationDetail['results'][0]['geometry']['location']['lng'];
            }else{
                $latitude = '';
                $longitude = '';
            }

            $users = new User();
            $users->userParentId = "1";
            $users->authProvider = "Normal";
            $users->firstName = trim($requestForTrial->firstName);
            $users->lastName = trim($requestForTrial->lastName);
            $users->username = trim(strtolower($requestForTrial->firstName)).'-'.trim(strtolower($requestForTrial->lastName));
            $users->email = trim($requestForTrial->email);
            $users->password = Hash::make($password);
            $users->restaurantName = trim($requestForTrial->restaurantName);
            $users->restaurantSlug = trim(str_slug($requestForTrial->restaurantName));
            $users->cellPhone = trim($requestForTrial->cellPhone);
            $users->city = trim($requestForTrial->city);
            $users->latitude = trim($latitude);
            $users->longitude = trim($longitude);
            $users->state = trim($requestForTrial->state);
            $users->scheduleStartDay = trim($requestForTrial->scheduleStartDay);
            $users->hearAboutUs = trim($requestForTrial->hearAbout);
            $users->createdBy = Auth::id();

            if ($users->save()) {
                // Insert to role to users_role table
                $role = new Role();
                $role->userId = $users->userId;
                $role->roleType = "1";
                if ($role->save()) {
                    if (!empty($requestForTrial->scheduleName)) {
                        // Insert schedule names to schedule_categories_master table
                        $scheduleName = $requestForTrial->scheduleName;
                        $scheduleName = preg_replace('/\s*,\s*/', ',', $scheduleName);
                        $scheduleArr = explode(',', $scheduleName);
                        for ($s=0; $s<count($scheduleArr); $s++) {
                            $ScheduleCategoriesMaster = new ScheduleCategoriesMaster();
                            $ScheduleCategoriesMaster->ownerId = $users->userId;
                            $ScheduleCategoriesMaster->scheduleCategoryName = $scheduleArr[$s];
                            $ScheduleCategoriesMaster->sortOrder = $s+1;
                            $ScheduleCategoriesMaster->createdBy = Auth::id();
                            $ScheduleCategoriesMaster->save();
                        }

                        // Insert dayspart to shift_day_part_master table
                        $dayParts = preg_replace('/\s*,\s*/', ',', $requestForTrial->dayParts);
                        $dayPartsArr = explode(',', $dayParts);
                        for ($d=0; $d<count($dayPartsArr); $d++) {
                            $ShiftDayPartMaster = new ShiftDayPartMaster();
                            $ShiftDayPartMaster->ownerId = $users->userId;
                            $ShiftDayPartMaster->dayPartName = $dayPartsArr[$d];
                            $ShiftDayPartMaster->createdBy = Auth::id();
                            $ShiftDayPartMaster->save();
                        }

                        // Send data to email template
                        $userDetails['logo'] = env('MAIL_LOGO');
                        $userDetails['name'] = trim($requestForTrial->firstName).' '.trim($requestForTrial->lastName);
                        $userDetails['username'] = trim(strtolower($requestForTrial->firstName)).'-'.trim(strtolower($requestForTrial->lastName));
                        $userDetails['email'] = trim($requestForTrial->email);
                        $userDetails['password'] = $password;

                        Mail::send('template.accountCreated', ['userDetails' => $userDetails], function ($m) use ($userDetails){
                            $userEmail = trim($userDetails['email']);

                            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
                            $m->to($userEmail, env('MAIL_NAME'))->subject('Welcome to Portalic.us');
                        });

                        // Remove request from requestForTrial table when owne user created
                        DB::table('requestForTrial')->where('requestId', $request->requestId)->update(['status' => '-1']);

                        $response['status'] = '1';
                        $response['message'] = 'User created successfully and login credentials sent to user via email.';
                    }
                } else {
                    $response['status'] = '0';
                    $response['message'] = 'Opps.. something went wrong, please try again.';
                }
            } else {
                $response['status'] = '0';
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        } else {
            $response['status'] = '0';
            $response['message'] = 'Invalid action.';
        }

        return response()->json($response,$statusCode);
    }

    public function fillRequestData(Request $request)
    {
        if (isset($request->requestId) && !empty($request->requestId) && ctype_digit($request->requestId)) {
            $requestForTrial = RequestForTrial::find($request->requestId);

            $html = '<div class="form-group">
                        <input type="hidden" name="requestId" value="'.trim($requestForTrial->requestId).'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <div class="col-md-12">
                            <label for="editFirstName">First Name</label>
                            <input type="text" name="editFirstName" id="editFirstName" value="'.trim($requestForTrial->firstName).'" class="form-control" placeholder="" maxlength="35">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editLastName">Last Name</label>
                            <input type="text" name="editLastName" id="editLastName" value="'.trim($requestForTrial->lastName).'" class="form-control" placeholder="" maxlength="35">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editEmail">Email</label>
                            <input type="text" name="editEmail" id="editEmail" value="'.trim($requestForTrial->email).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editRestaurantName">Restaurant Name</label>
                            <input type="text" name="editRestaurantName" id="editRestaurantName" value="'.trim($requestForTrial->restaurantName).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editCellPhone">Cell Phone</label>
                            <input type="text" name="editCellPhone" id="editCellPhone" value="'.trim($requestForTrial->cellPhone).'" class="form-control" placeholder="" maxlength="20">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editCity">City</label>
                            <input type="text" name="editCity" id="editCity" value="'.trim($requestForTrial->city).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editState">State</label>
                            <input type="text" name="editState" id="editState" value="'.trim($requestForTrial->state).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editScheduleName">Schedule Name</label>
                            <input type="text" name="editScheduleName" id="editScheduleName" value="'.trim($requestForTrial->scheduleName).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editDayParts">Dayparts</label>
                            <input type="text" name="editDayParts" id="editDayParts" value="'.trim($requestForTrial->dayParts).'" class="form-control" placeholder="" maxlength="254">
                            <span class="help-block">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editScheduleStartDay">Schedule Start Day</label>
                            <select name="editScheduleStartDay" id="editScheduleStartDay" class="form-control">
                                <option value="">Select</option>';
                                if($requestForTrial->scheduleStartDay == "Monday"):
                                	$html .='<option value="Monday" selected="selected">Monday</option>';
                                else:
                                	$html .='<option value="Monday">Monday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Tuesday"):
                                	$html .='<option value="Tuesday" selected="selected">Tuesday</option>';
                                else:
                                	$html .='<option value="Tuesday">Tuesday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Wednesday"):
                                	$html .='<option value="Wednesday" selected="selected">Wednesday</option>';
                                else:
                                	$html .='<option value="Wednesday">Wednesday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Thursday"):
                                	$html .='<option value="Thursday" selected="selected">Thursday</option>';
                                else:
                                	$html .='<option value="Thursday">Thursday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Friday"):
                                	$html .='<option value="Friday" selected="selected">Friday</option>';
                                else:
                                	$html .='<option value="Friday">Friday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Saturday"):
                                	$html .='<option value="Saturday" selected="selected">Saturday</option>';
                                else:
                                	$html .='<option value="Saturday">Saturday</option>';
                                endif;

                                if($requestForTrial->scheduleStartDay == "Sunday"):
                                	$html .='<option value="Sunday" selected="selected">Sunday</option>';
                                else:
                                	$html .='<option value="Sunday">Sunday</option>';
                                endif;
							$html .='</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="editHearAbout">Hear About Us</label>
                            <textarea name="editHearAbout" id="editHearAbout" class="form-control" rows="3">'.$requestForTrial->hearAbout.'</textarea>
                            <span class="help-block">

                            </span>
                        </div>
                    </div>';
            return $html;
        }
    }
}
