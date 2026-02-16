<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniForm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'student_number',
        'first_name',
        'middle_initial',
        'last_name',
        'contact_number',
        'email',
        'address',
        'program_taken',
        'year_batch_graduated',
        'employment_status',
        'sector_of_employment',
        'company_name',
        'work_location',
        'overall_rating',
        'data_privacy_consent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year_batch_graduated' => 'integer',
            'overall_rating' => 'integer',
            'data_privacy_consent' => 'boolean',
        ];
    }

    /**
     * The user who submitted this form.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
