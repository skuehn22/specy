<?php

namespace App\Http\Controllers;

use App\DatabaseModels\PlanDocs;
use File;

use Illuminate\Http\Request;
use Validator, Auth, DateTime;
use App\DatabaseModels\Users;
use App\DatabaseModels\Companies;
use Carbon\Carbon;

class AjaxUploadController extends Controller
{
    function index()
    {
        return view('ajax_upload');
    }

    function indexFile()
    {
        return view('ajax_file_upload');
    }


    function action(Request $request)
    {

        //create unique timestamp for images
        //without the image from the cache is loading in the preview
        $date = new DateTime();
        $filename = $date->getTimestamp();

        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = $user->id. $filename . '.' . $image->getClientOriginalExtension();

            $company = Companies::where('id', '=', $user->service_provider_fk )
                ->first();

            if(isset($company)){
                $company->logo = $new_name;
                $company->save();
            }else{

                $user = Users::where('id', '=', $user->id )
                    ->first();

                $user->logo = $new_name;
                $user->save();
            }


            $image->move(public_path('uploads/companies/logo'), $new_name);
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/uploads/companies/logo/'.$new_name.'" class="img-thumbnail" width="300" /> <a href="#" style="color: #1b1e21" id="delete-image"><i class="fas fa-minus-circle"></i> delete</a>',
                'class_name'  => 'alert-success'
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    function delete(Request $request)
    {

        $user = Auth::user();

        $company = Companies::where('id', '=', $user->service_provider_fk )
            ->first();

        $company->logo = null;
        $company->save();

        return response()->json([
            'message'   => 'Image Deleted Successfully',
            'uploaded_image' => '<img src="/uploads/companies/logo/'.$user.'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-info'
        ]);

    }

    function contractUpload(Request $request)
    {

        //create unique timestamp for images
        //without the image from the cache is loading in the preview
        $date = new DateTime();
        //$filename = $date->getTimestamp();

        $user = Auth::user();

        $allowed_mimes = [
            "image/gif,
            image/png,
            image/jpeg,
            image/jpg,
            application/pdf"
        ];

        $validation = Validator::make($request->all(), [
            'image' => $allowed_mimes,
        ]);

        if($validation->passes())
        {
            $image = $request->file('select_file');
            $filename = $image->getClientOriginalName();
            $new_name = $filename . '.' . $image->getClientOriginalExtension();


            $doc = new PlanDocs();

            if(strlen($_POST['doc-name'])>0) {
                $doc->name = $_POST['doc-name'];
            }else{
                $doc->name = $new_name;
            }

            $doc->filename = $new_name;
            $doc->plan_id_fk = $_POST['plan'];
            $doc->save();

            $path = public_path().'/uploads/companies/contracts/' . $doc->plan_id_fk;
            File::makeDirectory($path, $mode = 0777, true, true);

            $image->move($path, $new_name);

            return response()->json([
                'message'   => 'File upload successful',
                'uploaded_image' => $_POST['plan'],
                'class_name'  => 'alert-success'
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }
}
?>