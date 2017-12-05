<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    //
        
    public function makeSearch(Request $request) {
        
        $codeNumber = $request->input('codeNumber');
        echo $codeNumber;
        
        
        
        
    }
}
