<?php

namespace App\Http\Controllers;
use Session;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page as Page;

class SearchController extends Controller
{
    public function postSearch(Request $request) {
        $teacherPage=Page::where('slug', '=', 'teachers')->firstOrFail();
        $teachers=User::where('is_teacher', '=', '1')->get();
        foreach ($teachers as $teacher):
            $arr[]=$teacher->region;
        endforeach;
        $teachersRegions=array_unique($arr);
        foreach ($teachers as $teacher):
            $arr2[]=$teacher->speciality;
        endforeach;
        $teachersSpecialities=array_unique($arr2);
        $filterTeacher = User::where([
            ['region','=',$request->reg],
            ['is_teacher', '=', '1'],
            ['speciality','=',$request->spec],
            ])
        ->get();
        $date = date('Y-m-d h:i:s', time()); 
        $user = Auth::user();
        $order = Order::where('user_id','=', $user->id)->first();
        return view ('frontend.pages.filter')->withTeachers($teachers)->withTeacherPage($teacherPage)->withTeachersRegions($teachersRegions)->withTeachersSpecialities($teachersSpecialities)->withFilterTeacher($filterTeacher)->withOrder($order)->withDate($date);     

    }
}
