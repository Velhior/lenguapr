<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page as Page;
class PagesController extends Controller
{
    public function single($slug){
        $singlePage=Page::where('slug', '=', $slug)->firstOrFail();
        return view ('frontend.pages.single')->withSinglePage($singlePage);
    }
}
