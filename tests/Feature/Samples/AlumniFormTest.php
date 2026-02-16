<?php

namespace Tests\Feature\Samples;

use App\Models\AlumniForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlumniFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_submit_an_alumni_form()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('samples.form.store'), $this->payload());

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('samples.form'));

        $this->assertDatabaseHas('alumni_forms', [
            'user_id' => $user->id,
            'student_number' => '2022-0001',
            'email' => 'juan.delacruz@example.com',
        ]);
    }

    public function test_submission_requires_required_fields()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('samples.form'))
            ->post(route('samples.form.store'), []);

        $response
            ->assertSessionHasErrors([
                'student_number',
                'first_name',
                'last_name',
                'contact_number',
                'email',
                'address',
                'program_taken',
                'year_batch_graduated',
                'employment_status',
                'sector_of_employment',
                'overall_rating',
                'data_privacy_consent',
            ])
            ->assertRedirect(route('samples.form'));
    }

    public function test_authenticated_user_can_update_their_alumni_form()
    {
        $user = User::factory()->create();

        $alumniForm = AlumniForm::query()->create([
            ...$this->payload(),
            'user_id' => $user->id,
        ]);

        $payload = [
            ...$this->payload(),
            'company_name' => 'Updated Company',
            'work_location' => 'Davao',
            'overall_rating' => '5',
        ];

        $response = $this
            ->actingAs($user)
            ->put(route('samples.form.update', $alumniForm->id), $payload);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('samples.form'));

        $this->assertDatabaseHas('alumni_forms', [
            'id' => $alumniForm->id,
            'company_name' => 'Updated Company',
            'work_location' => 'Davao',
            'overall_rating' => 5,
        ]);
    }

    public function test_user_cannot_update_another_users_alumni_form()
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();

        $alumniForm = AlumniForm::query()->create([
            ...$this->payload(),
            'user_id' => $owner->id,
        ]);

        $response = $this
            ->actingAs($intruder)
            ->put(route('samples.form.update', $alumniForm->id), $this->payload());

        $response->assertNotFound();
    }

    /**
     * @return array<string, string|bool>
     */
    private function payload(): array
    {
        return [
            'student_number' => '2022-0001',
            'first_name' => 'Juan',
            'middle_initial' => 'D',
            'last_name' => 'Dela Cruz',
            'contact_number' => '09171234567',
            'email' => 'juan.delacruz@example.com',
            'address' => '123 Sample Street',
            'program_taken' => 'BS Information Technology',
            'year_batch_graduated' => '2024',
            'employment_status' => 'employed',
            'sector_of_employment' => 'private',
            'company_name' => 'Tracerlink',
            'work_location' => 'Manila',
            'overall_rating' => '4',
            'data_privacy_consent' => true,
        ];
    }
}
