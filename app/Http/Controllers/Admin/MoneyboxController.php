<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyboxRequest;
use App\Http\Requests\UpdateMoneyboxRequest;
use App\Models\Moneybox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoneyboxController extends Controller
{
    public function index()
    {
        $moneybox = Moneybox::where('user_id', Auth::id())->first();
        if ($moneybox) {
            $moneybox->progress = Moneybox::getPercentage($moneybox->in_stock, $moneybox->purpose);
        }

        return view('admin.moneybox.index', [
            'moneybox' => $moneybox,
        ]);
    }

    public function store(MoneyboxRequest $request)
    {
        $moneybox = new Moneybox();

        $moneybox->user_id = Auth::id();
        $moneybox->purpose = $request->purpose;
        $moneybox->in_stock = 0;
        $moneybox->title = $request->title;
        $moneybox->image = $request->image;

        if ($moneybox->save()) {
            return redirect()->back()->withSuccess('Копилка создана');
        }
    }

    public function update(UpdateMoneyboxRequest $request)
    {
        $moneybox = Moneybox::where('user_id', Auth::id())->first();
        $moneybox->in_stock += $request->in_stock;
        if ($moneybox->save()) {
            return redirect()->back()->withSuccess('Данные обновлены');
        }
    }

    public function destroy()
    {
        $task = Moneybox::where('user_id', Auth::id())->first();
        $task->delete();

        return redirect()->back()->withSuccess('Копилка удалена');
    }
}
