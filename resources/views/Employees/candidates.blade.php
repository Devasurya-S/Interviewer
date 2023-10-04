<!-- resources/views/child.blade.php -->

@extends('employees.layout')
 
@section('title', 'Candiates')
 
@section('sidebar')
    @parent
@endsection
 
@section('candidates')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('candidate.groups')" :addHref="route('employee.candidate.add.page')" :item="'Candidate'"/>

        <table class="min-w-full text-left text-sm font-light">
            <thead class="bg-white font-medium">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                <tr class="{{ $loop->even ? 'bg-neutral-100 dark:border-neutral-500' : 'bg-white' }} text-center">
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->user_id }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->name }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->group }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->email }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->password }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->mobile_number }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $candidate->status }}</td>
                    <td class="whitespace-nowrap px-6 py-4 flex justify-center">
                        <form method="post" action="{{ route('candidate.update.page',$candidate->user_id) }}">
                            @csrf
                            <button class="hover:bg-blue-500 hover:text-white font-semibold py-1 px-4 rounded-xl">Update</button>
                        </form>
                        <form method="POST" action="{{ route('candidate.delete') }}">
                            @csrf
                            <input type="number" name="keyData" value="{{ $candidate->user_id }}" hidden/> 
                            <button class="hover:bg-red-500 hover:text-white font-semibold py-1 px-4 rounded-xl">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection