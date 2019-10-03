<div class="mNews">
    <div class="container">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-xs-12 col-md-6 col-lg-4">
                    @include('frontend.pages.blog.parts.preview')
                </div>
            @endforeach
        </div>
    </div>
</div>