<x-admin-layout>
    <x-slot name="title">
        Survey
    </x-slot>
@livewire('view-survey', ['survey_selected' => $survey_selected, 'user' => $user])
</x-admin-layout>