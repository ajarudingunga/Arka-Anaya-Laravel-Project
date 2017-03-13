<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use App\CMSPages;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helper\GlobalHelper;

class CMSPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $CMSPagesModel;

    public function __construct()
    {
        $this->CMSPagesModel = new CMSPages();
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Load cms pages listing blade
     */
    public function cmsPagesIndex()
    {
        return view('admin.cmsPages.listing');
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get all cms pages listing
     */
    public function cmsPagesListing(Request $request)
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

        $filter['title'] = "";
        //$filter['content'] = "";
        $filter['metaDescription'] = "";
        $filter['metaKeyword'] = "";
        $filter['createdAt'] = "";
        $filter['status'] = "";
        $filter['sAction'] = "";

        if (isset($request->pageId))
            $filter['pageId'] = $request->pageId;

        if (isset($request->title))
            $filter['title'] = $request->title;

        // if (isset($request->content))
        //     $filter['content'] = $request->content;

        if (isset($request->metaDescription))
            $filter['metaDescription'] = $request->metaDescription;

        if (isset($request->metaKeyword))
            $filter['metaKeyword'] = $request->metaKeyword;

        if (isset($request->createdAt))
            $filter['createdAt'] = $request->createdAt;

        if (isset($request->status))
            $filter['status'] = $request->status;

        if (isset($request->globalSearch))
            $filter['globalSearch'] = $request->globalSearch;

        if (isset($request->sAction))
            $filter['sAction'] = $request->sAction;

        $counts = $this->CMSPagesModel->getPagesCount($filter);

        $iTotalRecords  = $counts;
        $iDisplayLength = intval($request->iDisplayLength);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($request->iDisplayStart);
        $sEcho          = intval($request->sEcho);

        $Data = $this->CMSPagesModel->getAllPagesRecords($iSortCol, $sSortDir, $sGroupActionName, $iDisplayStart, $iDisplayLength, $filter, $request);

        $records           = array();
        $records["aaData"] = array();
        $end               = $iDisplayStart + $iDisplayLength;
        $end               = $end > $iTotalRecords ? $iTotalRecords : $end;

        $offset = 0;
        for ($i = $iDisplayStart; $i < $end; $i++) {
            if (isset($Data[$offset]->pageId) && !empty($Data[$offset]->pageId)) {
                $pageId = $Data[$offset]->pageId;
            } else {
                $pageId = "";
            }

            if (isset($Data[$offset]->title) && !empty($Data[$offset]->title)) {
                $title = $Data[$offset]->title;
            } else {
                $title = "";
            }

            if (isset($Data[$offset]->content) && !empty($Data[$offset]->content)) {
                $content = $Data[$offset]->content;
            } else {
                $content = "";
            }

            if (isset($Data[$offset]->metaDescription) && !empty($Data[$offset]->metaDescription)) {
                $metaDescription = $Data[$offset]->metaDescription;
            } else {
                $metaDescription = "";
            }

            if (isset($Data[$offset]->metaKeyword) && !empty($Data[$offset]->metaKeyword)) {
                $metaKeyword = $Data[$offset]->metaKeyword;
            } else {
                $metaKeyword = "";
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
                    $statusCode = '<a class="rowStatus" data-status="1" href="javascript:;" id="'.$pageId.'"><span class="label label-sm label-success ">Active</span></a>';
                } else if($status == 0) {
                    $statusCode = '<a class="rowStatus" data-status="0" href="javascript:;" id="'.$pageId.'"><span class="label label-sm label-info">Inactive</span></a>';
                }
            } else {
                $status = "";
                $statusCode = "";
            }

            $action = '<a href="'.url('admin/cms/page/edit/'.$pageId.'').'" id="'.$pageId.'" class="btn btn-xs default edit-action"><i class="fa fa-edit"></i> Edit</a>';

            $records["aaData"][] = array(
                '<input id="pageId" type="checkbox" name="id[]" value="'.$pageId.'">',
                $title,
                wordwrap($metaDescription, 30, "<br>\n"),
                wordwrap($metaKeyword, 30, "<br>\n"),
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
     * Description: Update cms page status
     */
    public function changeStatus(Request $request)
    {
        $response = array();
        $statusCode = 200;

        if (isset($request->pageId) && !empty($request->pageId)) {
            $CMSPagesModel = CMSPages::find($request->pageId);
            if ($request->status == 0) {
                $statusUpdate = 1;
                $CMSPagesModel->status = 1;
            } else {
                $statusUpdate = 0;
                $CMSPagesModel->status = 0;
            }
            $results = $CMSPagesModel->updateCMSPage($request);

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
     * Description: View edit cms page
     */
    public function viewEditCMSPage(Request $request)
    {
        $getCMSPageObj = GlobalHelper::getCMSPage($request->id); // Get cms page details

        if (empty($getCMSPageObj)) {
            return redirect('admin/cms/pages');
        }

        return view('admin.cmsPages.edit', ['getCMSPageObj' => $getCMSPageObj]);
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Edit cms page
     */
    public function editCMSPage(Request $request)
    {
        $statusCode = 200;
        $response['status'] = "0";
        $response['data'] = array();
        $response['message'] = '';

        $rules = array(
            'title' => 'required|max:50|regex:/^[a-zA-Z0-9 ]+$/i',
            'content' => 'required',
            // 'metaDescription' => 'regex:/^[a-zA-Z0-9 \.,-]+$/i',
            // 'metaKeyword' => 'regex:/^[a-zA-Z0-9 \.,-]+$/i',
        );
        $messages = [

        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $response['status'] = "0";
            $response['data'] = array();
            $response['message'] = $validator->errors();
        } else {
            $CMSPagesModel = CMSPages::find($request->pageId);
            $CMSPagesModel->title = trim($request->title);
            $CMSPagesModel->titleSlug = str_slug(trim($request->title));
            $CMSPagesModel->content = trim($request->content);
            $CMSPagesModel->metaDescription = trim($request->metaDescription);
            $CMSPagesModel->metaKeyword = trim($request->metaKeyword);
            $CMSPagesModel->updatedAt = date('Y-m-d H:i:s');
            $results = $CMSPagesModel->updateCMSPage($request);

            if ($results == true) {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = 'CMS page updated successfully.';
            } else {
                $response['status'] = "0";
                $response['data'] = array();
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
        return response()->json($response, $statusCode);
    }
}
