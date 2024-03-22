<?php

namespace App\Repositories;

use App\Models\Unit;

final class UnitRepository
{
    public function addUnit(string $unitname)
    {
        Unit::create([
            'unitname' => $unitname,
        ]);
    }

    public function getUnit(int $unitId)
    {
        return Unit::where('id', $unitId)
            ->first();
    }

    public function getUnits()
    {
        return Unit::all();
    }

    public function getUnitId(string $unitname)
    {
        $unit = Unit::firstOrCreate(['unitname' => $unitname]);
        return $unit->id;
    }

    public function doesUnitExist(string|int $UnitNameOrId)
    {
        return Unit::where('id', $UnitNameOrId)
            ->orWhere('unitname', $UnitNameOrId)
            ->exists();
    }

}