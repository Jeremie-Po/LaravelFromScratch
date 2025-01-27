<x-layout>
    <x-slot:heading>
        Job's page
    </x-slot:heading>
    <ul>
        <li><strong>{{ $job['title'] }} : </strong>Salary {{ $job['salary'] }}</li>
    </ul>
</x-layout>

