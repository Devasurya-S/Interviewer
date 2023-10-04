<!-- header.blade.php -->
<div class="flex h-20 w-auto bg-white justify-between items-center">
    <h1 class="font-sans font-poppins text-4xl m-4">Logo</h1>
    <div class="text-sm font-poppins ml-auto mr-10">
        <p class="text text-base font-medium">{{ $user->name }}</p>
        <p>{{ $user->email }}</p>
    </div>
    @if ($flag == 1)
        <form method="POST" action="{{ route('user.do.logout') }}">
    @else
        <form method="POST" action="{{ route('employee.do.logout') }}">
    @endif
        @csrf
        <button class="text-white font-poppins text-sm bg-[#0560FD] hover:bg-blue-500 py-2 px-4 rounded-xl mr-4 mt-2 h-9 w-auto flex items-center">
            Logout
        </button>
    </form>
</div>
