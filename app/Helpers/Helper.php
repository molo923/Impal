<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('banksampah')) {
    /**
     * Check for user role
     */
    function banksampah()
    {
        if (!Auth::check()) {
            return null;
        }

        if (Auth::user()->pegawai) {
            return Auth::user()->pegawai->banksampah;
        }

        return Auth::user()->banksampah;
    }
}

if (!function_exists('check_status')) {
    function check_status($status, $status_check)
    {
        return (int) $status === config('constants.statuses.'.$status_check);
    }
}

if (!function_exists('abbr')) {
    function abbr($string){
        $abbreviation = "";
        $string = ucwords($string);
        $words = explode(" ", "$string");
        if (count($words) > 1) {
            for($i = 0; $i < 2; $i++){
                $abbreviation .= $words[$i][0];
            }
        } else {
            $abbreviation = $words[0][0];
        }
        return $abbreviation;
    }
}

if (!function_exists('pegawai')) {
    /**
     * Check for user role
     */
    function pegawai($type = null)
    {
        if (!Auth::check()) {
            return null;
        }

        if (!$type) {
            return Auth::user()->pegawai;
        }

        return Auth::user()->pegawai->type === $type ? Auth::user()->pegawai : null;
    }
}
