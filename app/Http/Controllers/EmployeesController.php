<?php

namespace App\Http\Controllers;

use App\Mail\NewEmployeeMail;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employees $employee)
    {
        return view('employees.index',[
            'employee' => $employee->company,
            'companies' => Companies::all(),
            'employees' => Employees::with('company')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('employees.create',[
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:employees',
        ]);

        $validateData['company_id'] = $request->company_id;
        $validateData['phone'] = $request->phone;

        Employees::create($validateData);
        Mail::to('rdp0409@gmail.com')->send(new NewEmployeeMail());

        return redirect('/employees')->with('success','New Employee Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employee)
    {
        return view('employees.show',[
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employee)
    {
        return view('employees.edit',[
            'employee' => $employee,
            'companies' => Companies::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employee)
    {
        // $rules = [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'company_id' => 'required',
        // ];

        // $validateData = $request->validate($rules);
        // $validateData['company_id'] = $request->company_id;
        // $validateData['phone'] = $request->phone;
        
        Employees::where('id',$employee->id)->update($request->except('_method', '_token'));

        return redirect('/employees')->with('success','Data Employee Has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employee)
    {
        Employees::destroy($employee->id);

        return redirect('/employees')->with('success','Data Employee Has Been Deleted');
    }
}
