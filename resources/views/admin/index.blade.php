<x-admin-layout>
    <h3 class="text-center">Blogs</h3>
    
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">title</th>
                    <th scope="col">intro</th>
                    <th
                        scope="col"
                        colspan="2"
                    >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                <tr>
                    <td><a
                            href="/blogs/{{$blog->slug}}"
                            target="_blank"
                        >{{$blog->title}}</a></td>
                    <td>{{$blog->intro}}</td>
                    <td><a
                            href="/admin/blogs/{{$blog->slug}}/edit"
                            class="btn btn-warning"
                        >Edit</a></td>
                    <td>
                        <form 
                        method="POST"
                        action="/admin/blogs/{{$blog->slug}}/delete">
                        @csrf
                        @method("delete")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$blogs->links()}}
    
</x-admin-layout>