<div>
    <form wire:submit="save">
        {{ $this->form }}

        <x-primary-button class="my-4" type="submit">
            Submit
        </x-primary-button>
    </form>

    <x-filament-actions::modals />
</div>
