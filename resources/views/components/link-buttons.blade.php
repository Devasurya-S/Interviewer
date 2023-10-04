<!-- resources/views/components/link-buttons.blade.php -->

@props(['viewHref', 'addHref', 'item'])

<a href="{{ $viewHref }}" class="py-2 px-4 {{ url()->current() === $viewHref ? 'hidden' : 'text-black hover:bg-[#0560FD] hover:text-white' }} text-center w-40 rounded-xl">View {{ $item }}s</a>
<a href="{{ $addHref }}" class="py-2 px-4 {{ url()->current() === $addHref ? 'hidden' : 'text-black hover:bg-[#0560FD] hover:text-white' }} text-center w-40 rounded-xl">Add {{ $item }}</a>
