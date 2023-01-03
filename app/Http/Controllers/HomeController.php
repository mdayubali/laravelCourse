<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $series = Series::take(5)->get();
        $featureCourses = Course::take(6)->get();
        return view('welcome',[
            'series'=> $series,
            'courses' => $featureCourses,
        ]);
    }

    public function dashboard(){
        if(Auth::user()->type === 1){
            return view('dashboard');
        }else{
            return redirect()->route('home');
        }
    }

    public function archive($archive_type, $slug){
        $allowed_archive_type = ['series', 'duration', 'level', 'platform', 'topic'];
        if(!in_array($archive_type,$allowed_archive_type)){
            return abort('404');
        }

        //duration
        if($archive_type === 'duration'){
            $allowed_duration = ['1-5hours', '5-10hours', '10-plus-hours'];
            if(! in_array($slug,$allowed_duration)){
                return abort('404');
            }
        }

        if($archive_type === 'series'){
            $item = Series::where('slug', $slug)->first();
            if(empty($item)){
                return abort('404');
            }
            $title = 'courses on '.$item->name;
            $courses = $item->courses()->paginate(12);
        }elseif($archive_type === 'duration'){
            if($slug =='1-5hours'){
                $item = '1-5hours';
                $duration_db_key = 0;
            }elseif($slug =='5-10hours'){
                $item = '5-10hours';
                $duration_db_key = 1;
            }else{
                $item = '10+hours';
                $duration_db_key = 2;
            }

            $title = 'Courses with duration ' . $item;
            $courses = Course::where('duration',$duration_db_key)->paginate(12);
        }
        return view('archive.single',[
            'title'  => $title,
            'courses' => $courses
        ]);




        // level check
        if($archive_type === 'level'){
            $allowed_lavel = ['beginner', 'intermediate', 'advanced'];
            if(! in_array($slug,$allowed_lavel)){
                return abort('404');
            }
        }
        // platform check
        if($archive_type === 'platform'){
            $allowed_platform = ['laracast', 'laravel-daily', 'codecourse'];
            if(! in_array($slug,$allowed_platform)){
                return abort('404');
            }
        }
        // Topics Check
        if($archive_type === 'topic'){
            $allowed_topic = ['eloquent', 'validation', 'refactoring','testing'];
            if(! in_array($slug,$allowed_topic)){
                return abort('404');
            }
        }
        // dd('ok');


    }
}
