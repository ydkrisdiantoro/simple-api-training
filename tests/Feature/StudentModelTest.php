<?php

use App\Models\Student;

it('has a name attribute', function(){
    $payload = [
        'name' => 'Yayan',
        'birth_date' => date('Y-m-d'),
        'address' => 'Address',
        'year_in' => date('Y'),
        'phone' => '0811111111111',
    ];

    $student = new Student($payload);
    expect($student->name)->toBe('Yayan');
    expect($student->year_in)->toBe(date('Y'));
});
