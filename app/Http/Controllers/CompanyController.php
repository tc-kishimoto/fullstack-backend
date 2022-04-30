<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class CompanyController extends Controller
{
    public function search(Request $request) {
        $result = Company::select(
            DB::raw("name link")
            , DB::raw("name link_title")
            , DB::raw("name explanation")
        )
        ->where(DB::raw("concat(name, short_name)"), 'like', '%' . $request->keyword . '%')
        ->get();

        return response($result, 200);
    }
}
