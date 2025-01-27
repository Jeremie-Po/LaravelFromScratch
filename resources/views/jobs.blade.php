<x-layout>
    <x-slot:heading>
        Jobs's page
    </x-slot:heading>

    <h1>Jobs's page</h1>

    @foreach($jobs as $job)
        <li><strong>{{ $job['name'] }} : </strong>Salary {{ $job['salary'] }}</li>
    @endforeach
</x-layout>

