<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\HouseHold;
use App\Models\Residence;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidenceController extends Controller
{

    public function index()
    {
        return view('main.residence');
    }

    public function initial() {
        return response()->json(['barangays' => Barangay::get()], 200);
    }

    public function store(Request $request) {

        $checkDuplicates = Residence::where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)
            ->where('middle_name', $request->middle_name)
            ->where('birthday', $request->birthdate)
            ->count();

        if($checkDuplicates > 0)
        {
            return response()->json(['errors' => 'Duplicate Name Found!'], 422);
        }

        DB::beginTransaction();

        try
        {
//            $month = date_parse($request->birthday_month);
//
//            $birthday = new Carbon((int)$request->birthday_year . '-' . (int)$request->birthday_day . '-' . $month['month']);
            $new_residence = new Residence();
            $new_residence->last_name   = strtoupper($request->last_name);
            $new_residence->first_name  = strtoupper($request->first_name);
            $new_residence->middle_name = strtoupper($request->middle_name);
            $new_residence->birthday    = $request->birthdate;
            $new_residence->age = Carbon::parse($request->birthdate)->age;
            $new_residence->place_of_birth_town = strtoupper($request->birthplace_town);
            $new_residence->place_of_birth_province = strtoupper($request->birthplace_province);
            $new_residence->gender  = strtoupper($request->gender);
            $new_residence->gender_other    = strtoupper($request->gender_other);
            $new_residence->marital_status  = strtoupper($request->martial_status);
            $new_residence->marital_status_other    = strtoupper($request->marital_status_other);
            $new_residence->address_house_no    = strtoupper($request->house_no);
            $new_residence->address_street  = strtoupper($request->street);
            $new_residence->address_sitio   = strtoupper($request->sitio);
            $new_residence->barangay_id    = strtoupper($request->barangay);
            $new_residence->mobile_number   = strtoupper($request->mobile);
            $new_residence->sectoral_group  = strtoupper($request->sectoral_group);
            $new_residence->nationality = strtoupper($request->nationality);
            $new_residence->nationality_other = strtoupper($request->nationality_other);
            $new_residence->employed    = strtoupper($request->employed);
            $new_residence->employed_other  = strtoupper($request->employed_other);
            $new_residence->engaged_in_business = strtoupper($request->business_type);
            $new_residence->business_name   = strtoupper($request->business_name_other);
            $new_residence->business_type   = strtoupper($request->business_type_other);
            $new_residence->registered_voter    = strtoupper($request->voter);
            $new_residence->registered_voter_other  = strtoupper($request->voter_other);
            $new_residence->religious_affiliation   = strtoupper($request->religion);
            $new_residence->religious_affiliation_other = strtoupper($request->religion_other);
            $new_residence->house_hold_id = $request->household;
            $new_residence->senior = $request->senior;
            $new_residence->disability = $request->disability;
            $new_residence->solo_parent = $request->solo_parent;
            $new_residence->pregnant = $request->pregnant;
            $new_residence->lactating_mother = $request->lactating_mother;
            $new_residence->homeless = $request->homeless;
            $new_residence->save();

            if($request->as_head_family)
            {
                $household = HouseHold::where('id', $request->household)->first();
                $household->head_family_id = $new_residence->id;
                $household->save();
            }

        }
        catch(QueryException $ex)
        {
            DB::rollBack();
            return response()->json(['errors' => $ex], 401);
        }

        DB::commit();
        return response()->json(['message' => 'Success'], 200);

    }

    public function  pdf() {

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

        $reportArr = array();
        $count = 0;

        $barangays = Barangay::get();

        foreach($barangays as $barangay)
        {

            /* count voter's by barangay */
            $voterList = Residence::where('barangay_id', $barangay->id)->get();
            $voterCountPerBarangay = $voterList->count();
            $ageBracket = [[18,40], [41, 60], [60, 100]];
            $adult = $voterList->whereBetween('age', [18,40])->count();
            $midAge = $voterList->whereBetween('age', [41, 60])->count();
            $senior = $voterList->where('age', '>=', 61)->count();
            $maleCount = $voterList->where('gender', 'MALE')->count();
            $femaleCount = $voterList->where('gender', 'FEMALE')->count();
            $noGenderCount = $voterList->where('gender', 'NO_VALUE')->count();
            $otherGender = $voterList->where('gender', 'OTHER_SEX')->count();
            $single = $voterList->where('marital_status', 'SINGLE')->count();
            $married = $voterList->where('marital_status', 'MARRIED')->count();
            $widowed = $voterList->where('marital_status', 'WIDOWED')->count();
            $divorce = $voterList->where('marital_status', 'DIVORCE')->count();
            $common_law = $voterList->where('marital_status', 'COMMON_LAW')->count();
            $other_marital = $voterList->where('marital_status', 'OTHER_MARITAL')->count();
            $senior = $voterList->where('sectoral_group', 'SENIOR')->count();
            $disability = $voterList->where('sectoral_group', 'DISABILITY')->count();
            $solo_parent = $voterList->where('sectoral_group', 'SOLO_PARENT')->count();
            $pregnant = $voterList->where('sectoral_group', 'PREGNANT')->count();
            $lactating_mother = $voterList->where('sectoral_group', 'LACTATING_MOTHER')->count();
            $homeless = $voterList->where('sectoral_group', 'HOMELESS')->count();
            $none = $voterList->where('sectoral_group', 'NONE')->count();
            $filipino = $voterList->where('nationality', 'FILIPINO')->count();
            $nationality_other = $voterList->where('nationality', 'OTHER_NATIONALITY')->count();
            $employed_yes = $voterList->where('employed', 'EMPLOYED_YES')->count();
            $employed_no = $voterList->where('employed', 'EMPLOYED_NO')->count();
            $self_employed = $voterList->where('employed', 'SEFT_EMPLOYED')->count();
            $business_owner = $voterList->where('engaged_in_business', 'BUSINESS_OWNER')->count();
            $business_co_owner = $voterList->where('engaged_in_business','BUSINESS_CO_OWNER')->count();
            $investor = $voterList->where('engaged_in_business','INVESTOR')->count();
            $business_other = $voterList->where('engaged_in_business','BUSINESS_OTHER')->count();
            $business_no = $voterList->where('engaged_in_business','BUSINESS_NO')->count();
            $voter_yes = $voterList->where('registered_voter', 'YES')->count();
            $voter_no = $voterList->where('resgistered_voter', 'NO')->count();
            $catholic = $voterList->where('religious_affiliation', 'CATHOLIC')->count();
            $born_again = $voterList->where('religious_affiliation', 'BORN_AGAIN')->count();
            $baptist = $voterList->where('religious_affiliation', 'BAPTIST')->count();
            $inc = $voterList->where('religious_affiliation', 'INC')->count();
            $jehova = $voterList->where('religious_affiliation', 'JEHOVA')->count();
            $adventist = $voterList->where('religious_affiliation', 'ADVENTIST')->count();
            $other_religion = $voterList->where('religious_affiliation', 'OTHER_RELIGION')->count();




            $reportArr[$count] = [
                'barangay' => $barangay->name,
                'voter_count' => $voterCountPerBarangay,
                'adult' => $adult,
                'midage' => $midAge,
                'senior' => $senior,
                'male' => $maleCount,
                'female' => $femaleCount,
                'no_gender' => $noGenderCount,
                'other_gender' => $otherGender,

                'single' => $single,
                'married' => $married,
                'widowed' => $widowed,
                'divorce' => $divorce,
                'common_law' => $common_law,
                'other_marital' => $other_marital,

                'senior_citizen' => $senior,
                'disability' => $disability,
                'solo_parent' => $solo_parent,
                'pregnant' => $pregnant,
                'lactating_mother' => $lactating_mother,
                'homeless' => $homeless,
                'none' => $none,


                'filipino' => $filipino,
                'nationality_other' => $nationality_other,

                'employed_yes' => $employed_yes,
                'employed_no' => $employed_no,
                'self_employed' => $self_employed,

                'business_owner' => $business_owner,
                'business_co_owner' => $business_co_owner,
                'investor' => $investor,
                'business_other' => $business_other,
                'business_no' => $business_no,


                'voter_yes' => $voter_yes,
                'voter_no' => $voter_no,


                'catholic' => $catholic,
                'born_again' => $born_again,
                'baptist' => $baptist,
                'inc' => $inc,
                'jehova' => $jehova,
                'adventist' => $adventist,
                'other_religion' => $other_religion,
            ];

            $count++;
        }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.voters_report', compact('reportArr'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

}
