<!-- sidebar.blade.php -->
<div class="flex flex-col h-full w-64 p-8">
    <a class="py-2 px4 {{ Route::currentRouteName() === 'answer.group' ? 'bg-[#0560FD] text-white' : 'text-black hover:bg-[#0560FD]' }} hover:text-white text-center w-40 rounded-xl" href="{{ route('answer.group'); }}">Answers</a>
    <a class="py-2 px4 {{ Route::currentRouteName() === 'interview.view' ? 'bg-[#0560FD] text-white' : 'text-black hover:bg-[#0560FD]' }} hover:text-white w-40 rounded-xl mt-5 text-center" href="{{ route('interview.view') }}">Interview</a>
    <a class="py-2 px4 {{ Route::currentRouteName() === 'candidate.view' ? 'bg-[#0560FD] text-white' : 'text-black hover:bg-[#0560FD]' }} hover:text-white w-40 rounded-xl mt-5 text-center" href="{{ route('candidate.groups') }}">Candidates</a>
</div>
