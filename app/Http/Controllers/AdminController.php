<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Answer;
use App\Models\Company;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
//        $advert = Advert::where('id','>',0)->paginate(1);
        $advert = Advert::all();
        $worker = User::all();
        $company = Company::all();

        return view('.page.admin.index', compact('advert', 'worker', 'company'));
    }

    public function searchAdmin(Request $req)
    {

        $text = $req->get('text');
        $table = $req->get('table');

        switch ($table) {
            case 'company':
                $data = Company::where('name', 'ilike', '%' . $text . '%')->get();
                $view = view('.page.admin.company-item', ['company' => $data])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
            case 'user':
                $data = User::where('name', 'ilike', '%' . $text . '%')->orWhere('email', 'ilike', '%' . $text . '%')->get();
                $view = view('.page.admin.worker-item', ['worker' => $data])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;
            case 'advert':
                $data = Advert::where('title', 'ilike', '%' . $text . '%')->get();
                $view = view('.include.advert-filter-item', ['advert' => $data, 'admin' => true])->render();
                return response()->json([
                    'view' => $view
                ]);
                break;

        }
    }

    public function chageAccess(Request $req)
    {
        $table = $req->get('table');
        $action = $req->get('action');
        $id = $req->get('id');
//        dd($req->all());
        ///remove block
        if ($action == 'remove') {
            switch ($table) {
                case 'worker':
                    try {
                        $message = Message::where('user_id',$id)->delete();
                        Answer::where('user_id',$id)->delete();
                        $data = User::where('id', $id)->delete();
                        return response()->json([
                            'delete' => true
                        ]);
                    } catch (\Exception $e) {
                        dd($e);
                        return response()->json([
                            'delete' => false
                        ]);
                    }

                    break;
                case 'company':
                    try {
                        $message = Message::where('company_id',$id)->delete();
                        Advert::where('company_id',$id)->delete();
                        $data = Company::where('id', $id)->delete();
                        return response()->json([
                            'delete' => true
                        ]);
                    } catch (\Exception $e) {
                        dd($e);
                        return response()->json([
                            'delete' => false
                        ]);
                    }
                    break;
                case 'advert':
                    try {
                        Answer::where('advert_id',$id)->delete();
                        $data = Advert::where('id', $id)->delete();
                        return response()->json([
                            'delete' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'delete' => false
                        ]);
                    }
                    break;
            }
        }
        ////
        if ($action == 'block') {
            switch ($table) {
                case 'worker':
                    try {
                        $data = User::where('id', $id)->update(['block' => true]);
                        return response()->json([
                            'block' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'block' => false
                        ]);
                    }

                    break;
                case 'company':
                    try {
                        $data = Company::where('id', $id)->update(['block' => true]);
                        return response()->json([
                            'block' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'blcok' => false
                        ]);
                    }
                    break;
                case 'advert':
                    try {
                        $data = Advert::where('id', $id)->update(['block' => true]);
                        return response()->json([
                            'block' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'blcok' => false
                        ]);
                    }
            }
        }
        if ($action == 'unblock') {
            switch ($table) {
                case 'worker':
                    try {
                        $data = User::where('id', $id)->update(['block' => false]);
                        return response()->json([
                            'unblock' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'unblcok' => false
                        ]);
                    }

                    break;
                case 'company':
                    try {
                        $data = Company::where('id', $id)->update(['block' => false]);
                        return response()->json([
                            'unblock' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'unblcok' => false
                        ]);
                    }

                    break;
                case 'advert':
                    try {
                        $data = Advert::where('id', $id)->update(['block' => false]);
                        return response()->json([
                            'unblock' => true
                        ]);
                    } catch (\Exception $e) {
                        return response()->json([
                            'unblcok' => false
                        ]);
                    }

            }
        }


    }
}
