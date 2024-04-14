<?php

namespace App\Http\Controllers;

use App\Models\AdminDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoticeBoardDownloadsController extends Controller
{
    public function noticeBoard()
    {
        //
        return view('branch.notices_downloads.br-noticeboard-index', [
            //'divisions' => $this->getAllBranches()
        ]);
    }

    public function documentDownloads(){
        return view('branch.notices_downloads.br-docs-index', [
             
            'document' => $this->GetDocuments(),
        ]);
    }



    public function index(Request $request)
    {
        return view(
            'admin.setup.documents.docs-index',
            [
                
            ]
        );
    }

    protected function GetDocuments()
    {
        try {
            return AdminDocument::where('status','Visible')->orderBy('title')->get();
        } catch (\Exception $exception) {
            Log::error('Get Document ' . $exception->getMessage());
        }
    }
}
