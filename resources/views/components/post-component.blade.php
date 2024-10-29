<div class="mt-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between">
                    <div>
                        <span class="text-gray-500 me-3">Author</span>
                        <span class="text-blue-600">{{ $post->user->name }}</span>{{-- O $post está sendo injetado via component no blade --}}
                    </div>
                    <div>
                        <span class="text-gray-500 me-3">Created at</span>
                        <span>{{ $post->created_at }}</span>
                    </div>
                </div>

                <div class="mt-3 ps-5">
                    <h1 class="text-xl font-bold">{{ $post->title }}</h1>
                    <p class="mt-3">{{ $post->content }}</p>
                </div>

                <div class="mt-3 ps-5 text-end">
                    {{-- post delete --}}
                    @can('post.delete', $post) {{-- Passando o post como parametro para o Gate --}}
                        <a href="#" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">Delete</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
