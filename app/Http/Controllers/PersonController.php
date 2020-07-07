<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonResource;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'name' => 'required|max:500',
            'birthdate' => 'required|date',
            'lat' => 'required',
            'lng' => 'required',
            'type' => 'required',
        ];

        if($request->type != "son") { $rules['person_id'] = 'required|numeric'; }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // Date Format Change
        $time = strtotime($request->birthdate);
        $newFormat = date("Y-m-d", $time);
        $request->merge(["birthdate" => $newFormat]);

        //Create Person
        $person = Person::create($request->all());
        
        // Update Person Id If Son
        if($person->type == 'son') { $person = Person::FindOrFail($person->id); $person->person_id = $person->id; $person->update(); }

        // Return Response
        return response()->json(new PersonResource($person), 200);
    }


    public function show($person_id = null)
    {

        // Get Person Details
        $person = Person::findOrFail($person_id);

        // Get Location Details Of Person
        Person::getLocationDetails($person->lat, $person->lng);
            
        $tree = Person::wherePersonId($person_id)->get();
            
        return response()->json(["person" => new PersonResource($person), "tree" => PersonResource::collection($tree)], 200);      
    }

    public function betWeenDates($date1 = null, $date2 = null)
    {
        if($date1 && $date2) { $persons = Person::whereBetween('birthdate', [$date1, $date2])->get(); return PersonResource::collection($persons); }
        
        return response()->json('something went wrong please try again', 500);
    }
}
