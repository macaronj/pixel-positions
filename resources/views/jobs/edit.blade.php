<x-layout>
    <x-page-heading>Edit Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('PATCH')
        @can('update', $job)
            <div class="mt-6 flex justify-between">
                <a class="bg-red-800 rounded py-2 px-6 font-bold"" href="/jobs/{{ $job->id }}">Cancel</a>
                <x-forms.button>Update</x-forms.button>
            </div>
        @endcan
        <x-forms.input label="Title" name="title" placeholder="CEO" value="{{ $job->title }}" />
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" value="{{ $job->salary }}" />
        <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida"
            value="{{ $job->location }}" />

        <x-forms.select label="Schedule" name="schedule" value="{{ $job->schedule }}">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted"
            value="{{ $job->url }}" />

        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" value="{{ $job->featured }}" />

        <x-forms.divider />

        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="laracasts, video, education" />
        <x-forms.divider />

        <div class="space-x-5">
            @foreach ($job->tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>
    </x-forms.form>
</x-layout>
