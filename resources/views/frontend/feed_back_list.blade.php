@extends('frontend.master')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white">
            Anonymous Feedback Board
        </h1>

        <p class="text-gray-500 dark:text-gray-400 mt-2">
            Public feedback and suggestions from users.
        </p>
    </div>

    <!-- Feedback List -->
    <div class="space-y-5">

        @forelse ($feedbacks as $item)

            <div
                class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">

                <!-- Top -->
                <div class="flex justify-between items-center mb-4">

                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-sky-100 text-sky-700 text-sm font-bold">

                        {{ $item->feedback_type }}

                    </div>

                    <div class="text-sm text-gray-400">
                        Anonymous User
                    </div>

                </div>

                <!-- Message -->
                <div class="text-gray-700 dark:text-gray-200 leading-relaxed text-[15px]">

                    {{ $item->message }}

                </div>

                <!-- Footer -->
                <div class="mt-5 flex justify-between items-center">

                    <div class="text-xs text-gray-400">
                        {{ $item->created_at->diffForHumans() }}
                    </div>

                </div>

            </div>

        @empty

            <div
                class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-dashed border-gray-300 p-10 text-center">

                <div class="text-5xl mb-4">📭</div>

                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">
                    No Feedback Yet
                </h2>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    No anonymous feedback has been submitted.
                </p>

            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $feedbacks->links() }}
    </div>

</div>

@endsection
