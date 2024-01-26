<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Page;
use Filament\Resources\Pages\Concerns\HasWizard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class WizardBug extends Page
{
    use HasWizard;

    public array $data = [];

    public function mount()
    {
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Step 1')
                    ->schema([
                        Toggle::make('something')
                            ->label('Show step 2')
                            ->default(true)
                            ->hint('Enable this and go to Step 3')
                            ->live()
                    ]),
                Wizard\Step::make('Hidden step')
                    ->visible(fn (Get $get) => $get('something'))
                    ->schema([
                    ]),
                Wizard\Step::make('Step 3')
                    ->schema([
                        FileUpload::make('media')
                            ->hint('Open the browser console and try to upload a file')
                    ])
            ])
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                        <x-filament::button
                            type="submit"
                            size="sm"
                        >
                            Submit
                        </x-filament::button>
                    BLADE)))
        ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        dd($data);
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.wizard-bug';
}
