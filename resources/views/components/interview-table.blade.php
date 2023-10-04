<!-- table.blade.php -->
<table class="min-w-full text-left text-sm font-light">
    <thead class="bg-white font-medium">
        <tr>
            <th scope="col" class="px-6 py-4 font-bold text-gray-600">Name</th>
            <th scope="col" class="px-6 py-4 font-bold text-gray-600">Question</th>
            <th scope="col" class="px-6 py-4 font-bold text-gray-600">Active For</th>
            <th scope="col" class="px-6 py-4 text-center font-bold text-gray-600">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($interviews as $interview)
        <tr class="{{ $loop->even ? 'bg-neutral-100 dark:border-neutral-500' : 'bg-white' }}">
            <td class="whitespace-nowrap px-6 py-4">{{ $interview->interview_name }}</td>
            <td class="whitespace-nowrap px-6 py-4">{{ $interview->question }}</td>
            <td class="whitespace-nowrap px-6 py-4">
                @foreach($interviewStatus as $status)
                    @if ($status->interview_id === $interview->interview_id)
                    {{ $status->group }},   
                    @else
                        {{-- do nothing --}}
                    @endif
                @endforeach
            </td>
            <td class="whitespace-nowrap px-6 py-4 flex justify-center">
                <form method="post" action="{{route('interview.make.active')}}" id="groupForm">
                    @csrf
                    <input name="interviewId" type="number" value="{{ $interview->interview_id }}" hidden>
                    <button class="hover:bg-gray-500 hover:text-white font-semibold py-1 px-4 rounded-xl">
                        Add Group
                    </button>
                    <input name="group" type="number" placeholder="Group Number"/>
                </form>
                <button class="removeGroupBtn hover:bg-gray-500 hover:text-white font-semibold py-1 px-4 rounded-xl">
                    Remove Group
                </button>
                <form method="post" action="{{ route('interview.update.page') }}">
                    @csrf
                    <input name="interviewId" type="number" value="{{ $interview->interview_id }}" hidden>
                    <button class="hover:bg-blue-500 hover:text-white font-semibold py-1 px-4 rounded-xl" type="submit">Edit</button>
                </form>
                <form method="post" action="{{route('interview.delete');}}">
                    @csrf
                    <input name="interviewId" type="number" value="{{ $interview->interview_id }}" hidden>
                    <button class="hover:bg-red-500 hover:text-white font-semibold py-1 px-4 rounded-xl" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all elements with the class "removeGroupBtn"
        var removeGroupBtns = document.querySelectorAll(".removeGroupBtn");

        // Add a click event listener to each "Remove Group" button
        removeGroupBtns.forEach(function(button) {
            button.addEventListener("click", function() {
                // Find the closest form within the same table row
                var form = this.closest("tr").querySelector("form");

                // Update the form action to the desired route
                form.action = "{{ route('interview.make.deactive') }}";

                // Submit the form
                form.submit();
            });
        });
    });
</script>