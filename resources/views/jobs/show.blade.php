<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>

    <x-forms.form>
        @can('edit', $job)
            <div class="mt-6 flex  justify-between">
                <a class="bg-red-800 rounded py-2 px-6 font-bold"" href="/">Back</a>
                <a class="bg-blue-800 rounded py-2 px-6 font-bold"" href="/jobs/{{ $job->id }}/edit">Edit Job</a>
            </div>
        @endcan
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" disabled />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" disabled />
        <x-forms.input label="Schedule" name="schedule" value="{{ $job->schedule }}" disabled />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" value="{{ $job->featured }}" />
        <x-forms.link label="Url" name="url" href="{{ $job->url }}" />
        <x-forms.divider />
        <div class="space-x-5">
            @foreach ($job->tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>
        @can('destroy', $job)
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>
        @endcan
    </x-forms.form>
    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
