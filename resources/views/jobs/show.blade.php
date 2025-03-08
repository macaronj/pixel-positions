<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>

    <x-forms.form>
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" />
        <x-forms.input label="Schedule" name="schedule" value="{{ $job->schedule }}" />
        <x-forms.label label="{{ $job->url }}" name="url"
            href="{{ $job->url }}">{{ $job->url }}</x-forms.label>

        {{-- <x-forms.divider /> --}}

        {{-- <x-forms.input label="Tags (comma separated)" name="tags" value="{{ $job->tags }}" /> --}}
        <div class="space-x-5">

            @foreach ($job->tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>

        {{-- <x-forms.button>Publish</x-forms.button> --}}
    </x-forms.form>

</x-layout>
