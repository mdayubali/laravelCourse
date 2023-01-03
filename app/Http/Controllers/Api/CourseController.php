<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::latest()->take(12)->get();

        return response()->json([
            'courses' => $courses,
        ]);
    }
}
