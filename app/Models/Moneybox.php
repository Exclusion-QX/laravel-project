<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneybox extends Model
{
    use HasFactory;

    protected $table = 'moneybox';

    /**
     * Метод считает процент числа от определенного значения
     *
     * @param $first
     * @param $second
     * @return float|int
     */
    public static function getPercentage($first, $second)
    {
        return round($first / $second * 100, 0, PHP_ROUND_HALF_DOWN);
    }
}
