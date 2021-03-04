<?php

if (!function_exists('paymentCostToString')) {
    function paymentCostToString(int $cost): string {
        $floatCost = round((float) $cost / 100, 2);
        
        return number_format($floatCost, 2, '.', '');
    }
}

if (!function_exists('paymentStringCostToInteger')) {
    function paymentStringCostToInteger(string $cost): ?int {
        if (!preg_match('/(0|([1-9]\d*))([.,](\d){1,2})?/', $cost)) {
            return 0;
        }
        
        if (\Illuminate\Support\Str::contains($cost, ',')) {
            $cost = str_replace(',', '.', $cost);
        }
        
        $floatCost = (float) $cost;
        $result = number_format($floatCost, 2, '|', '');
        $result = str_replace('|', '', $result);
        
        return (int) $result;
    }
}
