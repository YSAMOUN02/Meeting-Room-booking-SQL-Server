@extends('frontend.master')

@section('content')

<div class="min-h-[75vh] flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-3xl">

        <div
            class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-6 py-6 text-white">

                <h1 class="text-3xl font-extrabold">
                    Anonymous Feedback
                </h1>

                <p class="mt-2 text-sm text-sky-100">
                    Report booking issues, room problems, or suggestions anonymously.
                </p>


            </div>

            <!-- Guide -->
            <div class="px-6 py-5 bg-sky-50 dark:bg-gray-900 border-b border-sky-100 dark:border-gray-700">

                <h2 class="font-semibold text-gray-800 dark:text-white mb-2">
                    Recommendation Before Submitting
                </h2>

                <ul class="list-disc list-inside text-sm text-gray-600 dark:text-gray-300 space-y-1">
                    <li>Describe the issue clearly and respectfully.</li>
                    <li>Do not include private or sensitive information.</li>
                    <li>Your identity will not be shown publicly.</li>
                </ul>

            </div>

            <!-- Form -->
            <form action="/feedback/submit" method="POST" class="p-6 space-y-5">
                @csrf


                <div>
                    <label
                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Feedback Type
                    </label>

                    <select name="feedback_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        <option value="Booking Issue">Booking Issue</option>
                        <option value="Room Problem">Room Problem</option>
                        <option value="System Bug">System Bug</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Other">Other</option>

                    </select>
                </div>

                <div>
                    <label
                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Feedback Details
                    </label>

                    <textarea name="message" rows="7"
                        placeholder="Describe your issue or suggestion..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-sky-500 focus:border-sky-500 block w-full p-4 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required></textarea>
                </div>

                <!-- Anonymous Notice -->
                <div
                    class="rounded-2xl bg-yellow-50 border border-yellow-200 p-4 text-sm text-yellow-800 dark:bg-yellow-500/10 dark:border-yellow-500/30 dark:text-yellow-200">

                    Your feedback will be displayed publicly as
                    <span class="font-bold">Anonymous User</span>.
                    Your name and identity will not be shown.

                </div>

                <!-- Submit -->
                <div class="flex justify-end">

                    <button type="submit"
                        class="px-6 py-3 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-semibold shadow-lg shadow-sky-200 transition-all duration-200">

                        Submit Feedback

                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection
