Filament Repeater + Relationship issue

Run migrations + seeds and serve

The code is in the `EditUser.php` file

Here is the form definition


```php
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
                ])
        ])
        ->statePath('data')
        ->model($this->record);
}
```

I have tried changing the name of the repeater to be different from the relationship, but it didn't work.

