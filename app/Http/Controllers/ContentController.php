<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchContent;

class ContentController extends Controller
{
    public function search(Request $request)
    {
        $result = SearchContent::where('content', 'like', '%' . $request->keyword . '%')
        ->orderBy('category')
        ->orderBy('title')
        ->get();

        return response($result, 200);
    }
}
