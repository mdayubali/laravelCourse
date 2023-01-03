<x-guest-layout>
    <div class="bg-gray mt-1 py-6">
        <div class="container">
            <h2 class="text-center text-2xl font-semibold py-4">{{ $title }}</h2>
            <div class="container">
                <div class="max-w-7xl w-full inline-flex single-feature gap-10 flex-wrap mx-auto">
                @foreach ($courses as $course)
                    @include('components.course-box',['course'=>$course])
                 @endforeach
                </div>
            </div>
            {{ $courses->links() }}
        </div>
    </div>
</x-guest-layout>
