<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $menu;
    protected $url;
    protected $title;

    public function setResponse($status, $message, $data = null)
    {
        return response()->json([
            'success' => $status,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function checkAuth($roles)
    {
        //0=admin,1=manager,2=user
        $get_role = Auth::user()->level;
        if (!in_array($get_role, $roles)) {
            return redirect()->route('dashboard');
        }
    }

    public function removeUnused($request)
    {
        unset($request['_token']);
        unset($request['_method']);
    }
}
