<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniInfo extends Model
{
    protected $table = 'alumni_forms';

    protected $fillable = [
        'user_id',

        // PERSONAL INFORMATION
        'student_number',
        'first_name',
        'middle_initial',
        'last_name',
        'contact_number',
        'email',
        'address',

        // ACADEMIC INFORMATION
        'program_taken',
        'year_batch_graduated',

        // EMPLOYMENT INFORMATION
        'employment_status',
        'sector_of_employment',
        'company_name',
        'work_location',

        // FEEDBACK
        'overall_rating',

        // CONSENT
        'data_privacy_consent',
    ];

    protected $casts = [
        'year_batch_graduated' => 'integer',
        'data_privacy_consent' => 'boolean',
        'overall_rating' => 'integer',
    ];
}
