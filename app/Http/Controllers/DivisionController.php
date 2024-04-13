<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.setup.division.div-index', [
            'divisions' => $this->getAllBranches()
        ]);
    }

    private function getAllBranches()
    {
        return Division::orderBy('division_name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setup.division.div-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $this->FormValidation();
        Division::create($attributes);
        return back()->with(['success' => 'Division (' . $attributes['division_name'] . ') saved successfully ']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        return view('admin.setup.division.div-edit', ['division' => $division]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        /* if ($division->id == 1)
            return back()->with("errormessage", "Default branch cannot be edited"); */

        $attributes = $this->FormValidation($division);

        $division->update($attributes);

        return back()->with('success', 'Division (' . $attributes['division_name'] . ') Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
   
        if (DB::table('zones')->where('division_id',$division->id)->exists())
            return back()->with("errormessage", "Division cannot be deleted. There are zones created under this division.");

        $division->delete();

        return back()->with('success', 'Division Deleted!');
    }
    protected function FormValidation(?Division $division = null): array //defalut is null, ? indeciates its optopnal
    {
        $division ??= new Division();
        return  request()->validate([
            'division_name' => ['required', 'min:4', Rule::unique('divisions', 'division_name')->ignore($division)],
            'country' => 'required|min:4',
            'divisional_leader' => 'required|min:4|max:250',
        ]);
    }
}
