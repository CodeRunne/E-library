<x-dashboard-layout>
	<div class="mt-6 mx-6 pl-[13rem] pb-8 border-b border-gray-700">
        <div class="widgets flex gap-x-6">
            <div class="shadow bg-gray-700 w-2/5 py-6 rounded px-6">
                <h4 class="text-sm mb-2">Books Borrowed</h4>
                <span class="text-5xl">{{$issued->count()}}</span>
            </div>
            <div class="shadow bg-gray-700 w-2/5 py-6 rounded px-6">
                <h4 class="text-sm mb-2">Books Returned</h4>
                <span class="text-5xl">{{$returned->count()}}</span>
            </div>
        </div>
    </div>
    <div class="flex gap-x-6 py-12 justify-center items-center w-auto">
        <div class="w-[15rem] h-[15rem] flex justify-center items-center bg-gray-800 shadow text-4xl rounded-md">
        @php 
            $fullname = auth()->user()->fullname;
            $name = explode(' ', $fullname);
            $fullname = substr($name[0], 0, 1);
            $lastname = substr($name[1], 0, 1);
            $acry = strtoupper($fullname . $lastname);
            echo $acry;
        @endphp</div>
        <div class="w-[20rem]">
            <ul class="flex flex-col gap-y-6 divide-y divide-gray-500 px-2">
                <li class="pt-2">
                    <h3 class="mb-2 text-md text-gray-300">Fullname</h3>
                    <p class="bg-gray-800 text-gray-300 w-full px-2 py-2 rounded-md">{{ auth()->user()->fullname }}</p>
                </li>
                <li class="pt-2">
                    <h3 class="mb-2 text-md text-gray-300">Matric Number</h3>
                    <p class="bg-gray-800 text-gray-300 w-full px-2 py-2 rounded-md">{{ auth()->user()->matric_no }}</p>
                </li>
                <li class="pt-2">
                    <h3 class="mb-2 text-md text-gray-300">Department</h3>
                    <p class="bg-gray-800 text-gray-300 w-full px-2 py-2 rounded-md">{{ auth()->user()->department->name }}</p>
                </li>
                <li class="pt-2">
                    <h3 class="mb-2 text-md text-gray-300">Level</h3>
                    <p class="bg-gray-800 text-gray-300 w-full px-2 py-2 rounded-md">{{ auth()->user()->level->level }} Level</p>
                </li>
            </ul>
        </div>
    </div>
</x-dashboard-layout>