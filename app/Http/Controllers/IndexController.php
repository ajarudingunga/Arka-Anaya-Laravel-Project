<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Exception;
use Validator;
use Input;
use App\Helper\GlobalHelper;
use Mail;
use App\Http\Controllers\Controller;
use App\User;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('user.index');
    }
}
