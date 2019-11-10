<?php
require 'functions.php';
// These are the jobs requirements for all companies
$requirements = [

    'A' => [
        'required' => ['property insurance'],
        'conditional' => [
            ['apartment', 'house'],
        ],
    ],
    'B' => [
        'required' => ['driver\'s license', 'car insurance'],
        'conditional' => [
            ['5 door car', '4 door car'],
        ],
    ],
    'C' => [
        'required' => ['social security number', 'work permit'],
    ],
    'D' => [
        'conditional' => [
            ['apartment', 'flat', 'house'],
        ],
    ],
    'E' => [
        'required' => ['driver\'s license'],
        'conditional' => [
            ['2 door car', '3 door car', '4 door car', '5 door car'],
        ],
    ],
    'F' => [
        'required' => ['driver\'s license', 'motorcycle insurance'],
        'conditional' => [
            ['scooter', 'bike', 'motorcycle'],
        ],
    ],
    'G' => [
        'required' => ['massage qualification certificate', 'liability insurance'],
    ],
    'H' => [
        'conditional' => [
            ['storage place', 'garage'],
        ],
    ],
    'J' => [],
    'K' => [
        'required' => ['PayPal account'],
    ],
];

//This is the person qualifications
$qualifications = ['bike', 'driver\'s license'];

$opportunities = $badLuck = '';

$companiesScore = findJob($requirements, $qualifications);
//split the companies into two arrays based on the score
foreach ($companiesScore as $company => $score) {
    if ($score >= 60) {
        $opportunities .= "<li>$company (Matching: $score%)</li>";
    } else {
        $badLuck .= "<li>$company (Matching: $score%)</li>";
    }
}

//Display the results
if (! empty($opportunities)) {
    echo "<b>Companies you can work:</b>";
    echo "<ul>$opportunities</ul>";
}
if (! empty($badLuck)) {
    echo "<b>Companies you can not work:</b>";
    echo "<ul>$badLuck</ul>";
}