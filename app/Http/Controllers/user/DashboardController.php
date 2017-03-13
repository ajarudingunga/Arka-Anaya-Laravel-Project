<?php
namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use App\Helper\GlobalHelper;
use Input;
use Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use App\QuickLink;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }
}
