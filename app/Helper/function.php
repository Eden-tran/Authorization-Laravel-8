<?php

use App\Models\doctors;

function isDoctorActive($email)
{
    $count = Doctors::where('email', $email)->where('is_active', 1)->count();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}
