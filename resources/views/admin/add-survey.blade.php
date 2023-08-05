<x-admin-manage-layout>
    <form wire:submit.prevent="updateProfile">
        @csrf
        <button>Add Question</button>
        {{-- tas may lalabas na input at select dropdown para makapili kung anong input type --}}
        <input type="text">
        <select>
            <option value=""> --Select Input Type-- </option>
            <option value="text">text</option>
            <option value="select">dropdown</option>
            <option value="checkbox">checkbox</option>
            <option value="radio">radio</option>
            <option value="file">file</option>
        </select>
        {{-- tas mag chchange ung input type base sa sinelect na type --}}
        {{-- tas kada input type magkaka name ng question1, question2, dynamic ung number --}}
        <input name="question . {{ 1 }}" type="checkbox">
    </form>
</x-admin-manage-layout>
