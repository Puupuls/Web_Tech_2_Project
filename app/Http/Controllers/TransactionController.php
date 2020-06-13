<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\IncomeSource;
use App\Tracker;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if(auth()->user()->can_edit_tracker()){
            return view('transaction_create_edit',
                [
                    'tracker' => auth()->user()->last_tracker,
                    'transaction' => [],
                    'income_sources'=>$this->get_income_source_array(auth()->user()->last_tracker),
                    'expense_categories'=>$this->get_expense_categories_array(auth()->user()->last_tracker),
                ]);
        }else abort(403);
    }

    private function get_income_source_array(Tracker $tracker){
        $sources = [];
        foreach($tracker->income_sources as $s){
            $sources[$s->id] = $s->name;
        }
        return $sources;
    }
    private function get_expense_categories_array(Tracker $tracker){
        $sources = [];
        foreach($tracker->expense_categories as $s){
            $sources[$s->id] = $s->name;
        }
        return $sources;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'amount' => 'required|numeric|gt:0',
            'image' => 'file|image',
            'income_source' => 'exists:App\IncomeSource,id',
            'expense_category' => 'exists:App\ExpenseCategory,id',
        );
        $this->validate($request, $rules);
        $transaction = Transaction::create([
            'amount'=> $request['amount'],
            'tracker_id'=> $request['tracker_id'],
            'added_by_user_id'=> auth()->user()->id,
            'description'=> $request['description'],
            'is_income'=> $request['is_income']=='is_income',
            'income_source_id'=> $request['is_income']=='is_income'? $request['income_source'] : null,
            'expense_category_id'=> $request['is_income']=='is_income'? null : $request['expense_category'],
        ]);
        if($request->hasFile('image')) {
            $file = $request->file('image')->move(public_path('/uploads/images/'), $transaction->id . '.'. $request->file('image')->getClientOriginalExtension());
            $transaction->image_path = '/uploads/images/' . $transaction->id . '.'. $request->file('image')->getClientOriginalExtension();
            $transaction->save();
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Transaction $transaction)
    {
        if(auth()->user()->can_access_tracker($transaction->tracker)) {
            return view('transaction', ['transaction' => $transaction]);
        }abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Transaction $transaction)
    {
        if(auth()->user()->can_edit_tracker($transaction->tracker)){
            return view('transaction_create_edit',
                [
                    'tracker' => auth()->user()->last_tracker,
                    'transaction' => $transaction,
                    'income_sources'=>$this->get_income_source_array(auth()->user()->last_tracker),
                    'expense_categories'=>$this->get_expense_categories_array(auth()->user()->last_tracker),
                ]);
        }else abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Transaction  $transaction
     * @return Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $rules = array(
            'amount' => 'required|numeric|gt:0',
            'image' => 'file|image',
            'income_source' => 'exists:App\IncomeSource,id',
            'expense_category' => 'exists:App\ExpenseCategory,id',
        );
        $this->validate($request, $rules);
        if(!auth()->user()->can_edit_tracker(Tracker::findOrFail($request['tracker_id']))) abort(403);
        if(!Tracker::findOrFail($request['tracker_id'])->income_sources->contains(IncomeSource::findOrFail($request['income_source']))) abort(403);
        if(!Tracker::findOrFail($request['tracker_id'])->expense_categories->contains(ExpenseCategory::findOrFail($request['expense_category']))) abort(403);
        $transaction->fill([
            'amount'=> $request['amount'],
            'tracker_id'=> $request['tracker_id'],
            'added_by_user_id'=> auth()->user()->id,
            'description'=> $request['description'],
            'is_income'=> $request['is_income']=='is_income',
            'income_source_id'=> $request['is_income']=='is_income'? $request['income_source'] : null,
            'expense_category_id'=> $request['is_income']=='is_income'? null : $request['expense_category'],
        ]);
        $transaction->save();
        if($request->hasFile('image')) {
            $file = $request->file('image')->move(public_path('/uploads/images/'), $transaction->id . '.'. $request->file('image')->getClientOriginalExtension());
            $transaction->image_path = '/uploads/images/' . $transaction->id . '.'. $request->file('image')->getClientOriginalExtension();
            $transaction->save();
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Transaction $transaction)
    {
        if(auth()->user()->can_edit_tracker($transaction->tracker)) {
            $transaction->delete();
            return redirect('/');
        }else{
            abort(403);
        }
    }
}
