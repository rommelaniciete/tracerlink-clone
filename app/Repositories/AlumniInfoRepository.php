<?php

namespace App\Repositories;

use App\Models\AlumniInfo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AlumniInfoRepository
{
    public function create(array $data): AlumniInfo
    {
        return AlumniInfo::create($data);
    }

    public function upsertForUser(int $userId, array $data): AlumniInfo
    {
        return AlumniInfo::updateOrCreate(
            ['user_id' => $userId],
            $data
        );
    }

    public function update(AlumniInfo $alumniInfo, array $data): AlumniInfo
    {
        $alumniInfo->update($data);
        return $alumniInfo->refresh();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return AlumniInfo::query()->latest()->paginate($perPage);
    }

    public function findOrFail(int $id): AlumniInfo
    {
        return AlumniInfo::query()->findOrFail($id);
    }
}
