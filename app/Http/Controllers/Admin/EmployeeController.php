<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use DataTables;
use Validator;

class EmployeeController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        
        
        
        if ($request->ajax()) {
            $data = Employee::select('*','companies.name as name')
        ->leftjoin('companies','employees.company_id', '=', 'companies.id')->get();    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            
                           $btn = '<a href="'.route('admin.employee.show',$row->id).'" class="edit btn btn-primary btn-sm m-2">View</a>';
                           $btn .= '<a href="'.route('admin.employee.edit',$row->id).'" class="edit btn btn-success btn-sm m-2">Edit</a>';
                           $btn .= '<form action="'.route('admin.employee.destroy',$row->id).'" method="post" style="display:inline">
                           '.csrf_field().'<input type="hidden" name="_method" value="delete" />
                            <input class="btn btn-danger m-2" type="submit" value="Delete">
                            </form>';

                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.employee.index');
    }
    public function create()
    {
        $companies = Company::get();
        return view('admin.employee.create',compact('companies'));
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
			'first_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'last_name' => 'required',
            'phone' => 'required',
            'status' => 'required',
		]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
			return redirect()->back()->with('error',$errorMessage);
		}
        $input = $request->all();
        unset($input['_token']);



        $employee= Employee::create($input);

        return redirect()->route('admin.employee.index')
                        ->with('success','Emplyee created successfully');
    }
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('admin.employee.show',compact('employee'));
    }
    public function edit($id)
    {
        $companies = Company::get();
        $employee = Employee::find($id);
        return view('admin.employee.edit',compact('companies','employee'));
    }
 	public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
			'first_name' => 'required',
            'email' => 'required|email|unique:employees,email,'.auth()->user()->id,
            'last_name' => 'required',
            'phone' => 'required',
            'status' => 'required',
		]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
			return redirect()->back()->with('error',$errorMessage);
		}

        $input = $request->all();
        unset($input['_token']);
        $employee = Employee::find($id);
        $employee->update($input);
        return redirect()->route('admin.employee.index')
                        ->with('success','Employee updated successfully');
    }
  	public function destroy($id)
    {
        Employee::find($id)->delete();
        return redirect()->route('admin.employee.index')
                        ->with('success','Employee deleted successfully');
    }
}
