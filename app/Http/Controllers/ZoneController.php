<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.setup.zone.zone-index', [
            'zones' => $this->getAllBranches()
        ]);
    }

    private function getAllBranches()
    {
        return Zone::with('division')->orderBy('zone_name')->get();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.setup.zone.zone-create',
            ['divisionsCombo' => $this->getDivisions()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $this->FormValidation($request);
        Zone::create($attributes);
        return back()->with(['success' => 'Zone (' . $attributes['zone_name'] . ') saved successfully ']);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        //
        return view(
            'admin.setup.zone.zone-edit',
            ['zone' => $zone, 'divisionsCombo' => $this->getDivisions()]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
       
        $attributes = $this->FormValidation($request, $zone);

        $zone->update($attributes);

        return back()->with('success', 'Zone (' . $attributes['zone_name'] . ') Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        if ($zone->id == 1)
            return back()->with("errormessage", "Default Division cannot be deleted");
        //todo - check if its in branch sertup
        $zone->delete();

        return back()->with('success', 'Zone Deleted!');
    }

    protected function FormValidation(Request $request, ?Zone $zone = null): array //defalut is null, ? indeciates its optopnal
    {
        $zone ??= new Zone();
        return  $request->validate([
            'division_id' => ['required', Rule::exists('divisions', 'id')],
            'zone_name' => ['required', 'min:4', Rule::unique('zones', 'zone_name')->ignore($zone)],
            'zonal_leader' => 'required|min:4|max:250',
        ]);
    }

    protected function getDivisions()
    {
        return Division::orderBy('division_name')->get();
    }



      ///AJAX CALLS////
      public function ajax_ZonesByDivisionID(Request $request)
      {
          $data = $request->validate(['division_id' => 'required']);
          $zone = Zone::select('zone_name', 'id')
              ->where('division_id', $data['division_id'])
              ->orderBy('zone_name')->get();
  
          return response()->json([
              'status' => true, 
              'message' => "successfull",
              'zones' => $zone
          ]);
      }
}
