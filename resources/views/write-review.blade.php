<div id="write-review-modal" class="modal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal()">✖</button>
        <h3>Write a Review</h3>

        <div class="image">
            <img src="" alt="Image">
        </div>

        <p class="duration"></p>
        <p class="title"></p>
        <p class="info"></p>

        <form id="form" action="{{ route('writereview') }}" method="POST">
            @csrf

            @method('PUT') <!-- PUT method for updating the review -->
            
            <!-- Hidden field to store the review ID -->
            <input type="hidden" name="review-id" id="review-id" value="">

            <textarea name="review-text" id="review-text" placeholder="Write your review here..."></textarea>

            <div class="star-rating">
                <input type="radio" name="rating" value="5" id="star5">
                <label for="star5">★</label>
                <input type="radio" name="rating" value="4" id="star4">
                <label for="star4">★</label>
                <input type="radio" name="rating" value="3" id="star3">
                <label for="star3">★</label>
                <input type="radio" name="rating" value="2" id="star2">
                <label for="star2">★</label>
                <input type="radio" name="rating" value="1" id="star1">
                <label for="star1">★</label>
            </div>

            <div class="submit-btn-container">
                <button type="submit" class="submit-btn" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
