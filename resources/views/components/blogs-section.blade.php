@props(['blogs','categories','currentCategory'])
<section
    class="container text-center"
    id="blogs"
>
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <div class="">
        <div class="dropdown">
            <button
                class="btn btn-outline-primary dropdown-toggle"
                type="button"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
               {{request("categories")? request("categories"):"Filter By Category"}}
            </button>
            <ul
                class="dropdown-menu"
                aria-labelledby="dropdownMenuButton1"
            >
                @foreach($categories as $category)
                    <li><a
                        class="dropdown-item"
                        href="/?categories={{$category->slug}}{{request("username")?"&username=".request("username"):""}}{{request("categories")?"&categories=".request("categories"):""}}"
                    >{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <form
        action=""
        method="GET"
        class="my-3"
    >   
        @if(request("username"))
        <input name="username" type="hidden" value="{{request("username")}}">
        @endif
        @if(request("categories"))
        <input name="categories" type="hidden" value="{{request("categories")}}">
        @endif
        <div class="input-group mb-3">
            <input
                type="text"
                autocomplete="false"
                class="form-control"
                placeholder="Search Blogs..."
                name="search"
                value="{{request("search")}}"
            />
            <button
                class="input-group-text bg-primary text-light"
                id="basic-addon2"
                type="submit"
            >
                Search
            </button>
        </div>
    </form>
    <div class="row">
        @if($blogs->count())
        @foreach ($blogs as $blog)
        <div class="col-md-4 mb-4">
            <x-blog-card :blog="$blog" />
        </div>
        @endforeach
        @else
        <p>No Blogs Found</p>
        @endif
        {{$blogs->links()}}
    </div>
</section>