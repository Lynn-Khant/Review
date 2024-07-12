@props(['categories'])
<x-admin-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="text-primary text-center my-2">Create Blog</h3>
                <div class="card p-4 my-3 shadow-sm">
                    <form
                    method="POST"
                    action="/admin/blogs/store"
                    enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label
                                for="name"
                                class="form-label"
                            >Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                value="{{old("title")}}"
                            >
                            @error("title")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label
                                for="slug"
                                class="form-label"
                            >Slug</label>
                            <input
                                type="text"
                                class="form-control"
                                id="slug"
                                name="slug"
                                value="{{old("slug")}}"
                            >
                            @error("slug")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label
                                for="intro"
                                class="form-label"
                            >Intro</label>
                            <input
                                type="text"
                                class="form-control"
                                id="intro"
                                name="intro"
                                value="{{old("intro")}}"
                            >
                            @error("intro")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label
                                for="body"
                                class="form-label"
                            >Blog Body</label>
                            <textarea
                                
                                class="form-control"
                                id="body"
                                name="body"
                            ></textarea>
                            @error("body")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label
                                for="thumbnail"
                                class="form-label"
                            >Thumbnail Photo</label>
                            <input
                                type="file"
                                class="form-control"
                                id="thumbnail"
                                name="thumbnail"
                                value="{{old("thumbnail")}}"
                            >
                            @error("thumbnail")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label
                                for="category_id"
                                class="form-label"
                            >Category</label>
                            <select 
                            class="form-control"
                            name="category_id"
                            id="category_id">
                                @foreach($categories as $category)
                                <option {{$category->id===old("category_id")?"selected":""}} value={{$category->id}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error("intro")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>