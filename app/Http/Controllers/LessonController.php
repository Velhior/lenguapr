<?php

namespace App\Http\Controllers;
use App\User;
use App\Lesson;
use Mail;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LessonController extends Controller
{
    public function postLesson(Request $request){
        $this->validate($request,['user_id'=>'required','teacher_id'=>'required']);
        $lesson_date = Carbon::createFromFormat("Y-m-d\TH:i", $request->lesson_date_time);
        //$tariff = Tariff::where('id', '=', $request->tariff_id)->first();
        $user = User::where('id', '=', $request->user_id)->first();
        $teacher=User::where('id','=', $request->teacher_id)->first();
        //$pam=var_dump($tariff);
        //$lesson_date_time = date('Y-m-d H:i:s', $request->lesson_date_time);
        $data = array(
          'teacher_id' => $request->teacher_id,
          'lesson_date_time' => $lesson_date,
          'user_name' => $user['name'],
          'teacher_name'=>$teacher['name'],
          //'some' => $pam,
          'user_id' => $request->user_id,
          //'start_date' => $request->start_date,
                    
        );
        Mail::send('emails.lesson', $data, function ($message) use ($data){
            //$settings = Setting::where('id','=','1')->first();
            $message->from('phlegmatic.dev@gmail.com', 'John Dosherak');
            //$message->sender('john@johndoe.com', 'John Doe');
            $message->to('phlegmatic.dev@gmail.com', 'John Doe');
            //$message->cc('john@johndoe.com', 'John Doe');
            //$message->bcc('john@johndoe.com', 'John Doe');
            //$message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Новый Урок');
            //$message->priority(3);
            //$message->attach('pathToFile');
        });


        $lesson = new Lesson;
        $lesson->teacher_id = $request->teacher_id;
        $lesson->lesson_date_time = $lesson_date;
        $lesson->user_id = $request->user_id;
        $lesson->teacher_name = $request->teacher_name;
        $lesson->save();
        Session::flash('success', 'Заявка успешно отправлена');
        return redirect()->route('teachers.index'); 
    }
}
