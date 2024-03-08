<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\RegencyResource;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    public function provincy()
    {
        $data['result'] = Province::all();
        return response()->json($data);
    }

    public function regency($provinceId)
    {
        $data['result'] = RegencyResource::collection(
            Cache::remember('regency-'.$provinceId, 1000, function() use($provinceId){
                return Regency::with('province')->where('province_id', $provinceId)->get();
            })
        );

        return response()->json($data);
    }

    public function district($regencyId)
    {
        $data['result'] = DistrictResource::collection(
            Cache::remember('regency-'.$regencyId, 1000, function() use($regencyId){
                District::with('regency')->where('regency_id', $regencyId)->get();
            })
        );

        return response()->json($data);
    }

    public function village($districtId)
    {
        $data['result'] = DistrictResource::collection(
            Cache::remember('regency-'.$districtId, 1000, function() use($districtId){
                Village::with('district')->where('district_id', $districtId)->get();
            })
        );

        return response()->json($data);
    }

    public function student($year = 2021, $count = 1)
    {
        if ($count > 1) {
            // return Student::where('year_in', $year)->limit($count)->get();
            return Student::partitions(['year'.$year])->limit($count)->toSql();
        } else{
            // return Student::where('year_in', $year)->first();
            return Student::partitions(['year'.$year])->first();
        }
    }
}
