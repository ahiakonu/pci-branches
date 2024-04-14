<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeBoardDownloadsController extends Controller
{
    public function noticeBoard()
    {
        //
        return view('branch.notices_downloads.br-noticeboard-index', [
            //'divisions' => $this->getAllBranches()
        ]);
    }
}
