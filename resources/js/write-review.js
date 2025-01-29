document.addEventListener("DOMContentLoaded", function () {
    const reviewButtons = document.querySelectorAll(".review-btn");
    const modal = document.getElementById("write-review-modal");
    const modalImage = modal.querySelector(".image img");
    const durationText = modal.querySelector(".duration");
    const titleText = modal.querySelector(".title");
    const infoText = modal.querySelector(".info");
    const reviewTextArea = document.getElementById("review-text");
    const ratingInputs = document.querySelectorAll('input[name="rating"]'); // Rating radio buttons
    const form = document.getElementById("form"); // Assuming you have a form element

    reviewButtons.forEach(button => {
        button.addEventListener("click", function () {
            const reviewId = this.getAttribute("data-id");
            const photo = this.getAttribute("data-photo");
            const duration = this.getAttribute("data-duration");
            const location = this.getAttribute("data-location");
            const info = this.getAttribute("data-info");
            const role = this.getAttribute("data-role");
            const isReviewed = this.getAttribute("data-review-status"); // Get review status (1 or 0)
            const reviewText = this.getAttribute("data-desc"); // Existing review text
            const rating = this.getAttribute("data-rating"); // Existing rating

            // Set the hidden review ID input field value
            document.getElementById("review-id").value = reviewId;

            // Set correct image path based on role
            if (role === "Tenant") {
                modalImage.src = `/RentEase/public/storage/uploads/images/property-posts/${photo}`;
            } else {
                modalImage.src = `/RentEase/public/storage/uploads/images/profile-pictures/${photo}`;             
            }

            // Update text fields
            durationText.textContent = duration;
            titleText.textContent = location;
            infoText.textContent = info;

            // Set the 'is-edited' hidden field based on review status
            if (isReviewed === "1") {
                document.getElementById("is-edited").value = 1;

                // Pre-fill the review text area and rating radio buttons if a review exists
                reviewTextArea.value = reviewText;

                // Set the correct rating radio button based on existing rating
                ratingInputs.forEach(ratingInput => {
                    if (ratingInput.value === rating) {
                        ratingInput.checked = true;
                    }
                });
            } else {
                document.getElementById("is-edited").value = 0; // Set is-edited to 0 if it's a new review
                reviewTextArea.value = ''; // Clear review text area for new review
                ratingInputs.forEach(ratingInput => {
                    ratingInput.checked = false; // Uncheck all rating radio buttons
                });
            }

            // Show the modal
            modal.style.display = "block";
        });
    });

    function closeModal() {
        modal.style.display = "none";
    }

    // Close the modal if the user clicks the close button (x)
    const closeButton = modal.querySelector(".close-btn");
    closeButton.addEventListener("click", closeModal);

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        if (event.target === modal) {
            closeModal();
        }
    };

    // Validate form before submitting
    form.addEventListener("submit", function(event) {
        const reviewText = document.getElementById("review-text").value;
        const rating = document.querySelector('input[name="rating"]:checked');
        const isReviewed = document.getElementById("is-edited").value; // Get the value of the 'is-edited' hidden field

        // Check if review text is empty or rating is not selected
        if (!reviewText.trim() || !rating) {
            event.preventDefault(); // Prevent form submission
            alert("Please provide both a review description and a rating before submitting.");
            return false;
        }

        if (isReviewed === "1") {
            // Ask for confirmation before submitting
            const confirmation = confirm("You can only edit your review once. Are you sure you want to submit this review?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        } else {
            // Ask for confirmation before submitting
            const confirmation = confirm("Are you sure you want to submit this review?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        }
    });
});