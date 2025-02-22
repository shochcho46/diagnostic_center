<?php

namespace Modules\Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Organization\Http\Requests\OrganizationRequest;
use Modules\Organization\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $limit = $request->limit ?? 20;
        $currentAdminRole = getAdminRole();

        if ($currentAdminRole == 'SuperAdmin') {
            $datas = Organization::orderBy('id', 'desc')
                ->when($request->search, function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('address', 'like', '%' . $request->search . '%')
                            ->orWhere('current_package', 'like', '%' . $request->search . '%')
                            ->orWhere('contact_number', 'like', '%' . $request->search . '%');
                    });
                })
                ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [$request->from_date, $request->end_date]);
                })

                ->when($request->upozila_id, function ($query) use ($request) {
                    $query->where('upozila_id', $request->upozila_id);
                })
                ->when($request->union_id, function ($query) use ($request) {
                    $query->where('union_id', $request->union_id);
                })
                ->when($request->district_id, function ($query) use ($request) {
                    $query->where('district_id', $request->district_id);
                })
                ->when($request->division_id, function ($query) use ($request) {
                    $query->where('division_id', $request->division_id);
                })

                ->paginate($limit);

        } else {
            $organizationId = Auth::user()->organization_id;
            $datas = Organization::where('id', $organizationId)
                ->orderBy('id', 'desc')
                ->when($request->search, function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('address', 'like', '%' . $request->search . '%')
                            ->orWhere('current_package', 'like', '%' . $request->search . '%')
                            ->orWhere('contact_number', 'like', '%' . $request->search . '%');
                    });
                })
                ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [$request->from_date, $request->end_date]);
                })

                ->when($request->upozila_id, function ($query) use ($request) {
                    $query->where('upozila_id', $request->upozila_id);
                })
                ->when($request->union_id, function ($query) use ($request) {
                    $query->where('union_id', $request->union_id);
                })
                ->when($request->district_id, function ($query) use ($request) {
                    $query->where('district_id', $request->district_id);
                })
                ->when($request->division_id, function ($query) use ($request) {
                    $query->where('division_id', $request->division_id);
                })
                ->paginate($limit);

        }


        return view('organization::organization.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allDivisions = Division::all();
        $allDistrict = District::all();
        $allUnion = Union::all();
        $allUpazila = Upazila::all();
        return view('organization::organization.create', compact('allDivisions', 'allDistrict', 'allUnion', 'allUpazila'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request)
    {
        // $insertData = $request->validated();
        $insertData = $request->all();
        $insertData['current_package']=1;

        $organization = Organization::create($insertData);
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fullPath = imageStore($file);
            $organization->clearMediaCollection('logo');
            $organization->addMedia($fullPath)->toMediaCollection('logo');
        }

        $toaster = [
            'message' => 'Organization created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.organizationIndex')->with($toaster);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('organization::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('organization::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
