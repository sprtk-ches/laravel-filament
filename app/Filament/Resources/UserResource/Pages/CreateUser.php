<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{

    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Step 1')
                ->schema([
                    Toggle::make('toggle')
                        ->dehydrated(false)
                        ->label('Show step 2')
                        ->live()
                ]),
            Step::make('Hidden step')
                ->visible(fn (Get $get) => $get('toggle'))
                ->schema([

                ]),
            Step::make('Step 3')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('media')
                        ->image()
                        ->multiple()
                        ->openable()
                        ->visibility('private')
                ])
        ];
    }
}
