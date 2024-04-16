<?php

namespace App\Http\Controllers;

use App\Models\EntryVersionCensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryVersionCensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evcRecords = EntryVersionCensor::whereIn('status', [4, 14])->get();
        //dd('11111111111');
        return view('entries.versions.censor.index', compact('evcRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EntryVersionCensor $entryVersionCensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntryVersionCensor $entryVersionCensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntryVersionCensor $entryVersionCensor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntryVersionCensor $entryVersionCensor)
    {
        //
    }
}
