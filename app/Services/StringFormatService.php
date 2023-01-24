<?php

namespace App\Services;

class StringFormatService
{
    public function asEmpty($txt)
    {
        return $txt ?: 'N/A';
    }

    public function asDate($ts = null, $flag = 4)
    {
        $ts = $ts ?: date('Y-m-d H:i:s.u');
        $flags = ['YmdHisu', 'D, M j, Y', 'H:i A', 'D, M j, Y \a\t h:i A', 'D, M j, Y <\b\\r> h:i A'];

        if (is_numeric($flag) && $flag < count($flags)) {
            $flag = $flags[$flag];
        }

        return date($flag, strtotime($ts));
    }

    public static function asCash($n)
    {
        $n_int = (int) $n;
        $n_str = (string) $n;

        if (str_replace(',', '', $n_str) && is_numeric($n) && $n > 999) {
            $n = number_format($n_int);
            if (strpos($n_str, '.') != false) {
                $dp = explode('.', $n_str)[1];
                $n .= '.' . $dp;
            }
        }
        return (string) $n;
    }

    public function asCity($str)
    {
        if (strlen($str) > 0) {
            return strtolower($str) === 'gra' || strtolower($str) === 'g.r.a' ? 'G.R.A' : ucwords($str);
        } else {
            return 'N/A';
        }
    }

    public function asBadge($txt, $flag = 'info')
    {
        $flags = ['info' => 'bg-info text-dark', 'secondary' => 'bg-secondary'];
        return sprintf('<b class="badge %s fw-normal font-size-12" role="button">%s</b>', $flags[$flag], $txt);
    }

    public function asPartyAvatar($abbr)
    {
        $avatar = 'storage/uploads/' . strtolower($abbr) . '.png';
        return sprintf('<img src="%s" alt="%s" class="rounded-circle me-2" width="32" height="32">', asset($avatar), $abbr);
    }
}
