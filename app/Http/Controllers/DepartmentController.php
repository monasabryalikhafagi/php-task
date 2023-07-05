<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $departments = Department::when($request->q, function (Builder $query) use ($request) {
      $query->where('name', 'LIKE', '%' . $request->q . '%')
        ->withCount('employees')
        ->withSum('employees', 'salary');
    })->paginate();

    return view('admin.departemnts.index', compact('departments'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admin.departemnts.form');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request): RedirectResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:departments|max:255',
      'desccription' => 'nullable',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $data = $request->validated();
    $data['slug']  = Str::slug('Hr', '-');
    Department::create($data);
    return back()->withSuccess('successfully created');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $department = Department::find($id);

    return view('admin.departemnts.show',compact('departemnt'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $department = Department::find($id);

    return view('admin.departemnts.form', compact('departemnt'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:departments|max:255',
      'desccription' => 'nullable',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $department = Department::find($id);

    if (!$department) {
      return back()->withErrors('Not exitst');
    }

    $data = $request->validated();
    $department->update($data);

    return back()->withSuccess('successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $department = Department::withCount('employees')->find($id);

    if (!$department) {
      return back()->withErrors('Not exitst');
    }

    if ($department->employees_count == 0) {
      return back()->withErrors('Can not delete dempartment has employess');
    }

    $department->delete();

    return back()->withSuccess('Not exitst');
  }
}
