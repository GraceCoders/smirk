<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Models
 * */

use App\Models\Ethnicity;


class EthnicitiesController extends Controller
{
    public function ethnicitiesList(Request $request, Ethnicity $ethnicity)
    {
        try {
            $formData = $request->all();
            $limit = $formData['length'];
            $offset = $formData['start'];
            $ethnicitiesList['draw'] = $formData['draw'];
            $userDetails['recordsTotal'] = $ethnicity->count();
            if (isset($formData['search']['value'])) {
                $search = $formData['search']['value'];
                $userDetails['data'] = $ethnicity->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                })->offset($offset)->limit($limit)->get();
                $userDetails['recordsFiltered'] = $ethnicity->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                })->count();
            } else {
                $userDetails['data'] = $ethnicity->offset($offset)->limit($limit)->get();
                $userDetails['recordsFiltered'] = $ethnicity->count();
            }

            return json_encode($userDetails);
        } catch (Exception $ex) {
            return view('exceptions', compact('ex'));
        }
    }
}