<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceRequest;
use App\Models\Expense;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $expensesToday = Expense::getExpensesToday();

        $finance = Finance::where('user_id', Auth::id())->first();
        $arrExpenses = json_encode(Expense::getExpensesArr());

        if (!$finance) {
            $finance = new Finance();
        }

        $availableFinances = $finance->getAvailableFinances();

        $arrAvailableFinances = json_encode($finance->getAvailableFinancesArr($availableFinances['day']));

        return view('admin.finances.index', [
            'finance' => $finance,
            'availableFinances' => $availableFinances,
            'expensesToday' => $expensesToday,
            'arrAvailableFinances' => $arrAvailableFinances,
            'arrExpenses' => $arrExpenses,
        ]);
    }

    public function store(FinanceRequest $request)
    {
        $finance = Finance::where('user_id', Auth::id())->first();

        if ($finance) {
            return self::update($request);
        }

        $finance = new Finance();

        $finance->user_id = Auth::id();
        $finance->income = $request->income;
        $finance->forced_expenses = $request->forced_expenses;
        $finance->expenses = $request->expenses;
        $finance->saving = $request->saving;

        if ($finance->save()) {
            return redirect()->back()->withSuccess('Данные добавлены');
        }
    }

    public function update(FinanceRequest $request)
    {
        $finance = Finance::where('user_id', Auth::id())->first();
        $finance->income = $request->income;
        $finance->forced_expenses = $request->forced_expenses;
        $finance->expenses = $request->expenses;
        $finance->saving = $request->saving;
        if ($finance->save()) {
            return redirect()->back()->withSuccess('Данные обновлены');
        }
    }
}
