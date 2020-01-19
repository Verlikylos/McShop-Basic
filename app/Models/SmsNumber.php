<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsNumber
 *
 * @property int $id
 * @property string $operator
 * @property string $number
 * @property int $netto_cost
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber whereNettoCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsNumber whereOperator($value)
 * @mixin \Eloquent
 */
class SmsNumber extends Model
{
    public $timestamps = false;

    public $guarded = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return float
     */
    public function getNettoCost(): float
    {
        return round((float) $this->netto_cost / 100, 2);
    }

    public function getNettoCostFormated(): string
    {
        return number_format($this->getNettoCost(), 2, ',', ' ') . ' zł';
    }

    public function getBruttoCost(): float
    {
        return round((float) ($this->netto_cost * 1.23) / 100, 2);
    }

    public function getBruttoCostFormated(): string
    {
        return number_format($this->getBruttoCost(), 2, ',', ' ') . ' zł';
    }


}
