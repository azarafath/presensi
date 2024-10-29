<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Schedule;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;
}
