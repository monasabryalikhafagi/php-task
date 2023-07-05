<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
class EmployeeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $employees = User::when($request->q, function (Builder $query) use ($request) {
      $query->where('name', 'LIKE', '%' . $request->q . '%');
    })->paginate();

    return view('admin.employees.index', compact('employees'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admin.employees.form');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreEmployeeRequest $request): RedirectResponse
  {
    $data = $request->validated();
    User::create($data);
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
    $employee = User::find($id);
    return view('admin.employees.show',compact('employee'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $employee = User::find($id);

    return view('admin.employees.form', compact('employee'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {

    $employee = User::find($id);

    if (!$employee) {
      return back()->withErrors('Not exitst');
    }

    $data = $request->validated();
    $employee->update($data);
    
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
    $user = User::withCount('employees')->find($id);

    if (!$user) {
      return back()->withErrors('Not exitst');
    }

    if ($user->employees_count == 0) {
      return back()->withErrors('Can not delete dempartment has employess');
    }

    $user->delete();

    return back()->withSuccess('Not exitst');
  }
}
