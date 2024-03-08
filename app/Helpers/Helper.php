<?php
use Illuminate\Support\Carbon;
function getFullName($person){
    return $person->last_name." ".$person->middle_name." ".$person->first_name;
}

function getAge($date) {
    $currentYear = Carbon::create();
    return $currentYear->subYears($date)->year;
}