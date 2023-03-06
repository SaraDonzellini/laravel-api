<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{

    public function GetValidated($request){
        return $request->validate([
            'name' => 'required|string|min:2|max:50',
        ]);
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::paginate(15);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.technologies.create', ['technology' => new Technology()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->GetValidated($request);

        $data = $request->all();
        $newTech = new Technology();

        $newTech->fill($data);
        $newTech->save();
        

        return redirect()->route('admin.technologies.show', $newTech->id)->with('message', "$newTech->name has been created")->with('alert-type', 'info');
    }

    /**
     * Display the specified resource.
     *
     * @param  Technology $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Technology $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $this->GetValidated($request);

        $data = $request->all();
        $tech = Technology::findOrFail($technology);
        $tech->update($data);


        return redirect()->route('admin.technologies.show', $tech->id)->with('message', "$tech->name has been modified")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Technology &technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        
        return redirect()->route('admin.technologies.index', compact('technology'))->with('message', "$technology->name has been deleted")->with('alert-type', 'danger');
    }
}