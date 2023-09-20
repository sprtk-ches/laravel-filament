<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditUser extends Component implements HasForms
{
    use InteractsWithForms;

    public int $userId = 1;

    public ?array $data = [];

    public User $record;

    public function mount(): void
    {
        $this->record = User::findOrFail($this->userId);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Repeater::make('userRoles')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('role_id')
                            ->relationship('role', 'name'),
                        Forms\Components\Checkbox::make('is_active'),
                        Forms\Components\Checkbox::make('is_something_else'),
                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.edit-user');
    }
}
