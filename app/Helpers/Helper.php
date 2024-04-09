<?php
use Illuminate\Support\Carbon;
function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route))
            return "active";
    }
}
function getFullName($person){
    return $person->last_name." ".$person->middle_name." ".$person->first_name;
}

function getAge($date) {
    $currentYear = Carbon::create();
    return $currentYear->subYears($date)->year;
}



// Check table is Empty 
function isTableEmpty($model){
    return $model->isEmpty();
}


// Get Workplace Address 
function getWorkplaceAddress($model) {
    return $model->address. " ".$model->city." ".$model->province;
}