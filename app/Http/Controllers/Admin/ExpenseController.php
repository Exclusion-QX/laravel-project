<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * @param ExpenseRequest $request
     */
    public function store(ExpenseRequest $request)
    {
        $expenses = Expense::where([
            ['user_id', Auth::id()],
            ['date_spent', $request->date_spent]
        ])->first();

        if ($expenses) {
            return self::update($request);
        }

        $expenses = new Expense();

        $expenses->user_id = Auth::id();
        $expenses->date_spent = $request->date_spent;
        $expenses->spent = $request->spent;

        if ($expenses->save()) {
            return redirect()->back()->withSuccess('Данные добавлены');
        }
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $expenses = Expense::where([
            ['user_id', Auth::id()],
            ['date_spent', $request->date_spent]
        ])->first();

        $expenses->spent += $request->spent;

        if ($expenses->save()) {
            return redirect()->back()->withSuccess('Данные обновлены');
        }
    }
}
