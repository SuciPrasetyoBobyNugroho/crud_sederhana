<?php

namespace App\Http\Controllers;

use App\Models\rumahsakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class rumahsakitcontroller extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->date_from ?? null;
        $dateTo = $request->date_to ?? null;

        $data = rumahsakit::orderBy('id', 'desc')
            ->when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
                $query->whereDate('infant_birth_datetime', '>=', $dateFrom)
                    ->whereDate('infant_birth_datetime', '<=', $dateTo);
            })
            ->paginate(5);

        $avgWeightMaleByDateAndGender = rumahsakit::when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
            $query->whereDate('infant_birth_datetime', '>=', $dateFrom)
                ->whereDate('infant_birth_datetime', '<=', $dateTo);
        })->where('infant_gender', 'male')->avg('weight_kg');

        $avgWeightFemaleByDateAndGender = rumahsakit::when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
            $query->whereDate('infant_birth_datetime', '>=', $dateFrom)
                ->whereDate('infant_birth_datetime', '<=', $dateTo);
        })->where('infant_gender', 'female')->avg('weight_kg');

        $countMaleByDateAndGender = rumahsakit::when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
            $query->whereDate('infant_birth_datetime', '>=', $dateFrom)
                ->whereDate('infant_birth_datetime', '<=', $dateTo);
        })->where('infant_gender', 'male')->count();

        $countFemaleByDateAndGender = rumahsakit::when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
            $query->whereDate('infant_birth_datetime', '>=', $dateFrom)
                ->whereDate('infant_birth_datetime', '<=', $dateTo);
        })->where('infant_gender', 'female')->count();

        return view('rumahsakit.index', compact('data', 'avgWeightMaleByDateAndGender', 'avgWeightFemaleByDateAndGender', 'countMaleByDateAndGender', 'countFemaleByDateAndGender', 'dateFrom', 'dateTo'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rumahsakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('mother_name', $request->mother_name);
        Session::flash('mother_age', $request->mother_age);
        Session::flash('infant_gender', $request->infant_gender);
        Session::flash('infant_birth_datetime', $request->infant_birth_datetime);
        Session::flash('gestational_age_weeks', $request->gestational_age_weeks);
        Session::flash('height_cm', $request->height_cm);
        Session::flash('weight_kg', $request->weight_kg);

        $request->validate([
            'mother_name' => 'required',
            'mother_age' => 'required',
            'infant_gender' => 'required',
            'infant_birth_datetime' => 'required',
            'gestational_age_weeks' => 'required',
            'height_cm' => 'required',
            'weight_kg' => 'required',
        ]);

        $weight_kg = str_replace(',', '.', $request->weight_kg);
        $weight_kg = (float) $weight_kg;

        $data = [
            'mother_name' => $request->mother_name,
            'mother_age' => $request->mother_age,
            'infant_gender' => $request->infant_gender,
            'infant_birth_datetime' => $request->infant_birth_datetime,
            'gestational_age_weeks' => $request->gestational_age_weeks,
            'height_cm' => $request->height_cm,
            'weight_kg' => $weight_kg,
        ];
        rumahsakit::create($data);
        return redirect()->to('rumahsakit')->with('success', 'Data added successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = rumahsakit::where('mother_name', $id)->first();
        return view('rumahsakit.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mother_name' => 'required',
            'mother_age' => 'required',
            'infant_gender' => 'required',
            'infant_birth_datetime' => 'required',
            'gestational_age_weeks' => 'required',
            'height_cm' => 'required',
            'weight_kg' => 'required',
        ]);

        $weight_kg = str_replace(',', '.', $request->weight_kg);
        $weight_kg = (float) $weight_kg;

        $data = [
            'mother_name' => $request->mother_name,
            'mother_age' => $request->mother_age,
            'infant_gender' => $request->infant_gender,
            'infant_birth_datetime' => $request->infant_birth_datetime,
            'gestational_age_weeks' => $request->gestational_age_weeks,
            'height_cm' => $request->height_cm,
            'weight_kg' => $weight_kg,
        ];
        rumahsakit::where('mother_name', $id)->update($data);
        return redirect()->to('rumahsakit')->with('success', 'Data edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = rumahsakit::find($id);

        if (!$data) {

            return redirect()->route('rumahsakit.index')->with('error', 'Data not found.');
        }

        $data->delete();
        return redirect()->route('rumahsakit.index')->with('success', 'Successfully deleted data.');
    }
}
