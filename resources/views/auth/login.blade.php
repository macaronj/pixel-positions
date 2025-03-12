<x-layout>
    <x-page-heading>Log In</x-page-heading>

    <x-forms.form method="POST" action="/login">
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <div>

            <x-forms.button class="block">Log In</x-forms.button>
        </div>
    </x-forms.form>
</x-layout>
