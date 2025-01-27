<x-layout>
    <x-slot:heading>
        Jobs's page
    </x-slot:heading>

    <ul>
        @foreach($jobs as $job)
            <a href="/jobs/{{$job['id']}}" class="text-blue-500 hover:underline">
                <li><strong>{{ $job['name'] }} : </strong>Salary {{ $job['salary'] }}</li>
            </a>
        @endforeach
    </ul>
</x-layout>

