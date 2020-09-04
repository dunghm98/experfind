<?php

function format_date(string $date, string $format = 'Y-m-d')
{
    return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format($format);
}

function getYear(string $date, string $format = 'Y-m-d')
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->year;
}
