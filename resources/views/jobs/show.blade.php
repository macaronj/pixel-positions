<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>

    <x-forms.form>
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" disabled />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" disabled />
        <x-forms.input label="Schedule" name="schedule" value="{{ $job->schedule }}" disabled />
        <x-forms.link label="Url" name="url" href="{{ $job->url }}" />
        <x-forms.divider />
        <div class="space-x-5">
            @foreach ($job->tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>
    </x-forms.form>

</x-layout>
