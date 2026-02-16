<?php

namespace App\Services;

use App\Models\AlumniInfo;
use App\Repositories\AlumniInfoRepository;
use Illuminate\Support\Facades\DB;

class AlumniInfoService
{
    public function __construct(
        protected AlumniInfoRepository $repo
    ) {}

    public function store(array $validated): AlumniInfo
    {
        return DB::transaction(function () use ($validated) {
            $validated['email'] = strtolower($validated['email']);
            $validated['user_id'] = auth()->id();
            $validated['middle_initial'] = $this->normalizeMiddleInitial($validated['middle_initial'] ?? null);
            $validated['sector_of_employment'] = $validated['sector_of_employment'] ?? 'N/A';

            return $this->repo->create($validated);
        });
    }

    public function update(AlumniInfo $alumniInfo, array $validated): AlumniInfo
    {
        return DB::transaction(function () use ($alumniInfo, $validated) {
            $validated['email'] = strtolower($validated['email']);
            $validated['middle_initial'] = $this->normalizeMiddleInitial($validated['middle_initial'] ?? null);
            $validated['sector_of_employment'] = $validated['sector_of_employment'] ?? 'N/A';

            return $this->repo->update($alumniInfo, $validated);
        });
    }

    private function normalizeMiddleInitial(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return strtoupper(substr($value, 0, 1));
    }
}
