<!-- table.blade.php -->
<table class="min-w-full text-left text-sm font-light">
    <thead class="bg-white font-medium">
        <tr>
            <th scope="col" class="px-6 py-4 font-bold text-gray-600">Group</th>
            <th scope="col" class="px-6 py-4 text-center font-bold text-gray-600">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
        <tr class="{{ $loop->even ? 'bg-neutral-100 dark:border-neutral-500' : 'bg-white' }}">
            <td class="whitespace-nowrap px-6 py-4">{{ $group }}</td>
            <td class="whitespace-nowrap px-6 py-4 flex justify-center">
                <form>
                    <button class="hover:bg-blue-500 hover:text-white font-semibold py-1 px-4 rounded-xl">View</button>
                </form>
                <form>
                    <button class="hover:bg-red-500 hover:text-white font-semibold py-1 px-4 rounded-xl">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
