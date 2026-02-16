<?php

namespace App\Http\Controllers;

use App\Models\AlumniInfo;
use Inertia\Inertia;
use App\Services\AlumniInfoService;
use App\Http\Resources\AlumniInfoResource;
use App\Http\Requests\StoreAlumniInfoRequest;
use App\Http\Requests\UpdateAlumniInfoRequest;

class AlumniInfoController extends Controller
{
    public function __construct(
        protected AlumniInfoService $service
    ) {}

    public function create()
    {
        return Inertia::render('AlumniInfo/Create');
    }

    public function edit(AlumniInfo $alumniInfo)
    {
        return Inertia::render('AlumniInfo/Edit', [
            'alumniInfo' => new AlumniInfoResource($alumniInfo),
        ]);
    }

    public function store(StoreAlumniInfoRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('alumni-info.create')
            ->with('success', 'Submitted successfully.');
    }

    public function update(UpdateAlumniInfoRequest $request, AlumniInfo $alumniInfo)
    {
        $updated = $this->service->update($alumniInfo, $request->validated());

        return redirect()
            ->back()
            ->with('success', 'Updated successfully.');
    }
}
