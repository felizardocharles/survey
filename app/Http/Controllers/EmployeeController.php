<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(3);

        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page = $request->page;
        return view('employees.create',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);

        $employee = new Employee();
        $employee->name = $request->input('name');

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picture_name = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('images'), $picture_name);
            $employee-> picture = $picture_name;
        }

        $employee->save();

        $currentPage = $input['page'];
        $paginator = Employee::paginate(3); // Aqui supomos que não existe filtro 
        $lastPage = $paginator->lastPage();
        $redirectToPage = ($currentPage <= $lastPage) ? $currentPage : $lastPage;

        return redirect()->route('employees.index', ['page' => $redirectToPage])
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $page = $request->page;
        return view('employees.show',compact('employee', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $page = $request->page;

        return view('employees.edit',compact('employee', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);

        $input = $request->all();

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picture_name = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('images'), $picture_name);
            $input['picture'] = $picture_name;
        } else {
            $input['picture'] = $employee->picture;
        }

        $employee->update($input);

        $currentPage = $input['page'];

        $paginator = Employee::paginate(3); // Aqui supomos que não existe filtro a informar
        $lastPage = $paginator->lastPage();

        $redirectToPage = ($currentPage <= $lastPage) ? $currentPage : $lastPage;

        return redirect()->route('employees.index', ['page' => $redirectToPage])
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        $currentPage = $request->page();

        $paginator = Employee::paginate(3); // Aqui supomos que não existe filtro a informar
        $lastPage = $paginator->lastPage();

        $redirectToPage = ($currentPage <= $lastPage) ? $currentPage : $lastPage;

        return redirect()->route('employees.index', ['page' => $redirectToPage])
                        ->with('success','Employee deleted successfully');
    }
}
