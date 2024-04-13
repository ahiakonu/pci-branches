<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchTarget;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public $selected_index = 0;

    public function index()
    {
        return view(
            'admin.setup.branch.branch-index',
            [
                'branches' => $this->getAllBranches()
            ]
        );
    }

    private function getAllBranches()
    {
        return Branch::with('user', 'division', 'zone', 'targets',)->orderBy('church_name')->get();
    }

    protected function getDivisions()
    {
        return Division::orderBy('division_name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.setup.branch.branch-create',
            [
                'divisionsCombo' => $this->getDivisions(),
                'churchStatus' => $this->churchStatus(),
                'currencies' => $this->getCurrency()
            ]
        );
    }

    public function store(Request $request)
    {
        $attributes = $this->FormValidation($request);
        //dd($attributes);
        $branch = Branch::create($attributes);
        //create user with created branch
        $branch->user()->create(
            [
                'name' => $branch->church_name,
                'email' => $branch->church_email,
                'password' => bcrypt('perezchapel'),
                'user_role' => 'BRANCH_PASTOR',
                'user_status' => 'New'
            ]
        );
        return back()->with(['success' => 'Branch (' . $attributes['church_name'] . ') saved successfully ']);
    }


    //FORM VALIDATION
    protected function FormValidation(Request $request, ?Branch $branch = null): array //defalut is null, ? indeciates its optopnal
    {
        $branch ??= new Branch();
        return  $request->validate([
            'church_name' => ['required', 'min:4', Rule::unique('branches', 'church_name')->ignore($branch)],
            'church_location' => 'required|min:4|max:250',
            'church_email' => ['required', 'email', 'min:4', 'max:250', Rule::unique('branches', 'church_email')->ignore($branch)],
            'church_address' => 'nullable',
            'division_id' => ['required', Rule::exists('divisions', 'id')],
            'zone_id' => ['required', Rule::exists('zones', 'id')],
            'currency' => 'required',
            'city' => 'required|min:4|max:250',
            'year_established' => 'nullable',
            'website' => 'nullable',
            'church_status' => 'required',
            'g_lat' => 'nullable',
            'g_long' => 'nullable',
        ]);
    }


    public function edit(Branch $branch)
    {
        //
        return view(
            'admin.setup.branch.branch-edit',
            [
                'branch' => $branch,
                'divisionsCombo' => $this->getDivisions(),
                'churchStatus' => $this->churchStatus(),
                'currencies' => $this->getCurrency()
            ]
        );
    }

    private function churchStatus()
    {
        return ['Active', 'Inactive'];
    }

    public function update(Request $request, Branch $branch)
    {

        $attributes = $this->FormValidation($request, $branch);

        //update branch & user info - name and email
        $branch->update($attributes);

        $branch->user()->update(
            [
                'name' => $branch->church_name,
                'email' => $branch->church_email
            ]
        );
        return back()->with('success', 'Branch (' . $attributes['church_name'] . ') Updated Successfully !');
    }

    public function destroy(Branch $branch)
    {
        if (DB::table('branch_targets')->where('branch_id', $branch->id)->exists()) {
            return back()->with("errormessage", "Branch cannot be deleted. There are targets created under this branch. Process aborted.");
        }

        //todo - check if its in branch sertup
        if (DB::table('branch_reports')->where('branch_id', $branch->id)->exists()) {
            return back()->with("errormessage", "Branch cannot be deleted. There are reports under this branch. Process aborted.");
        }

        $branch->delete();

        return back()->with('success', 'Branch Deleted!');
    }

    public function resetPassword(Branch $branch)
    {
        if ($branch == null) return;
        //add comments to a given post
        $branch->user()->update(
            [
                'password' => bcrypt('perezchapel'),
                'user_status' => 'New'
            ]
        );

        return back()->with('success', 'Password Reset Successfully !');
    }

    public function showTarget(Branch $branch)
    {
        return view(
            'admin.setup.branch.branch-target',
            [
                'branch' => $branch,
                'targets' => BranchTarget::where('branch_id', $branch->id)->orderBy('target_year', 'desc')->get(),
                'target_criteria' => ['ALL', 'SUNDAY SERVICE ONLY']
            ]
        );
    }

    public function storeTarget(Request $request)
    {
        $attributes =  $request->validate([
            'branch_id' => ['required', 'min:4', Rule::exists('branches', 'id')],
            'attendance' => 'required|numeric|min:1',
            'income' => ['required', 'numeric', 'min:1',],
            'attendance_criteria' => 'nullable',
            'income_criteria' => 'nullable',
            'target_year' => 'required|digits:4',
            'maker_id' => 'required',
            'church_name' => 'required'
        ]);
        //if target exists for year and branch - update
        if (DB::table('branch_targets')->where('branch_id', $attributes['branch_id'])->where('target_year', $attributes['target_year'])->exists()) {
            DB::table('branch_targets')
                ->where('branch_id', $attributes['branch_id'])->where('target_year', $attributes['target_year'])
                ->update([
                    'attendance' => $attributes['attendance'],
                    'income' => $attributes['income'],
                    'attendance_criteria' => $attributes['attendance_criteria'],
                    'income_criteria' => $attributes['income_criteria'],
                ]);
            return back()->with(['success' => 'Target for  ' . $attributes['church_name'] . ', for ' . $attributes['target_year'] . ' updated successfully ']);
        }

        BranchTarget::create($attributes);

        return back()->with(['success' => 'Target for (' . $attributes['church_name'] . ') saved successfully ']);
    }

    public function destroyTarget($target)
    {
        DB::table('branch_targets')->where('id', $target)->delete();
        return back()->with(['success' => 'Target deleted saved successfully ']);
    }

    private function getCurrency()
    {
        return ['AUD', 'CAD', 'CFA', 'EURO', 'GBP', 'GHS', 'NAIRA', 'PKR', 'USD'];
    }
}
