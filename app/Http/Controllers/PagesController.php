<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page as Page;
use App\User;
class PagesController extends Controller
{
    public function single($slug){
        $singlePage=Page::where('slug', '=', $slug)->firstOrFail();
        return view ('frontend.pages.single')->withSinglePage($singlePage);
    }
    public function mainPage(){
        $mainPage=Page::where('slug', '=', 'main-page')->firstOrFail();
        return view ('frontend.pages.main')->withMainPage($mainPage);
    }
    // public function profile(){
    //     $user=User($id);
    //     $profile=Page::where('slug', '=', 'profile')->firstOrFail();
    //     return view ('frontend.pages.profile')->withProfile($profile);
    // }
    public function teachers(){
        $teacherPage=Page::where('slug', '=', 'teachers')->firstOrFail();
        $teachers=User::where('is_teacher', '=', '1')->get();
        return view ('frontend.pages.teachers')->withTeachers($teachers)->withTeacherPage($teacherPage);
    }
}
