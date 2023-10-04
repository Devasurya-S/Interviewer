@props(['name', 'itemId', 'itemCode', 'viewStatus'])

<div class="box-border h-60 w-52 {{ $viewStatus == 0 ? 'bg-white' : 'bg-gray-100' }} bg-white rounded-xl shadow-md mx-2 flex flex-col justify-center items-center p-2">
    @if ($itemCode=='1')
        <p class="text-center">{{ $name }}</p>
    @else
    <p class="text-center">Click to view Message</p>
    @endif
    @if ($itemCode == '1')
        <form method="POST" action="{{ route('candidate.interview.view') }}">
    @else
        <form method="POST" action="{{ route('candidate.feedback.view') }}">
    @endif
            @csrf
            <input hidden name="id" value="{{ $itemId }}"/>
            <button class="bg-[#0560FD] rounded-xl text-white py-2 px-4 w-20 mt-4" type="submit">View</button>
        </form>
</div>