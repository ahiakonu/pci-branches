<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    public function index()
    {
        //
        return view('branch.notice-board.noticeboard-index', [
            //'divisions' => $this->getAllBranches()
        ]);
    }
}
