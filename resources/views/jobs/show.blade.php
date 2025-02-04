<x-layout>
    <x-slot:heading>
        Job's page
    </x-slot:heading>

    <ul>
        <li><strong>{{ $job->title}} : </strong>Salary {{ $job->salary }}</li>
    </ul>

    @can('edit-job',$job)
        <x-button href="/jobs/{{ $job->id }}/edit" class="mt-3">
            Edit job
        </x-button>
    @endcan
</x-layout>

