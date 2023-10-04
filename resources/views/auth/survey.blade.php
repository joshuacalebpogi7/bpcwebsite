<x-layout>
    <h1>This is a survey form</h1>
    <div>
        <form action="/submit-survey" method="POST">
            @csrf
            <input type="hidden" name="survey_completed">
            <button>Submit</button>
        </form>
    </div>
</x-layout>