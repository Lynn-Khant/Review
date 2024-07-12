@props(['blog'])
<section class="container">
        <div class="col-md-8 mx-auto">
            @auth
            <div class="card p-3 my-3">
            <form
                    action="/blogs/{{$blog->slug}}/comments"
                    method="POST"
                >
                    @csrf
                    <div class="mb-3">
                        <textarea
                            name="body"
                            cols="10"
                            class="form-control border border-0"
                            rows="5"
                            placeholder="say something..."
                        ></textarea>
                        <x-error name="body"/>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >Submit</button>
                    </div>
                </form>
            </div>
                
            
            @else
            <p class="text-center">please <a href="/login">login</a> to participate in this discussion.</p>
            @endauth
        </div>
    </section>