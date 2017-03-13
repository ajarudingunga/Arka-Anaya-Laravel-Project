<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use App\ScheduleCategoriesMaster;
use App\ShiftDayPartMaster;
use App\RequestForTrial;
use App\RestaurantSettings;
use App\Notes;
use App\Reminders;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helper\GlobalHelper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new User();
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Load restaurants listing blade
     */
    public function restaurantsIndex()
    {
        return view('admin.restaurants.listing');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get all restaurants listing
     */
    public function restaurantsListing(Request $request)
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

        $filter['firstName'] = "";
        $filter['lastName'] = "";
        $filter['email'] = "";
        $filter['restaurantName'] = "";
        $filter['city'] = "";
        $filter['state'] = "";
        $filter['zipcode'] = "";
        $filter['county'] = "";
        $filter['createdAt'] = "";
        $filter['status'] = "";
        $filter['sAction'] = "";

        if (isset($request->firstName))
            $filter['firstName'] = $request->firstName;

        if (isset($request->lastName))
            $filter['lastName'] = $request->lastName;

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

        if (isset($request->zipcode))
            $filter['zipcode'] = $request->zipcode;

        if (isset($request->county))
            $filter['county'] = $request->county;

        if (isset($request->createdAt))
            $filter['createdAt'] = $request->createdAt;

        if (isset($request->status))
            $filter['status'] = $request->status;

        if (isset($request->globalSearch))
            $filter['globalSearch'] = $request->globalSearch;

        if (isset($request->sAction))
            $filter['sAction'] = $request->sAction;

        // Delete restaurants
        if ($sGroupActionName == "Delete") {
            $action_id = $request->id; // Get action id from array
            $action_id = explode(",", $action_id[0]);

            if (!empty($action_id)) {
                for ($a=0; $a<count($action_id); $a++) {
                    $deleteEmployeeRecord = $this->UserModel->deleteEmployee($action_id[$a]);
                }
            }
        }

        $counts = $this->UserModel->getRestaurantsCount($filter);

        $iTotalRecords  = $counts;
        $iDisplayLength = intval($request->iDisplayLength);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($request->iDisplayStart);
        $sEcho          = intval($request->sEcho);

        $Data = $this->UserModel->getAllRestaurantsRecords($iSortCol, $sSortDir, $sGroupActionName, $iDisplayStart, $iDisplayLength, $filter, $request);

        $records           = array();
        $records["aaData"] = array();
        $end               = $iDisplayStart + $iDisplayLength;
        $end               = $end > $iTotalRecords ? $iTotalRecords : $end;

        $offset = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            if (isset($Data[$offset]->userId) && !empty($Data[$offset]->userId)) {
                $userId = $Data[$offset]->userId;
            } else {
                $userId = "";
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

            if (isset($Data[$offset]->zipcode) && !empty($Data[$offset]->zipcode)) {
                $zipcode = $Data[$offset]->zipcode;
            } else {
                $zipcode = "";
            }

            if (isset($Data[$offset]->county) && !empty($Data[$offset]->county)) {
                $county = $Data[$offset]->county;
            } else {
                $county = "";
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
                    $statusCode = '<a class="rowStatus" data-status="1" href="javascript:;" id="'.$userId.'"><span class="label label-sm label-success ">Active</span></a>';
                } else if($status == 0) {
                    $statusCode = '<a class="rowStatus" data-status="0" href="javascript:;" id="'.$userId.'"><span class="label label-sm label-info">Inactive</span></a>';
                }
            } else {
                $status = "";
                $statusCode = "";
            }

            $action = '
            <select id="rdToPage" class="form-control input-inline input-small input-sm">
            	<option value="">Select...</option>
            	<option data-page="employees" data-restaurant-slug="'.str_slug($restaurantName).'" value="'.$userId.'">Employees</option>
                <option data-page="jobs" data-restaurant-slug="'.str_slug($restaurantName).'" value="'.$userId.'">Jobs</option>
            </select>
            <a href="'.url('admin/restaurant/edit/'.$userId.'').'" id="'.$userId.'" class="btn btn-xs default edit-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="javascript:;" id="'.$userId.'" class="btn btn-xs default delete-action"><i class="fa fa-trash-o"></i> Delete</a>';

            $records["aaData"][] = array(
                '<input id="$userId" type="checkbox" name="id[]" value="'.$userId.'">',
                $firstName,
                $lastName,
                $email,
                $restaurantName,
                $cellPhone,
                $city,
                $state,
                $zipcode,
                $county,
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

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Update restaurant owner status
     */
    public function changeStatus(Request $request)
    {
        $response = array();
        $statusCode = 200;

        if (isset($request->userId) && !empty($request->userId)) {
            $userModel = User::find($request->userId);
            if ($request->status == 0) {
                $statusUpdate = 1;
                $userModel->status = 1;
            } else {
                $statusUpdate = 0;
                $userModel->status = 0;
            }
            $results = $userModel->updateUser($request);

            if ($results == true) {
                $response['status'] = 1;
                $response['statusUpdate'] = $statusUpdate;
                $response['message'] = 'Status updated successfully.';
            } else {
                $response['status'] = '0';
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        } else {
            $response['status'] = '0';
            $response['message'] = 'Opps.. something went wrong, please try again.';
        }

        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: View edit restaurant
     */
    public function viewEditRestaurant(Request $request)
    {
        $employeeObj = GlobalHelper::getUserDetail($request->id); // Get employee details
        $restaurantSettingsObj = GlobalHelper::getRestaurantSettings($request->id); // Get restaurant settings

        if (empty($employeeObj)) {
            return redirect('admin/restaurants');
        }

        return view('admin.restaurants.edit', ['employeeObj' => $employeeObj, 'restaurantSettingsObj' => $restaurantSettingsObj]);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit restaurant details
     */
    public function editRestaurant(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        // Check same email
        $userRecord = DB::table('users')->select('email')
                        ->where('userId', '=', $request->userId)
                        ->get();

        if ($userRecord[0]->email == $request->email):
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|email|max:50|min:2',
                'cellPhone' => 'required|min:8|max:20|regex:/^[0-9]+$/',
                'city' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'required|min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'required|min:3|max:15|regex:/^[a-zA-Z ]+$/i',
            );
        else:
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|unique:users|email|max:50|min:2',
                'cellPhone' => 'required|min:8|max:20|regex:/^[0-9]+$/',
                'city' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'required|min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'required|min:3|max:15|regex:/^[a-zA-Z ]+$/i',
            );
        endif;

        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            // Call google api to get latitude & longitude for restaurant location
            $googleQuery = $request->city.', '.$request->state;
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

            $userModel = User::find($request->userId);
            $userModel->firstName = trim($request->firstName);
            $userModel->lastName = trim($request->lastName);
            $userModel->email = trim($request->email);
            $userModel->restaurantName = trim($request->restaurantName);
            $userModel->restaurantSlug = trim(str_slug($request->restaurantName));
            $userModel->cellPhone = trim($request->cellPhone);
            $userModel->city = trim($request->city);
            $userModel->state = trim($request->state);
            $userModel->zipcode = trim($request->zipcode);
            $userModel->county = trim($request->country);
            $userModel->latitude = $latitude;
            $userModel->longitude = $longitude;
            $userModel->scheduleStartDay = trim($request->scheduleStartDay);

            $results = $userModel->updateUser($request);

            // Add new schedules
            if (isset($request->addSchedule) && !empty($request->addSchedule)) {
                $schedules = preg_replace('/\s*,\s*/', ',', trim($request->addSchedule));
                $schedulesArr = explode(',', $schedules);

                for ($s=0; $s<count($schedulesArr); $s++) {
                    $ScheduleCategoriesMaster = new ScheduleCategoriesMaster();
                    $ScheduleCategoriesMaster->ownerId = $request->userId;
                    $ScheduleCategoriesMaster->scheduleCategoryName = $schedulesArr[$s];
                    $ScheduleCategoriesMaster->createdBy = Auth::user()->userId;
                    $ScheduleCategoriesMaster->save();
                }
            }

            // Add new dayparts
            if (isset($request->addDayparts) && !empty($request->addDayparts)) {
                $dayparts = preg_replace('/\s*,\s*/', ',', trim($request->addDayparts));
                $daypartsArr = explode(',', $dayparts);

                for ($d=0; $d<count($daypartsArr); $d++) {
                    $ShiftDayPartMaster = new ShiftDayPartMaster();
                    $ShiftDayPartMaster->ownerId = $request->userId;
                    $ShiftDayPartMaster->dayPartName = $daypartsArr[$d];
                    $ShiftDayPartMaster->createdBy = Auth::user()->userId;
                    $ShiftDayPartMaster->save();
                }
            }

            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'Owner details updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Change restaurant user avatar
     */
    public function changeAvatar(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'avatar' => 'required|image|max:3000',
            'userId' => 'required',
        );
        $messages = [
            'avatar.required' => 'Please upload your avatar.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $avatar = Input::file('avatar');
            $input = array('avatar' => $avatar);
            $destinationPath = 'resources/assets/front/uploads/profile-picture/';
            $filename = md5(microtime() . $avatar->getClientOriginalName()) . "." . $avatar->getClientOriginalExtension();
            Input::file('avatar')->move($destinationPath, $filename);

            $userModel = User::find($request->userId);
            $userModel->photo = $filename;

            $results = $userModel->updateUser($request);

            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'Avatar updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Change restaurant user logo
     */
    public function changeLogo(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'dashboarLogo' => 'required|image|max:3000',
            'jobLogo' => 'required|image|max:3000',
            'userId' => 'required',
        );
        $messages = [
            'dashboarLogo.required' => 'Please upload your restaurant logo.',
            'jobLogo.required' => 'Please upload your restaurant logo.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $destinationPath = 'resources/assets/front/uploads/restaurant-logo/';

            // For dashboard logo
            $dashboarLogo = Input::file('dashboarLogo');
            $input = array('dashboarLogo' => $dashboarLogo);
            $dashboarLogoFileName = md5(microtime() . $dashboarLogo->getClientOriginalName()) . "." . $dashboarLogo->getClientOriginalExtension();
            Input::file('dashboarLogo')->move($destinationPath, $dashboarLogoFileName);

            // For jobs logo
            $jobLogo = Input::file('jobLogo');
            $input = array('jobLogo' => $jobLogo);
            $jobLogoFileName = md5(microtime() . $jobLogo->getClientOriginalName()) . "." . $jobLogo->getClientOriginalExtension();
            Input::file('jobLogo')->move($destinationPath, $jobLogoFileName);

            $RestaurantSettings = RestaurantSettings::updateOrCreate([
                // attribute / attributes to check in the db . if available then update the attributes from second  array else create one from second array.
                'ownerId' => $request->userId
            ],
            [
                // new attribute values that you want to create or update
                'ownerId' => $request->userId,
                'dashboardLogo' => $dashboarLogoFileName,
                'jobLogo' => $jobLogoFileName,
                'createdBy' => Auth::user()->userId,
            ]);

            if (!empty($RestaurantSettings)) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'Restaurant logo updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: View add restaurant
     */
    public function viewAddRestaurant(Request $request)
    {
        return view('admin.restaurants.add');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit schedule category
     */
    public function editScheduleCategory(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'scheduleId' => 'required',
            'scheduleName' => 'required|max:254|regex:/^[a-zA-Z0-9 ]+$/i',
        );
        $messages = [

        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $scheduleCategoriesMasterModel = ScheduleCategoriesMaster::find($request->scheduleId);
            $scheduleCategoriesMasterModel->scheduleCategoryName = trim($request->scheduleName);
            $results = $scheduleCategoriesMasterModel->updateScheduleCategories($request);

            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array("scheduleCategoryName" => $request->scheduleName);
                $response['message'] = 'Schedule category name updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit daypart name
     */
    public function editDaypartName(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'daypartId' => 'required',
            'daypartName' => 'required|max:254|regex:/^[a-zA-Z ]+$/i',
        );
        $messages = [

        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $shiftDayPartMasterModel = ShiftDayPartMaster::find($request->daypartId);
            $shiftDayPartMasterModel->dayPartName = trim($request->daypartName);
            $results = $shiftDayPartMasterModel->updateDaypart($request);

            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array("daypartName" => $request->daypartName);
                $response['message'] = 'Daypart name updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Remove schedule category
    */
    public function removeScheduleCategory(Request $request)
    {
        $response = [ 'data' => [] ];
        $statusCode = 200;

        try {
            $rules = array(
                'scheduleCategoryId' => 'required'
            );
            $messages = [

            ];

            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = $validator->errors();
            } else {
                $ScheduleCategoriesMaster = ScheduleCategoriesMaster::find($request->scheduleCategoryId);
                $ScheduleCategoriesMaster->removeScheduleCategories($request);

                if ($ScheduleCategoriesMaster == true) {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = 'Schedule category deleted successfully.';
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
     * Description: Remove daypart name
    */
    public function removeDaypartName(Request $request)
    {
        $response = [ 'data' => [] ];
        $statusCode = 200;

        try {
            $rules = array(
                'dayPartId' => 'required'
            );
            $messages = [

            ];

            $validator = Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = $validator->errors();
            } else {
                $ShiftDayPartMaster = ShiftDayPartMaster::find($request->dayPartId);
                $ShiftDayPartMaster->removeDaypart($request);

                if ($ShiftDayPartMaster == true) {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = 'Daypart deleted successfully.';
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
     * Description: Add restaurant details
     */
    public function addRestaurant(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'firstName' => 'required|max:35|regex:/^[a-zA-Z]+$/i|',
            'lastName' => 'required|max:35|regex:/^[a-zA-Z]+$/i|',
            'email' => 'required|email|unique:users|max:35',
            'restaurantName' => 'required|unique:users|max:254',
            'cellPhone' => 'required|min:8|max:20|regex:/^[0-9]+$/',
            'city' => 'required|max:50|min:3|regex:/^[a-zA-Z ]+$/i',
            'state' => 'required|max:50|min:3|regex:/^[a-zA-Z ]+$/i',
            'zipcode' => 'required|max:15',
            'country' => 'required|max:30|regex:/^[a-zA-Z ]+$/i',
            'schedule' => 'required',
            'dayparts' => 'required|max:254|regex:/^[a-zA-Z ]+$/i',
        );
        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $passwordString = date("Ymd").'!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
            $password = substr(str_shuffle($passwordString), 0, 12);

            $googleQuery = $request->city.', '.$request->state;
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
            $users->firstName = trim($request->firstName);
            $users->lastName = trim($request->lastName);
            $users->username = trim(strtolower($request->firstName)).'-'.trim(strtolower($request->lastName));
            $users->email = trim($request->email);
            $users->password = Hash::make($password);
            $users->restaurantName = trim($request->restaurantName);
            $users->restaurantSlug = trim(str_slug($request->restaurantName));
            $users->cellPhone = trim($request->cellPhone);
            $users->city = trim($request->city);
            $users->state = trim($request->state);
            $users->zipcode = trim($request->zipcode);
            $users->county = trim($request->country);
            $users->latitude = trim($latitude);
            $users->longitude = trim($longitude);
            $users->state = trim($request->state);
            $users->scheduleStartDay = trim($request->scheduleStartDay);
            $users->createdBy = Auth::user()->userId;

            if ($users->save()) {
                // Insert to role to users_role table
                $role = new Role();
                $role->userId = $users->userId;
                $role->roleType = "1";
                if ($role->save()) {
                    if (!empty($request->schedule)) {
                        // Insert schedule names to schedule_categories_master table
                        $scheduleName = $request->schedule;
                        $scheduleName = preg_replace('/\s*,\s*/', ',', $scheduleName);
                        $scheduleArr = explode(',', $scheduleName);
                        for ($s=0; $s<count($scheduleArr); $s++) {
                            $ScheduleCategoriesMaster = new ScheduleCategoriesMaster();
                            $ScheduleCategoriesMaster->ownerId = $users->userId;
                            $ScheduleCategoriesMaster->scheduleCategoryName = $scheduleArr[$s];
                            $ScheduleCategoriesMaster->sortOrder = $s+1;
                            $ScheduleCategoriesMaster->createdBy = Auth::user()->userId;
                            $ScheduleCategoriesMaster->save();
                        }

                        // Insert dayspart to shift_day_part_master table
                        $dayParts = preg_replace('/\s*,\s*/', ',', $request->dayparts);
                        $dayPartsArr = explode(',', $dayParts);
                        for ($d=0; $d<count($dayPartsArr); $d++) {
                            $ShiftDayPartMaster = new ShiftDayPartMaster();
                            $ShiftDayPartMaster->ownerId = $users->userId;
                            $ShiftDayPartMaster->dayPartName = $dayPartsArr[$d];
                            $ShiftDayPartMaster->createdBy = Auth::user()->userId;
                            $ShiftDayPartMaster->save();
                        }

                        // Send data to email template
                        $userDetails['logo'] = env('MAIL_LOGO');
                        $userDetails['name'] = trim($request->firstName).' '.trim($request->lastName);
                        $userDetails['username'] = trim(strtolower($request->firstName)).'-'.trim(strtolower($request->lastName));
                        $userDetails['email'] = trim($request->email);
                        $userDetails['password'] = $password;

                        Mail::send('template.accountCreated', ['userDetails' => $userDetails], function ($m) use ($userDetails){
                            $userEmail = trim($userDetails['email']);

                            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
                            $m->to($userEmail, env('MAIL_NAME'))->subject('Welcome to Portalic.us');
                        });

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
        }

        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Load restaurant employees listing blade
     */
    public function restaurantEmployeesIndex()
    {
        return view('admin.employees.listing');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get all restaurant employees listing
     */
    public function restaurantEmployeesListing(Request $request)
    {
        $restaurantName = request()->segment(2);
        $ownerId = request()->segment(5);

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

        $filter['firstName'] = "";
        $filter['lastName'] = "";
        $filter['birthday'] = "";
        $filter['email'] = "";
        $filter['hireDate'] = "";
        $filter['cellPhone'] = "";
        $filter['city'] = "";
        $filter['state'] = "";
        $filter['zipcode'] = "";
        $filter['county'] = "";
        $filter['wagePrimaryCategoryId'] = "";
        $filter['adminAccess'] = "";
        $filter['createdAt'] = "";
        $filter['status'] = "";
        $filter['sAction'] = "";

        if (isset($request->firstName))
            $filter['firstName'] = $request->firstName;

        if (isset($request->lastName))
            $filter['lastName'] = $request->lastName;

        if (isset($request->birthday))
            $filter['birthday'] = $request->birthday;

        if (isset($request->email))
            $filter['email'] = $request->email;

        if (isset($request->hireDate))
            $filter['hireDate'] = $request->hireDate;

        if (isset($request->cellPhone))
            $filter['cellPhone'] = $request->cellPhone;

        if (isset($request->city))
            $filter['city'] = $request->city;

        if (isset($request->state))
            $filter['state'] = $request->state;

        if (isset($request->zipcode))
            $filter['zipcode'] = $request->zipcode;

        if (isset($request->county))
            $filter['county'] = $request->county;

        if (isset($request->wagePrimaryCategoryId))
            $filter['wagePrimaryCategoryId'] = $request->wagePrimaryCategoryId;

        if (isset($request->adminAccess))
            $filter['adminAccess'] = $request->adminAccess;

        if (isset($request->createdAt))
            $filter['createdAt'] = $request->createdAt;

        if (isset($request->status))
            $filter['status'] = $request->status;

        if (isset($request->globalSearch))
            $filter['globalSearch'] = $request->globalSearch;

        if (isset($request->sAction))
            $filter['sAction'] = $request->sAction;

        // Delete employees
        if ($sGroupActionName == "Delete") {
            $action_id = $request->id; // Get action id from array
            $action_id = explode(",", $action_id[0]);

            if (!empty($action_id)) {
                for ($a=0; $a<count($action_id); $a++) {
                    $getParentUsersObj = GlobalHelper::getParentUsers($action_id[$a]);
                    if (!empty($getParentUsersObj)) {
                        $i = 0;
                        $len = count($getParentUsersObj);
                        for ($u=0; $u<count($getParentUsersObj); $u++) {
                            DB::table('users')
                                ->where('userId', $getParentUsersObj[$u]->userId)
                                ->update(['userParentId' => $ownerId]);

                            if ($i == $len - 1) {
                                $deleteEmployeeRecord = $this->UserModel->deleteEmployee($action_id[$a]);
                            }

                            $i++;
                        }
                    } else {
                        $deleteEmployeeRecord = $this->UserModel->deleteEmployee($action_id[$a]);
                    }
                }
            }
        }

        $counts = $this->UserModel->getRestaurantEmployeesCount($filter, $ownerId);

        $iTotalRecords  = $counts;
        $iDisplayLength = intval($request->iDisplayLength);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($request->iDisplayStart);
        $sEcho          = intval($request->sEcho);

        $Data = $this->UserModel->getAllRestaurantEmployeesRecords($iSortCol, $sSortDir, $sGroupActionName, $iDisplayStart, $iDisplayLength, $filter, $request, $ownerId);

        $records           = array();
        $records["aaData"] = array();
        $end               = $iDisplayStart + $iDisplayLength;
        $end               = $end > $iTotalRecords ? $iTotalRecords : $end;

        $offset = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            if (isset($Data[$offset]->userId) && !empty($Data[$offset]->userId)) {
                $userId = $Data[$offset]->userId;
            } else {
                $userId = "";
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

            if (isset($Data[$offset]->reasturantOwnerId) && !empty($Data[$offset]->reasturantOwnerId)) {
                $reasturantOwnerId = $Data[$offset]->reasturantOwnerId;
            } else {
                $reasturantOwnerId = "";
            }

            if (isset($Data[$offset]->birthday) && !empty($Data[$offset]->birthday)) {
                $birthday = $Data[$offset]->birthday;
                if ($birthday == "0000-00-00") {
                    $birthday = "";
                } else {
                    $birthday = date("d/m/Y", strtotime($birthday));
                }
            } else {
                $birthday = "";
            }

            if (isset($Data[$offset]->email) && !empty($Data[$offset]->email)) {
                $email = $Data[$offset]->email;
            } else {
                $email = "";
            }

            if (isset($Data[$offset]->hireDate) && !empty($Data[$offset]->hireDate)) {
                $hireDate = $Data[$offset]->hireDate;

                if ($hireDate == "0000-00-00") {
                    $hireDate = "";
                } else {
                    $hireDate = date("d/m/Y", strtotime($hireDate));
                }
            } else {
                $hireDate = "";
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

            if (isset($Data[$offset]->zipcode) && !empty($Data[$offset]->zipcode)) {
                $zipcode = $Data[$offset]->zipcode;
            } else {
                $zipcode = "";
            }

            if (isset($Data[$offset]->county) && !empty($Data[$offset]->county)) {
                $county = $Data[$offset]->county;
            } else {
                $county = "";
            }

            if (isset($Data[$offset]->scheduleCategoryName) && !empty($Data[$offset]->scheduleCategoryName)) {
                $wagePrimaryCategoryId = $Data[$offset]->scheduleCategoryName;
            } else {
                $wagePrimaryCategoryId = "";
            }

            if (isset($Data[$offset]->adminAccess) && !empty($Data[$offset]->adminAccess)) {
                $adminAccess = $Data[$offset]->adminAccess;
                if ($adminAccess == 1) {
                    $adminAccess = "Yes";
                }
            } else {
                $adminAccess = "No";
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
                    $statusCode = '<a class="rowStatus" data-status="1" href="javascript:;" id="'.$userId.'"><span class="label label-sm label-success ">Active</span></a>';
                } else if($status == 0) {
                    $statusCode = '<a class="rowStatus" data-status="0" href="javascript:;" id="'.$userId.'"><span class="label label-sm label-info">Inactive</span></a>';
                }
            } else {
                $status = "";
                $statusCode = "";
            }

            $action = '
            <a href="'.url('admin/'.$restaurantName.'/'.$reasturantOwnerId.'/employee/edit/'.$userId.'').'" id="'.$userId.'" class="btn btn-xs default edit-action"><i class="fa fa-edit"></i> Edit</a>
            <a href="javascript:;" id="'.$userId.'" class="btn btn-xs default delete-action"><i class="fa fa-trash-o"></i> Delete</a>';

            $records["aaData"][] = array(
                '<input id="$userId" type="checkbox" name="id[]" value="'.$userId.'">',
                $firstName,
                $lastName,
                $birthday,
                $email,
                $hireDate,
                $cellPhone,
                $city,
                $state,
                $zipcode,
                $county,
                $wagePrimaryCategoryId,
                $adminAccess,
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

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: View add employee
     */
    public function viewAddEmployee(Request $request)
    {
        return view('admin.employees.add');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Add employee
     */
    public function addEmployee(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
            'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
            'email' =>'required|unique:users|email|max:50|min:2',
            'homePhone' => 'min:8|max:20|regex:/^[0-9]+$/',
            'cellPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
            'emergencyPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
            'city' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
            'state' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
            'zipcode' => 'min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
            'country' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
            'reasturantOwnerId' =>'required',
        );

        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $userModel = new User();

            $passwordString = date("Ymd").'!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
            $password = substr(str_shuffle($passwordString), 0, 12);
            $userModel->firstName = $request->firstName;
            $userModel->lastName = $request->lastName;
            $userModel->username = trim(strtolower($request->firstName)).'-'.trim(strtolower($request->lastName));
            $userModel->reasturantOwnerId = $request->reasturantOwnerId;
            $userModel->userParentId = $request->reasturantOwnerId;
            if ($request->birthday != "") {
                $userModel->birthday = date('Y-m-d', strtotime($request->birthday));
            }

            if ($request->hireDate != "") {
                $userModel->hireDate = date('Y-m-d', strtotime($request->hireDate));
            }
            $userModel->email = $request->email;
            $userModel->password = Hash::make($password);
            $userModel->homePhone = $request->homePhone;
            $userModel->cellPhone = $request->cellPhone;
            $userModel->wirelessCarrierId = $request->wirelessCarrierId;
            $userModel->emergencyPhone = $request->emergencyPhone;
            $userModel->address = $request->address;
            $userModel->city = $request->city;
            $userModel->state = $request->state;
            $userModel->zipcode = $request->zipcode;
            $userModel->county = $request->country;

            if (isset($request->adminAccess)) {
                $userModel->adminAccess = 1;
                $userModel->flyNotesAccess = 1;
                $userModel->schedules = json_encode($request->schedules);
            } else {
                if (isset($request->flyNotesAccess)) {
                    $userModel->flyNotesAccess = 1;
                }
                $userModel->schedules = '';
            }

            $userModel->specialManagerNotes = $request->specialManagerNotes;
            if ($request->wagePrimaryCategoryId!='0') {
                $userModel->wagePrimaryCategoryId = $request->wagePrimaryCategoryId;
            }

            $userModel->wage = $request->wage;
            $userModel->wageType = $request->wageType;
            $altPrimaryCat = $request->altPrimaryCat;
            $altPrimarywage = $request->altPrimarywage;
            $data['altPrimaryCat'] = $altPrimaryCat;
            $data['altPrimarywage'] = $altPrimarywage;
            $userModel->alternateWages = json_encode($data);

            if ($userModel->save()) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = "Employee created successfully and login credentials sent to employee via email.";

                $roleModel = new Role();
                $roleModel->userId = $userModel->userId;
                if (isset($request->adminAccess)) {
                    $roleModel->roleType = 2;
                } else {
                    $roleModel->roleType = 3;
                }

                if (!$roleModel->save()) {
                    echo "Role is not saved"; exit;
                    return redirect('admin/restaurants');
                }

                $reminderModel = new Reminders();
                if (($request->wagePrimaryCategoryId!='0') and ($request->reminderDate!='') and ($request->description!="") ){
                    $ownerId = GlobalHelper::getOwnerId();

                    $reminderModel->ownerId = $ownerId;
                    $reminderModel->scheduleCategoryId = $request->scheduleCategoryId;
                    $reminderModel->userId = $userModel->userId;
                    $reminderModel->reminderDate = date('Y-m-d',strtotime($request->reminderDate));
                    $reminderModel->description = $request->description;
                    $reminderModel->createdBy = $request->reasturantOwnerId;

                    if (!$reminderModel->save()) {
                        echo "Reminder is not saved"; exit;
                        return redirect('admin/restaurants');
                    }
                }

                $mailDetails['logo'] = env('MAIL_LOGO');
                $mailDetails['name'] = trim($request->firstName).' '.trim($request->lastName);
                $mailDetails['email'] = trim($request->email);
                $mailDetails['password'] = trim($password);

                Mail::send('template.accountCreated', ['userDetails' => $mailDetails], function ($m) use ($mailDetails){
                    $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
                    $m->to($mailDetails['email'], $mailDetails['name'])->bcc('manan.letsnurture@gmail.com')->subject('Welcome to Portalic.us');
                });
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: View edit employee
     */
    public function viewEditEmployee(Request $request)
    {
        return view('admin.employees.edit');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit employee
     */
    public function editEmployee(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        // Check same email
        $userRecord = DB::table('users')->select('email')
                        ->where('userId', '=', $request->userId)
                        ->get();

        if ($userRecord[0]->email == $request->email):
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|email|max:50|min:2',
                'homePhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'cellPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'emergencyPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'address' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'city' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'avatar' => 'image|max:3000',
                'specialManagerNotes' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'description' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'reasturantOwnerId' =>'required',
                'userId' =>'required',
            );
        else:
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|unique:users|email|max:50|min:2',
                'homePhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'cellPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'emergencyPhone' => 'min:8|max:20|regex:/^[0-9]+$/',
                'address' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'city' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'avatar' => 'image|max:3000',
                'specialManagerNotes' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'description' => 'min:3|max:254|regex:/^[a-zA-Z0-9 \.,-]+$/i',
                'reasturantOwnerId' => 'required',
                'userId' => 'required',
            );
        endif;

        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $userModel = User::find($request->userId);
            $userModel->firstName = $request->firstName;
            $userModel->lastName = $request->lastName;
            if ($request->birthday != "") {
                $userModel->birthday = date('Y-m-d', strtotime($request->birthday));
            }

            if ($request->hireDate != "") {
                $userModel->hireDate = date('Y-m-d', strtotime($request->hireDate));
            }
            $userModel->email = $request->email;
            $userModel->homePhone = $request->homePhone;
            $userModel->cellPhone = $request->cellPhone;
            $userModel->wirelessCarrierId = $request->wirelessCarrierId;
            $userModel->emergencyPhone = $request->emergencyPhone;
            $userModel->address = $request->address;
            $userModel->city = $request->city;
            $userModel->state = $request->state;
            $userModel->zipcode = $request->zipcode;
            $userModel->county = $request->country;

            $avatar = Input::file('avatar');
            if (!empty($avatar)) {
                $input = array('avatar' => $avatar);
                $destinationPath = 'resources/assets/front/uploads/profile-picture/';
                $filename = md5(microtime() . $avatar->getClientOriginalName()) . "." . $avatar->getClientOriginalExtension();
                Input::file('avatar')->move($destinationPath, $filename);
                $userModel->photo = $filename;
            }

            if (isset($request->adminAccess)) {
                $userModel->adminAccess = 1;
                $userModel->flyNotesAccess = 1;
                $userModel->schedules = json_encode($request->schedules);
            } else {
                $userModel->adminAccess = 0;
                if (isset($request->flyNotesAccess)) {
                    $userModel->flyNotesAccess = 1;
                }
                $userModel->schedules = '';
            }

            $userModel->specialManagerNotes = $request->specialManagerNotes;
            if ($request->wagePrimaryCategoryId!='0') {
                $userModel->wagePrimaryCategoryId = $request->wagePrimaryCategoryId;
            }

            $userModel->updatedBy = Auth::user()->userId;
            $userModel->updatedAt = date('Y-m-d H:i:s');

            if ($userModel->save()) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = "Employee updated successfully.";

                if (isset($request->adminAccess)) {
                    DB::table('users_role')->where('userId', $userModel->userId)->update(['roleType' => '2']);
                } else {
                    DB::table('users_role')->where('userId', $userModel->userId)->update(['roleType' => '3']);

                    $newParentId = GlobalHelper::getParentId($userModel->userId);
                    DB::table('users')->where('userParentId', $userModel->userId)->update(['userParentId' => $newParentId]);
                }

                $remindesDetail = DB::table('reminders')->where('userId', '=', $request->userId)->get();
                if (!empty($remindesDetail)) {
                    $reminderModel = new Reminders();
                    if (($request->wagePrimaryCategoryId!='0')) {
                        if ($request->reminderDate=="" || $request->description=="") {
                            DB::table('reminders')->where('userId', '=', $userModel->userId)->delete();
                        } else {
                            $reminderModel = Reminders::find($remindesDetail[0]->reminderId);
                            $reminderModel->scheduleCategoryId = $request->scheduleCategoryId;
                            $reminderModel->reminderDate = date('Y-m-d',strtotime($request->reminderDate));
                            $reminderModel->description = $request->description;
                            if (!$reminderModel->save()) {
                                echo "Reminder is not update"; exit;
                                return redirect('admin/restaurants');
                            }
                        }
                    }
                } else {
                    $reminderModel = new Reminders();
                    if (($request->wagePrimaryCategoryId!='0') and ($request->reminderDate!='') and ($request->description!="")) {
                        $ownerId = GlobalHelper::getOwnerId();

                        $reminderModel->ownerId = $ownerId;
                        $reminderModel->scheduleCategoryId = $request->scheduleCategoryId;
                        $reminderModel->userId = $userModel->userId;
                        $reminderModel->reminderDate = date('Y-m-d',strtotime($request->reminderDate));
                        $reminderModel->description = $request->description;
                        $reminderModel->createdBy = $request->reasturantOwnerId;

                        if (!$reminderModel->save()) {
                            echo "Reminder is not saved"; exit;
                            return redirect('admin/restaurants');
                        }
                    }
                }
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }

        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Load my profile blade
     */
    public function myProfileIndex()
    {
        return view('admin.myProfile.edit');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit my profile details
     */
    public function editMyProfile(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        // Check same email
        $userId = Auth::user()->userId;
        $userRecord = DB::table('users')->select('email')
                        ->where('userId', '=', $userId)
                        ->get();

        if ($userRecord[0]->email == $request->email):
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|email|max:50|min:2',
                'cellPhone' => 'required|min:8|max:20|regex:/^[0-9]+$/',
                'city' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'required|min:2|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'required|min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'required|min:3|max:15|regex:/^[a-zA-Z ]+$/i',
            );
        else:
            $rules = array(
                'firstName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'lastName' =>'required|max:35|regex:/^[a-zA-Z]+$/i|',
                'email' =>'required|unique:users|email|max:50|min:2',
                'cellPhone' => 'required|min:8|max:20|regex:/^[0-9]+$/',
                'city' => 'required|min:3|max:30|regex:/^[a-zA-Z ]+$/i',
                'state' => 'required|min:2|max:30|regex:/^[a-zA-Z ]+$/i',
                'zipcode' => 'required|min:3|max:15|regex:/^[a-zA-Z0-9]+$/i',
                'country' => 'required|min:3|max:15|regex:/^[a-zA-Z ]+$/i',
            );
        endif;

        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            // Call google api to get latitude & longitude for restaurant location
            $googleQuery = $request->city.', '.$request->state;
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

            $userModel = User::find($userId);
            $userModel->firstName = trim($request->firstName);
            $userModel->lastName = trim($request->lastName);
            $userModel->username = str_slug(trim($request->firstName).' '.trim($request->lastName));
            $userModel->email = trim($request->email);
            $userModel->cellPhone = trim($request->cellPhone);
            $userModel->city = trim($request->city);
            $userModel->state = trim($request->state);
            $userModel->zipcode = trim($request->zipcode);
            $userModel->county = trim($request->country);
            $userModel->latitude = $latitude;
            $userModel->longitude = $longitude;

            $results = $userModel->updateUser($request);
            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'My profile details updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Change password
     */
    public function changePassword(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        );

        $messages = [

        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $userModel = User::find($request->userId);
            $userModel->password = Hash::make($request->password);

            $results = $userModel->updateUser($request);
            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'New password updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }
}
