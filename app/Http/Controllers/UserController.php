<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Session;
use App;
use Validator;
use Exception;
use Auth;
use App\JobAwarded;
class UserController extends Controller
{
  public $objUser;

  public function __construct(){
    $this->objUser=new User();
  }

  public function verifyUser($verifyLink){
    $result = User::where('activation_code',$verifyLink)->update(['activation_code'=>'','status'=>'1']);
    if($result){
      Session::flash('message', 'Congratulation...!!! Your account is verified successfully. Your account will active soon.');
      return redirect("/");
    }else {
      App::abort(404);
    }
  }

  public function userDetail($userid){
    $userDetail = User::find($userid);
    $job_seeker_id = Auth::user()->id;
    if(Auth::user()->role=="JOB_SEEKER"){
      // then we have to check a job seeker have any job awarded by this user. I mean this job poster.
      $is_awarded = JobAwarded::where('job_seeker_id','=',$job_seeker_id)->where('job_poster_id','=',$userid)->count();
      if($is_awarded>0){
        $selectedUserDetail = User::select('first_name','last_name','image','company_name','email','company_link','street_address1','street_address2','city','state','zip','country','phone')->where('id',$userid)->first();
      }else {
        $selectedUserDetail = User::select('first_name','last_name','image')->where('id',$userid)->first();
      }
      $selectedUserDetail['image'] = "jobposter/".$selectedUserDetail['image'];

    }else {
      // if user is a job poster then he can see all details of job seeker
      $selectedUserDetail = User::find($userid);
      if($selectedUserDetail['image']!=""){
        $selectedUserDetail->image = "jobseeker/".$selectedUserDetail['image'];
        $selectedUserDetail['average_rating']=User::getAveragerating($userid);
        $selectedUserDetail['user']='job_seeker';
      }
    }
    // dd($selectedUserDetail);
    return view('userdetail',compact('selectedUserDetail'));
  }

  public function unsubscribe(Request $request){
    $data=$request->json()->get('data');
    $statusCode=200;
    try{
      $rules = array(
        'subscr_id' => 'required'
      );
      $messages = [
         'subscr_id.required' => 'Please choose proper job'
        ];
        $validator = Validator::make($data, $rules,$messages);

        if($validator->fails()) {
          $response['status'] = "0";
          $response['data'] = array();
          $response['message'] = $validator->errors()->first();
        }else{
          $res = $this->change_subscription_status($data['subscr_id'],'Cancel');
          if($res['ACK']=="Success"){
            // success
            $data = Payment::where('subscr_id','=',$data['subscr_id'])->first();
            $data['is_subscr'] = '0';
            $data->update();
            $response['status']='1';
          }else {
            // that means try to unsubscribe again same package
            $data = Payment::where('subscr_id','=',$data['subscr_id'])->first();
            $data['is_subscr'] = '0';
            $data->update();
            $response['status']='-1';
          }
          $response['updated']=$statusCode;
        }
    }catch(Exception $e){
      $response['status']='0';
      $response['message']=$e->getMessage();
    }finally{
      return response()->json($response,$statusCode);
    }
  }

  public function change_subscription_status( $profile_id, $action ) {

      $api_request = 'USER=' . urlencode( 'nilesh.letsnurture-facilitator_api1.gmail.com' )//api_username
                  .  '&PWD=' . urlencode( '1390572361' )//api_password
                  .  '&SIGNATURE=' . urlencode( 'A6Yt.FZB4AC67.ZBEjifxWdTYLTSA8VUTxb5ZWDj1L.-mJvANKchE5am' )//api_signature
                  .  '&VERSION=76.0'
                  .  '&METHOD=ManageRecurringPaymentsProfileStatus'
                  .  '&PROFILEID=' . urlencode( $profile_id )
                  .  '&ACTION=' . urlencode( $action )
                  .  '&NOTE=' . urlencode( 'Profile cancelled at store' );

      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
      curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

      // Uncomment these to turn off server and peer verification
      // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
      // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch, CURLOPT_POST, 1 );

      // Set the API parameters for this transaction
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );

      // Request response from PayPal
      $response = curl_exec( $ch );

      // If no response was received from PayPal there is no point parsing the response
      if( ! $response )
          die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );

      curl_close( $ch );

      // An associative array is more usable than a parameter string
      parse_str( $response, $parsed_response );

      return $parsed_response;
  }
}
