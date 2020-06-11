<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Tracker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        if(auth()->user()->can_edit_tracker())
            return view('expenses', ['tracker'=>auth()->user()->last_tracker]);
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $success = false;
        $new_id = 0;

        if($request['name'] && auth()->user()->can_edit_tracker(Tracker::findorFail($request['tracker_id']))){
            $inc = ExpenseCategory::where('tracker_id', $request['tracker_id'])->where('name', $request['name'])->get();
            if($inc->count() == 0) {
                $success = true;
                $inc = ExpenseCategory::create([
                    'name' => $request['name'],
                    'tracker_id' => $request['tracker_id']
                ]);
                $new_id = $inc->id;
            }
        }

        return response()->json(['success'=>$success, 'new_id'=>$new_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param ExpenseCategory $expenseCategory
     * @return void
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ExpenseCategory $expenseCategory
     * @return void
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $expenseCategory
     * @return JsonResponse
     */
    public function update(Request $request, $expenseCategory)
    {
        $incomeSource = ExpenseCategory::findOrFail($expenseCategory);
        if($request['name'] && auth()->user()->can_edit_tracker($incomeSource->tracker)){
            $incomeSource->name = $request['name'];
            $incomeSource->save();
        }
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExpenseCategory $expenseCategory
     * @return void
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        //
    }
}
