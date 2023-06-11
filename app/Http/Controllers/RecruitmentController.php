<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    //

    public function recruitment_crew_regist()
    {
        return view('recruitment.crew.regist');
    }
}
