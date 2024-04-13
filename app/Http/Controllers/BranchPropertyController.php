<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BranchPropertyController extends Controller
{
    protected function branchID()
    {
        return auth()->user()->user_role_id;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'branch.property.property-create',
            [
                'branch' => $this->getBranchInfo(),
                'yesno' => ['Yes', 'No'],
                'landdoc' => ['Site Plan', 'Indenture'],
                //'property' => BranchProperty::where('branch_id',$this->branchID())->first()->get()
            ]
        );
    }

    protected function getBranchInfo()
    {
        return Branch::with('property')->findOrFail($this->branchID());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $attributes = $this->FormValidation($request);

            if (DB::table('branch_properties')->where('branch_id', $this->branchID())->exists()) {
                $property = BranchProperty::where('branch_id', $this->branchID())
                ->update([
                    'pastor_name' => $attributes['pastor_name'],
                    'meeting_place' => $attributes['meeting_place'],
                    'own_land' => $attributes['own_land'],
                    'other_lands' => $attributes['other_lands'],
                    'available_doc' => $attributes['available_doc'],
                    'registration_stage' => $attributes['registration_stage'],
                    'document_location' => $attributes['document_location'],
                    'remarks' => $attributes['remarks'],
                    'photo1' => $attributes['photo1'],
                    'photo2' => $attributes['photo2'],    
                ]);
               
            

                return back()->with(['success' => 'Branch property information updated']);
            }
            BranchProperty::create($attributes);

            return back()->with('success', 'Branch property information saved successfully!!');
        } catch (\Exception $e) {
            Log::error('propert-store -' . $e);
            return back()->with('errormessage', 'somthing went wrong- Contact Admn!!');          
        }
    }

    protected function FormValidation(Request $request): array //defalut is null, ? indeciates its optopnal
    {
        /*  
            $today = Carbon::now();
            dd($today); 
        */

        $att =  $request->validate([
            'pastor_name' => 'required',
            'meeting_place' => 'required',
            'own_land' => 'required',
            'other_lands' => 'nullable',
            'available_doc' => 'required',
            'registration_stage' => 'required',
            'document_location' => '',
            'remarks' => 'nullable',
        ]);

        $photoval = $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,jpg,png|max:1999',
            'image2' => 'nullable|image|mimes:jpeg,jpg,png|max:1999',
            'imagepath1' => 'nullable',
            'imagepath2' => 'nullable'
        ]);

        $image1 = null;
        $image2 = null;

        if ($request->has('image1')) {
            $name = $this->branchID() . "_photo1_.{$request->image1->extension()}";
            if (Storage::exists($name)) {
                Storage::delete($$nmae);
                Log::info('exists-deleted-photo1');
            }
            $image1 = $request->file('image1')->storeAs('files', $name, 'public');
            $image1  =  "/storage/{$image1}";
        } else {
            if ($request['imagepath1'] != null) {
                $image1  =  $photoval['imagepath1'];
            }
        }
        if ($request->has('image2')) {
            $name = $this->branchID() . "_photo2_.{$request->image2->extension()}";//getClientOriginalName
            if (Storage::exists($name)) {
                Storage::delete($$nmae);
                Log::info('exists-deleted-photo2');
            }
            $image2 =  $request->file('image2')->storeAs('files', $name, 'public');
            $image2  =  "/storage/{$image2}";
        } else {
            if ($request['imagepath2'] != null) {
                $image2  =  $photoval['imagepath2'];
            }
        }
        $att['photo1'] =  $image1;
        $att['photo2'] =  $image2;
        $att['branch_id'] =  $this->branchID();

     
        return $att;
    }
    /**
     * Display the specified resource.
     */
    public function show(BranchProperty $branchProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BranchProperty $branchProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BranchProperty $branchProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchProperty $branchProperty)
    {
        //
    }
}
