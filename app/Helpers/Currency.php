<?php

namespace App\Helpers;

use NumberFormatter;

class Currency{

     // بيتم استدعاء هذه المجكميثودfunction لو تم استداعاء الكلاس  ك
     public function __invoke(...$params)
     {

                    // format function هان بقله استدعي
         return static::format(...$params);

     }


    public static function format($amount, $currency = null){

         $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currency===null){
            $currency=config('app.currency','USD');
        }
         return $formatter->formatCurrency($amount,$currency);

    }



}
