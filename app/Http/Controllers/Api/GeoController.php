<?php

namespace App\Http\Controllers\Api;

use App\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\DivisionResource;
use App\Http\Resources\UpazilaResource;
use App\Http\Resources\UniounResource;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    use ApiResponseTrait;


    public function loadAllDivision(Request $request)
    {
        $divisions = Division::all();
        return $this->successResponse(DivisionResource::collection($divisions), 'Divisions loaded successfully',200);
    }
    public function loadAllDistrict(Request $request)
    {
        $districts = District::when($request->division_id, function ($query) use ($request) {
            return $query->where('division_id', $request->division_id);
        })->get();
        return $this->successResponse(DistrictResource::collection($districts), 'Districts loaded successfully',200);
    }

    public function loadAllUpazila(Request $request)
    {
        $upazilas = Upazila::when($request->district_id, function ($query) use ($request) {
            return $query->where('district_id', $request->district_id);
        })->get();
        return $this->successResponse(UpazilaResource::collection($upazilas), 'Upazilas loaded successfully',200);
    }

    public function loadAllUnion(Request $request)
    {
        $unions = Union::when($request->upazila_id, function ($query) use ($request) {
            return $query->where('upazila_id', $request->upazila_id);
        })->get();
        return $this->successResponse(UniounResource::collection($unions), 'Unions loaded successfully',200);
    }


}
