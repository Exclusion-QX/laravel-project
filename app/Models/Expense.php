<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    use HasFactory;

    /**
     * Метод возвращает значение затрат на текущий день
     *
     * @return mixed
     */
    public static function getExpensesToday()
    {
        $today = date('Y-m-d');

        $expenses = self::where([
            ['date_spent', $today],
            ['user_id', Auth::id()]
        ])->value('spent');

        return $expenses;
    }

    /**
     * Метод получает массив затрат по дням за текущий месяц
     *
     * @return array
     */
    public static function getExpensesArr(): array
    {
        $start = new Carbon('first day of this month'); // начальная дата в текущем месяце
        $from = $start->isoFormat('Y-M-DD');
        $end = new Carbon('last day of this month');    // конечная дата в текущем месяце
        $to = $end->isoFormat('Y-M-DD');

        $arrayData = self::where('user_id', Auth::id())      // получаем затраты за месяц
            ->whereBetween('date_spent', [$from, $to])
            ->get();

        $arrayData = $arrayData->sortBy('date_spent');

        $tmpArr = [];
        $arrExpenses = [];

        foreach ($arrayData as $data) {
            $tmpArr[$data['date_spent']] = $data['spent'];
        }

        // Формирование массива затрат за месяц, с учетом не указанных дней
        for ($day = $start; $day < $end; $day->addDays(1)) {
            $strDay = $day->isoFormat('Y-M-DD');
            if (array_key_exists($strDay, $tmpArr)) {
                array_push($arrExpenses, $tmpArr[$strDay]);
            } else {
                array_push($arrExpenses, 0);
            }
        }

        return $arrExpenses;
    }

}
