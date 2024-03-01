<?php

function getFullName($person){
    return $person->last_name." ".$person->middle_name." ".$person->first_name;
}