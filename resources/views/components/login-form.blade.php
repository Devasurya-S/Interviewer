<div class="flex items-center justify-center h-screen">
    <div class="border border-gray-200 rounded shadow-lg w-auto p-2 bg-white">
        <h2 class="text-3xl font-bold text-center">Log In</h2>
        <form action="{{ route('employee.do.login') }}" method="POST" class="flex flex-col p-4 pb-1 gap-4">
            @csrf
            <input class="text-lg border-b-2 md:w-full mb-2 block" type="text" name="email" placeholder="Email"/>
            <input class="text-lg border-b-2 md:w-full mb-2 block" type="password" name="password" placeholder="Password"/>
            <div class="mb-2">
                <input class="" type="checkbox" name="remember" id="remember-me" />           
                <label class="text-md mr-7" for="remember-me">Remember me</label>
                <a href="#" class="text-md mb-2 text-blue-500 hover:underline hover:text-red-500 active:text-yellow-500 float-right">Forgot Password?</a>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg">Log In</button>
        </form>
        <p class="text-center block">OR</p>
        <a href="{{ route('signup') }}" class="mb-2 text-center block text-lg text-blue-500 hover:underline hover:text-red-500 active:text-yellow-500">Create an account</a>
    </div>
</div>
