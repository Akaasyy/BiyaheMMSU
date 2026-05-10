<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50 py-12 px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900">Driver Registration</h2>
            <p class="text-center text-sm text-gray-600">Join the BiyaheMMSU tracking team</p>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <input name="name" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 z-10 sm:text-sm" placeholder="Full Name">
                    
                    <input name="age" type="number" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 z-10 sm:text-sm" placeholder="Age">
                    
                    <input name="license_no" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 z-10 sm:text-sm" placeholder="Driver's License Number">
                    
                    <input name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 z-10 sm:text-sm" placeholder="Gmail Address">
                    
                    <input name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 z-10 sm:text-sm" placeholder="Password">
                </div>

                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Register and Await Approval
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>