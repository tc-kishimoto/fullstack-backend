<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchContent;

class ContentController extends Controller
{
    public function search(Request $request)
    {
        $result = SearchContent::select('category', 'title')
        ->where('content', 'like', '%' . $request->keyword . '%')
        ->orderBy('category')
        ->orderBy('title')
        ->limit(20)
        ->get();

        return response($result, 200);
    }
}
