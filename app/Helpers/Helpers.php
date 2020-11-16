<?php

function printHello2()
{
    return 'Hello Golden 22';
}

function getAdminUserName($id)
{
    $result = App\User::where('id',$id)->first();

    return $result->name;
}