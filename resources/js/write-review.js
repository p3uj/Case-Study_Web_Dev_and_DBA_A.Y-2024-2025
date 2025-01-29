document.addEventListener("DOMContentLoaded", function () {
    const reviewButtons = document.querySelectorAll(".review-btn");
    const modal = document.getElementById("write-review-modal");
    const modalImage = modal.querySelector(".image img");
    const durationText = modal.querySelector(".duration");
    const titleText = modal.querySelector(".title");
    const infoText = modal.querySelector(".info");
    const form = document.getElementById("review-form"); // Assuming you have a form element

    reviewButtons.forEach(button => {
        button.addEventListener("click", function () {
            const reviewId = this.getAttribute("data-id");
            const photo = this.getAttribute("data-photo");
            const duration = this.getAttribute("data-duration");
            const location = this.getAttribute("data-location");
            const info = this.getAttribute("data-info");
            const role = this.getAttribute("data-role");
            const editStatus = this.getAttribute("data-edit-status"); // New: get edit status
            const isReviewed = this.getAttribute("data-is-reviewed"); // Check if review is already made

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

            // If review has already been made, set isEdited to 1
            if (isReviewed == "1") {
                document.getElementById("is-edited").value = 1; // Set isEdited to 1 if review is made
            } else {
                document.getElementById("is-edited").value = 0; // Set isEdited to 0 if it's a new review
            }

            // Check if we are editing an existing review
            if (editStatus == "1") {
                const reviewText = this.getAttribute("data-desc"); // Get existing review text
                const rating = this.getAttribute("data-rating"); // Get existing rating

                // Pre-fill the modal with the existing review text and rating
                document.getElementById("review-text").value = reviewText;
                document.querySelector(`input[name="rating"][value="${rating}"]`).checked = true;
            } else {
                // For new review, ensure review text is empty and rating is unselected
                document.getElementById("review-text").value = '';
                document.querySelector('input[name="rating"]:checked').checked = false;
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

        // Check if review text is empty or rating is not selected
        if (!reviewText.trim() || !rating) {
            event.preventDefault(); // Prevent form submission
            alert("Please provide both a review description and a rating before submitting.");
            return false;
        }

        // Ask for confirmation before submitting
        const confirmation = confirm("Are you sure you want to submit this review?");
        if (!confirmation) {
            event.preventDefault(); // Prevent form submission if user cancels
        }
    });
});
