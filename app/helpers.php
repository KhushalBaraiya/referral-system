<?php

function getAllReferrals($user, $level = 1)
{
    $result = [];

    foreach ($user->children as $child) {

        $result[] = [
            'user' => $child,
            'level' => $level,
        ];

        // Recursive call
        $result = array_merge(
            $result,
            getAllReferrals($child, $level + 1)
        );
    }

    return $result;
}


function calculateIncome($referrals)
{
    $total = 0;

    foreach ($referrals as $item) {

        $level = $item['level'];

        if ($level == 1) {
            $total += 100;
        } elseif ($level == 2) {
            $total += 50;
        } elseif ($level == 3) {
            $total += 25;
        } else {
            $total += 10;
        }
    }

    return $total;
}
