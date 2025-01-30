<x-layout>
    <x-slot:heading>
        Jobs's page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach($jobs as $job)
            <a href="/jobs/{{$job->id}}" class="border-2 rounded-md border-gray-200 block px-4 py-4">
                <div class="text-blue-400">
                    {{$job->employer->name}}
                </div>
                <div>
                    <strong>{{ $job->title}} : </strong>Salary {{ $job->salary}}
                </div>
            </a>
        @endforeach
    </div>
</x-layout>

