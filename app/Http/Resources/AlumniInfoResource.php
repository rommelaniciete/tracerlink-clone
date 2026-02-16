<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // PERSONAL
            'student_number' => $this->student_number,
            'first_name' => $this->first_name,
            'middle_initial' => $this->middle_initial,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'address' => $this->address,

            // ACADEMIC
            'program_taken' => $this->program_taken,
            'year_batch_graduated' => $this->year_batch_graduated,

            // EMPLOYMENT
            'employment_status' => $this->employment_status,
            'sector_of_employment' => $this->sector_of_employment,
            'company_name' => $this->company_name,
            'work_location' => $this->work_location,

            // FEEDBACK
            'overall_rating' => $this->overall_rating,

            // CONSENT
            'data_privacy_consent' => (bool) $this->data_privacy_consent,

            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
        ];
    }
}
