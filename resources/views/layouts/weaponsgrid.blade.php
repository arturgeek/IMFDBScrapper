<div class="weapons-grid">
    @foreach ( $weapons as $weapon)
    <div class="weapon">
        <div class="image-container">
            <img src="{{$weapon["image_url"]}}" />
        </div>
        <span>
            {{ $weapon["name"] }}
        </span>
        @if ( $addToFavoriteButton )
            <form method="POST" action="save-to-favorites">
                @csrf
                <input type="hidden" name="movie" value="{{ $movieCleanName }}" />
                <input type="hidden" name="movie_slug" value="{{ $movieSlug }}" />
                <input type="hidden" name="category" value="{{ $category }}" />
                <input type="hidden" name="weapon" value="{{ $weapon["name"] }}" />
                <input type="hidden" name="image_url" value="{{ $weapon["image_url"] }}" />
                <button type="submit" class="btn btn-dark">Add to favorites</button>
            </form>
        @endif
    </div>
    @endforeach
</div>
