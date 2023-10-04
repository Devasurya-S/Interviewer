<div class="flex items-center justify-center h-screen">
    <div class="border border-gray-200 rounded shadow-lg sm:w-auto md:w-2/6 p-2 bg-white">
        <h2 class="text-3xl font-bold text-center">Sign Up</h2>
        <form action="{{ route('employee.signup'); }}" method="POST" class="flex flex-col p-4 pb-1 gap-4">
            @csrf

            <input class="text-lg border-b-2 md:w-full mb-2 block" type="text" name="name" placeholder="Name" value="{{ old('name') }}"/>
            @error('name')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            <input class="text-lg border-b-2 md:w-full mb-2 block" type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
            @error('email')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            <input class="text-lg border-b-2 md:w-full mb-2 block" type="password" name="password" placeholder="Password"/>
            @error('password')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            <input class="text-lg border-b-2 md:w-full mb-2 block" type="password" name="password_confirmation" placeholder="Confirm Password"/>
            @error('password_confirmation')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            <input class="text-lg border-b-2 md:w-full mb-2 block" type="number" name="mobile" placeholder="Mobile no." value="{{ old('mobile') }}"/>
            @error('mobile')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            <div class="mb-2">
                <input class="" type="checkbox" name="remember" id="remember-me" />
                <label class="text-md mr-7" for="remember-me">Remember me</label>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg">Sign Up</button>
        </form>
    </div>
</div>
