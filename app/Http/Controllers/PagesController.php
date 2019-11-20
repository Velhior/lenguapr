<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page as Page;
use App\Review;
use App\User;
use App\Tariff;
use App\Order;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller
{
    public function single($slug){
        $singlePage=Page::where('slug', '=', $slug)->firstOrFail();
        if ($singlePage->status=='ACTIVE'){
        return view ('frontend.pages.single')->withSinglePage($singlePage);
        }
    }
    public function mainPage(){
        $tariffs=Tariff::all();
        $reviews=Review::all();
        $mainPage=Page::where('slug', '=', 'main-page')->firstOrFail();
        return view ('frontend.pages.main')->withMainPage($mainPage)->withTariffs($tariffs)->withReviews($reviews);
    }
    // public function profile(){
    //     $user=User($id);
    //     $profile=Page::where('slug', '=', 'profile')->firstOrFail();
    //     return view ('frontend.pages.profile')->withProfile($profile);
    // }
    public function teachers(){
        $user = Auth::user();
        $teacherPage=Page::where('slug', '=', 'teachers')->firstOrFail();
        $teachers=User::where('is_teacher', '=', '1')->get();
        $order = Order::where('user_id','=', $user->id)->first();
        foreach ($teachers as $teacher):
            $arr[]=$teacher->region;
        endforeach;
        $teachersRegions=array_unique($arr);
        foreach ($teachers as $teacher):
            $arr2[]=$teacher->speciality;
        endforeach;
        $teachersSpecialities=array_unique($arr2);    
        $date = date('Y-m-d h:i:s', time()); 
        return view ('frontend.pages.teachers')->withTeachers($teachers)->withTeacherPage($teacherPage)->withTeachersRegions($teachersRegions)->withTeachersSpecialities($teachersSpecialities)->withOrder($order)->withDate($date);
    }

}
