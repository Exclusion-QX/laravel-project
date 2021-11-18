<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Finance extends Model
{
    use HasFactory;

    /**
     * Метод считает доступные средства (в день, неделю, месяц), по указанным доходам и расходам
     *
     * @return array
     */
    public function getAvailableFinances(): array
    {
        $number_days = date('t');
        $available_f = $this->income - $this->forced_expenses - $this->expenses - $this->saving;
        $f_month = round($available_f, 0, PHP_ROUND_HALF_DOWN);
        $f_week = round($available_f / 4, 0, PHP_ROUND_HALF_DOWN);
        $f_day = round($available_f / $number_days, 0, PHP_ROUND_HALF_DOWN);
        return [
            'month' => $f_month,
            'week' => $f_week,
            'day' => $f_day
        ];
    }

    /**
     * Метод формирует массив доступных средств по дням
     *
     * @param $available_f
     * @return array
     */
    public function getAvailableFinancesArr($available_f): array
    {
        $arrayData = [];
        for ($i = 0; $i < date('t'); $i++) {
            array_push($arrayData, $available_f);
        }
        return $arrayData;
    }

}
