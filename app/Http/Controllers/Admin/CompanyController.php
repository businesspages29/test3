<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;
use Validator;

class CompanyController extends Controller
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
            $data = Company::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            
                           $btn = '<a href="'.route('admin.company.show',$row->id).'" class="edit btn btn-primary btn-sm m-2">View</a>';
                           $btn .= '<a href="'.route('admin.company.edit',$row->id).'" class="edit btn btn-success btn-sm m-2">Edit</a>';
                           $btn .= '<form action="'.route('admin.company.destroy',$row->id).'" method="post" style="display:inline">
                           '.csrf_field().'<input type="hidden" name="_method" value="delete" />
                            <input class="btn btn-danger m-2" type="submit" value="Delete">
                            </form>';

                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.company.index');
    }
    public function create()
    {
        return view('admin.company.create');
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
			'name' => 'required',
            'email' => 'required|email|unique:companies,email',
            'website' => 'required',
            'status' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:15048',
		]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
			return redirect()->back()->with('error',$errorMessage);
		}
        $input = $request->all();
        unset($input['_token']);

        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $input['logo'] = $file->store('logo');
        }


        $Company = Company::create($input);

        return redirect()->route('admin.company.index')
                        ->with('success','Company created successfully');
    }
    public function show($id)
    {
        $Company = Company::find($id);
        return view('admin.company.show',compact('Company'));
    }
    public function edit($id)
    {
        $Company = Company::find($id);
        return view('admin.company.edit',compact('Company'));
    }
 	public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'name' => 'required',
            'email' => 'required|email|unique:companies,email,'.auth()->user()->id,
            'website' => 'required',
            'status' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:15048',
		]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
			return redirect()->back()->with('error',$errorMessage);
		}

        $input = $request->all();
        unset($input['_token']);

        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $input['logo'] = $file->store('logo');
        }

        $Company = Company::find($id);
        $Company->update($input);
        return redirect()->route('admin.company.index')
                        ->with('success','Company updated successfully');
    }
  	public function destroy($id)
    {
        Company::find($id)->delete();
        return redirect()->route('admin.company.index')
                        ->with('success','Company deleted successfully');
    }
}
