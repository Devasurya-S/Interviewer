<!-- resources/views/child.blade.php -->
 
@extends('employees.layout')
 
@section('title', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('candidateAnswers')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <table class="min-w-full text-left text-sm font-light">
            <thead class="bg-white font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4 font-bold text-gray-600">Candidate Name</th>
                    <th scope="col" class="px-6 py-4 font-bold text-gray-600">Question</th>
                    <th scope="col" class="px-6 py-4 font-bold text-gray-600">Answer</th>
                    <th scope="col" class="px-6 py-4 font-bold text-gray-600">Feedback</th>
                    <th scope="col" class="px-6 py-4 text-center font-bold text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($answers as $answer)
                <tr class="{{ $loop->even ? 'bg-neutral-100 dark:border-neutral-500' : 'bg-white' }}">
                    <td class="whitespace-nowrap px-6 py-4">{{ $answer->candidate_name }}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{ $answer->question }}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if ($answer->video_path === null)
                            Not Submitted
                        @else
                            Submitted
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @if ($answer->feedback === null)
                            Not Submitted
                        @else
                            Submitted
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 flex justify-center">
                        <form method="post" action="{{ route('answer.view.selected') }}">
                            @csrf
                            <input type="number" name="answerId" value="{{ $answer->id }}" hidden/>
                            <button class="hover:bg-blue-500 hover:text-white font-semibold py-1 px-4 rounded-xl">View</button>
                        </form>
                        <form method="post" action="{{ route('answer.delete.selected') }}">
                            @csrf
                            <input type="number" name="answerId" value="{{ $answer->id }}" hidden/> 
                            <button class="hover:bg-red-500 hover:text-white font-semibold py-1 px-4 rounded-xl">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection