<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAlumniInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // PERSONAL
            'student_number' => ['required', 'string', 'max:50', Rule::unique('alumni_forms', 'student_number')],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'last_name' => ['required', 'string', 'max:100'],
            'contact_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', Rule::unique('alumni_forms', 'email')],
            'address' => ['required', 'string', 'max:1000'],

            // ACADEMIC
            'program_taken' => ['required', 'string', 'max:150'],
            'year_batch_graduated' => ['required', 'integer', 'min:1900', 'max:2100'],

            // EMPLOYMENT
            'employment_status' => ['required', 'string', 'in:Employed,Unemployed,Self-Employed,Student,Other'],
            'sector_of_employment' => ['nullable', 'string', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'work_location' => ['nullable', 'string', 'max:255'],

            // FEEDBACK
            'overall_rating' => ['required', 'integer', 'min:1', 'max:5'],

            // CONSENT
            'data_privacy_consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'data_privacy_consent.accepted' => 'You must agree to the data privacy consent to proceed.',
        ];
    }
}
