<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index',[
            'companies' => Companies::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create',[
            'companies' => Companies::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:companies',
            'website' => 'required',
            'logo' => 'image|file|max:1024'
        ]);

        if($request->file('logo')){
            $validateData['logo'] = $request->file('logo')->store('companies-image');
        }

        Companies::create($validateData);

        return redirect('/companies')->with('success','New Company Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $company)
    {
        return view('companies.show',[
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $company)
    {
        return view('companies.edit',[
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $company)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'website' => 'required',
            'logo' => 'image|file|max:1024'
        ];

        $validateData = $request->validate($rules);

        if($request->file('logo')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }

            $validateData['logo'] = $request->file('logo')->store('companies-image');
        }

        Companies::where('id',$company->id)->update($validateData);

        return redirect('/companies')->with('success','New Company Has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        if($company->image){
            Storage::delete($company->logo);
        }

        Companies::destroy($company->id);

        return redirect('/companies')->with('success','New Post Has Been Deleted');
    }
}
