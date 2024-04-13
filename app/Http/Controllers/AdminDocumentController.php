<?php

namespace App\Http\Controllers;

use App\Models\AdminDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminDocumentController extends Controller
{
    public function index(Request $request)
    {
        return view(
            'admin.setup.documents.docs-index',
            [
                'document' => $this->GetDocuments($request),
            ]
        );
    }

    protected function GetDocuments(Request $request)
    {
        try {
            return AdminDocument::orderBy('title')->get();
        } catch (\Exception $exception) {
            Log::error('Get Document ' . $exception->getMessage());
        }
    }

    public function create()
    {
        return view(
            'admin.setup.documents.docs-create',
        );
    }

    public function store(Request $request)
    {
        $attributes = $this->FormValidation($request);
        $attributes['status'] = 'Not Visible In App';
        AdminDocument::create($attributes);

        return back()->with(['success' => 'AdminDocument (' . $attributes['title'] . ') saved successfully ']);
    }

    public function edit(AdminDocument $upload)
    {
        return view(
            'admin.setup.documents.docs-edit',
            ['document' => $upload,]
        );
    }

    public function update(Request $request, AdminDocument $upload)
    {
      
        $attributes = $request->validate([
            'title' => ['required', Rule::unique('admin_documents', 'title', 'except', $upload->id,)]
        ]);

        $request->validate([
            'pdf_file' => 'sometimes|mimes:pdf|max:2048',
        ]);
   
        try {

            if ($request->has('pdf_file')) {
                if (File::exists(public_path('storage/' . $upload->file_path))) {
                    File::delete(public_path('storage/' . $upload->file_path));
                }
                $file = $request->file('pdf_file');
                $filePath = $file->store('uploads', 'public');
                $attributes['original_name'] = $file->getClientOriginalName();
                $attributes['file_path'] = $filePath;
            }

            $upload->update($attributes);

            return back()->with('success', 'AdminDocument updated.');
        } catch (\Exception $e) {
            Log::error('update admim -' . $e);
            return back()->with('errormessage', $e);
        }
    }

    public function destroy(AdminDocument $upload)
    {
        try {
            //delete file
            if (File::exists(public_path('storage/' . $upload->file_path))) {
                File::delete(public_path('storage/' . $upload->file_path));
            } else {
                dd('file does not exist' . public_path('storage/' . $upload->file_path));
            }

            $upload->delete();
            return back()->with('success', 'AdminDocument deleted successfully !');
        } catch (\Exception $e) {
            Log::error('AdminDocument destroy :: ' . $e);
        }
    }

    // public function goLiveOnApp(Request $request, AdminDocument $upload)
    // {
    //     try {
    //         Log::info('go live log-policy');

    //         $upload->update(['status' => 'Visible In App']);

    //         return back()->with('success', 'AdminDocument is live on Mobile App!');
    //     } catch (\Exception $e) {
    //         Log::error('error - goLiveOnApp policy  :: ' . $e);
    //     }
    // }
    // public function removeFromApp(AdminDocument $upload)
    // {
    //     try {
    //         $upload->update(['status' => 'Not Visible In App']);

    //         return back()->with('success', 'AdminDocument removed on Mobile App!');
    //     } catch (\Exception $e) {
    //         Log::error('error - removeFromApp policy  :: ' . $e);
    //     }
    // }



    //FORM VALIDATION
    protected function FormValidation(Request $request): array //defalut is null, ? indeciates its optopnal
    {
        $attributes = $request->validate([
            'title' => 'required|unique:school_policies,title',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('pdf_file');
        $filePath = $file->store('uploads', 'public');
        $attributes['original_name'] = $file->getClientOriginalName();
        $attributes['file_path'] = $filePath;

        return $attributes;
    }
}
