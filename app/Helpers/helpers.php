<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

function getToday()
{
    return date('Y-m-d');
}

function getFullTime()
{
    return date('Y-m-d H:i:s');
}

function formatWaktuHis($x)
{
    return Carbon::parse($x)->format('H:i:s');
}

function formatWaktuHuman($x)
{
    return Carbon::parse($x)->diffForHumans();
}

function formatDateIndo($x)
{
    Carbon::setLocale('id');
    return Carbon::parse($x)->translatedFormat('l, d F Y');
    // return Carbon::parse($x)->translatedFormat('d-m-Y');
}

function formatWaktuHi($x)
{
    return Carbon::parse($x)->format('H:i');
}


function formatNumberIfDecimalV2($number)
{
    if (floor($number) != $number) {
        $decimalPart = explode('.', (string) $number);
        $decimalLength = isset($decimalPart[1]) ? strlen(rtrim($decimalPart[1], '0')) : 0;
        $number = number_format($number, $decimalLength, '.', '');
    } else {
        $number = number_format($number, 0, '.', '');
    }

    return round($number, 6);
}


function formatNumberV2($number)
{
    if (floor($number) != $number) {
        $decimalPart = explode('.', (string) $number);
        $decimalLength = isset($decimalPart[1]) ? strlen(rtrim($decimalPart[1], '0')) : 0;
    } else {
        $decimalLength = 0;
    }

    $decimalLength = min($decimalLength, 6);

    return Number::format($number, $decimalLength, locale: app()->getLocale());
}

function formatCurrency($number, $currency = 'IDR')
{
    return Number::currency($number, $currency, locale: app()->getLocale());
}

function formatCurrencyPlain($number, $locale = 'id_ID')
{
    $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
    $formatted = $formatter->formatCurrency($number, 'IDR');
    $symbol = $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    return trim(str_replace($symbol, '', $formatted));
}
