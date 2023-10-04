<!-- resources/views/child.blade.php -->
@extends('employees.layout')
 
@section('title', 'Interviews')
 
@section('sidebar')
    @parent
@endsection

@section('addInterview')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('interview.view')" :addHref="route('employee.interview.add.page')" :item="'Interview'"/>

        <form id="addInterviewForm">
            <label>Number Of Interviews To Add</label>
            <input class="border mx-2" type="number" name="numberOf" id="numberOf" placeholder="1"/>
            <button type="button" onclick="addInterviewInputs()">Add</button>
        </form>

        <div class="w-full">
            <form action="{{ route('interview.create') }}" method="post" class="mt-2">
                @csrf
                <div id="interviewInputsContainer">
                    <!-- Inputs will be dynamically added here -->
                </div>
                <div class="mt-2">
                    <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-200 rounded" type="submit">
                        Submit
                    </button>
                </div>   
            </form>
        </div>
    </div>

    <script>
        // Initialize numberOfInterviews to 1
        var numberOfInterviews = 1;
    
        // Function to add interview inputs
        function addInterviewInputs() {
            // Get the number of interviews to add from the input
            var input = document.getElementById('numberOf');
            var value = parseInt(input.value);
    
            // Update numberOfInterviews if a valid value is provided, or keep it as 1
            if (!isNaN(value) && value >= 1) {
                numberOfInterviews = value;
            }
    
            // Get the container where interview inputs will be added
            var interviewInputsContainer = document.getElementById('interviewInputsContainer');
    
            // Clear the container
            interviewInputsContainer.innerHTML = '';
    
            // Add input fields dynamically based on numberOfInterviews
            for (var i = 0; i < numberOfInterviews; i++) {
                var div = document.createElement('div');
                div.innerHTML = `
                    <div class="flex">
                        <div class="mr-2">
                            <label class="block">Interview Name</label>
                            <input class="border p-2 mt-1" name="interviewName[]" type="text" placeholder="Interview Name">    
                        </div>
                        <div class="mr-2">
                            <label class="block">Question</label>
                            <input class="border p-2 mt-1" name="question[]" type="text" placeholder="Question">    
                        </div>
                    </div>
                `;
                interviewInputsContainer.appendChild(div);
            }
        }
    
        // Call addInterviewInputs to initialize the form
        addInterviewInputs();
    </script>
@endsection

