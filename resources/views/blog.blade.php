<x-layout>
    <!-- single blog section -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <img
                    src="/storage/{{$blog->thumbnail}}"
                    class="card-img-top"
                    alt="..."
                />
                <h3 class="my-3">{{$blog->title}}</h3>
                <div>
                    <div>Author - {{$blog->author->name}}</div>
                    <div class="badge bg-primary">{{$blog->category->name}}</div>
                    <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
                    <form action="/blogs/{{$blog->slug}}/subscription" method="POST">
                        @csrf
                        @auth
                        @if(auth()->user()->isSubscribed($blog))
                        <button class="btn btn-danger">unsubscribe</button>
                        @else
                        <button class="btn btn-warning">subscribe</button>
                        @endif
                        @endauth
                    </form>
                </div>
                <p class="lh-md mt-3">
                    {{$blog->body}}
                </p>
            </div>
        </div>
    </div>
    
    <x-comment-form :blog="$blog"/>
    <x-comments :comments="$blog->comments()->latest()->paginate(3)"/>
    <x-blogs-you-may-like-section :randomBlogs="$randomBlogs" />
</x-layout>

    
