<x-layout>
    <x-slot:heading>
        Job's page
    </x-slot:heading>
    <ul>
        <li><strong>{{ $job['name'] }} : </strong>Salary {{ $job['salary'] }}</li>
    </ul>
</x-layout>

