<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\HouseHold;
use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseHoldController extends Controller
{

    public function getdata() {

        $houseHolds = HouseHold::leftJoin('residences', 'residences.id', 'house_holds.head_family_id')
            ->leftJoin('barangays', 'barangays.id', 'house_holds.barangay_id')
            ->select('house_holds.house_no',
                'house_holds.id',
                'house_holds.street',
                'house_holds.sitio',
                'barangays.name as barangay',
                DB::raw("CONCAT(residences.last_name, ' ' , residences.first_name , '. ' , residences.middle_name) AS head_family"))
            ->get();

        return response()->json(['house_holds' => $houseHolds], 200);
    }

    public function store(Request $request) {

        $newHouseHold = new HouseHold();
        $newHouseHold->house_no = $request->house_no;
        $newHouseHold->street = $request->street;
        $newHouseHold->sitio = $request->sitio;
        $newHouseHold->barangay_id = $request->barangay;

        return $newHouseHold->save()
            ? response()->json(['message' => 'Success', 'id' => $newHouseHold->id], 200)
            : response()->json(['err' => 'Error'], 401);
    }

    public function pdf() {

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

        $reportArr = array();
        $count = 0;

        $barangays = Barangay::get();

        foreach($barangays as $barangay)
        {
            /* select house holds */

            $households = HouseHold::leftJoin('residences', 'residences.id', 'house_holds.head_family_id')
                ->leftJoin('barangays', 'barangays.id', 'house_holds.barangay_id')
                ->select(
                    'house_holds.id',
                    'house_holds.head_family_id',
                    'barangays.name',
                    DB::raw("CONCAT(house_holds.house_no, ' ' , house_holds.street, ' ' , house_holds.sitio) AS address"),
                    DB::raw("CONCAT(residences.last_name, ' ' , residences.first_name , ', ' , residences.middle_name) AS head_family"))
                ->where('house_holds.barangay_id', $barangay['id'])
                ->get();

            foreach($households as $household)
            {
                $id = $household->head_family_id;
;
                $members = Residence::where('residences.house_hold_id', $household->id)
                    ->select(
                        DB::raw("CONCAT(residences.last_name, ' ' , residences.first_name , ', ' , residences.middle_name) AS member"),
                        'residences.gender',
                        'residences.birthday',
                        'residences.mobile_number',
                        'residences.marital_status'
                    )
                    ->where(function($query) use ($id)
                    {
                        if($id !== null)
                        {
                            $query->where('residences.id','!=', $id);
                        }
                    })
                    ->get()->toArray();

                $reportArr[$count] = [
                    'barangay' => $household->name,
                    'household_id' => $household->id,
                    'household' => $household->address,
                    'family_head' => $household->head_family,
                    'member' => $members
                ];

                $count++;
            }
        }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.house_hold', compact('reportArr'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }
}
