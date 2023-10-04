<!-- resources/views/child.blade.php -->
@extends('employees.layout')
 
@section('title', 'Add Candidates')
 
@section('sidebar')
    @parent
@endsection

@section('addCandidate')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('candidate.groups')" :addHref="route('employee.candidate.add.page')" :item="'Candidate'"/>

        <form id="addCandidateForm">
            <label>Number of candidates</label>
            <input class="border mx-2" type="number" name="numberOf" id="numberOf" placeholder="1"/>
            <button type="button" onclick="addCandidateInputs()">Add</button>
        </form>

        <div class="w-full">
            <form action="{{ route('candidate.sign-up') }}" method="post" class="mt-2">
                <label class="block">Group Number</label>
                <input class="border p-2 mt-1" name="group" type="number" placeholder="eg:1"> 
                @csrf
                <div id="candidateInputsContainer">
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
        var numberOfCandidates = 1;
    
        // Function to add interview inputs
        function addCandidateInputs() {
            // Get the number of interviews to add from the input
            var input = document.getElementById('numberOf');
            var value = parseInt(input.value);
    
            // Update numberOfInterviews if a valid value is provided, or keep it as 1
            if (!isNaN(value) && value >= 1) {
                numberOfCandidates = value;
            }
    
            // Get the container where interview inputs will be added
            var interviewInputsContainer = document.getElementById('candidateInputsContainer');
    
            // Clear the container
            interviewInputsContainer.innerHTML = '';
    
            // Add input fields dynamically based on numberOfInterviews
            for (var i = 0; i < numberOfCandidates; i++) {
                var div = document.createElement('div');
                div.innerHTML = `
                    <div class="flex">
                        <div class="flex mt-2">
                            <div class="mr-2">
                                <label class="block">Name</label>
                                <input class="border p-2 mt-1" name="name[]" type="text" placeholder="Name">    
                            </div>
                            <div class="mr-2">
                                <label class="block">Email</label>
                                <input class="border p-2 mt-1" name="email[]" type="text" placeholder="Email">    
                            </div>
                            <div class="mr-2">
                                <label class="block">Mobile</label>
                                <input class="border p-2 mt-1" name="mobile[]" type="text" placeholder="Mobile">    
                            </div>  
                            <div class="mr-2">
                                <label class="block">Password</label>
                                <input class="border p-2 mt-1" name="password[]" type="text" placeholder="Password">    
                            </div>  
                            <div class="mr-2">
                                <label class="block">Status</label>
                                <select class="border p-2 mt-1" name="status[]">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                `;
                interviewInputsContainer.appendChild(div);
            }
        }
    
        // Call addInterviewInputs to initialize the form
        addCandidateInputs();
    </script>
@endsection