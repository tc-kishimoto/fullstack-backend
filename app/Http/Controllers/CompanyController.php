<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class CompanyController extends Controller
{
    public function all()
    {
        $result = Company::all();
        return response($result, 200);
    }

    public function getCompany(Request $request)
    {
        $company = Company::find($request->id);
        return response($company, 200);
    }

    public function search(Request $request)
    {
        $model = Company::select(
            "id","name"
            , DB::raw("'' img_path")
            , DB::raw("name link")
            , DB::raw("name link_title")
            , DB::raw("name explanation")
        );
        if($request->has('keyword')) {
            $model = $model->where(DB::raw("concat(name, short_name)"), 'like', '%' . $request->keyword . '%');
        }
        $result = $model->get();
        return response($result, 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $company = Company::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'url' => $request->url
        ]);

        return response($company, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $company = Company::find($request->id);
        $company->name = $request->name;
        $company->short_name = $request->short_name;
        $company->url = $request->url;
        $company->save();

        return response($company, 200);
    }

    public function delete(Request $request)
    {
        $company = Company::find($request->id);
        $company->delete();
        return response([], 200);
    }
}
