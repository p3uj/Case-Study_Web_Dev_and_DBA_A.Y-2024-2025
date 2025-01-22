<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Review Page</title>

    {{-- Link css and javascript file --}}
    @vite('resources/css/customizedColor.css')
    @vite('resources/css/navbar.css')
    @vite('resources/css/review.css')
</head>
<body>
    <x-navbar></x-navbar>

    <div class="review-container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="reviewTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="to-review-tab" data-bs-toggle="tab" href="#to-review" role="tab" aria-controls="to-review" aria-selected="true">To Review</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="my-reviews-tab" data-bs-toggle="tab" href="#my-reviews" role="tab" aria-controls="my-reviews" aria-selected="false">My Reviews</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content mt-4" id="reviewTabsContent">
            <div class="tab-pane fade show active" id="to-review" role="tabpanel" aria-labelledby="to-review-tab">
                <!-- Card List -->
                <div class="card">
                    <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" class="card-img-top" alt="Property">
                    <div class="card-body">
                        <h5 class="card-title">Quezon City, Commonwealth</h5>
                        <p class="card-text">Studio Unit</p>
                        <p class="price">₱7,000 / month</p>
                        <p class="card-text text-muted">Direct tenants are preferred but open for agents.<br>PRC Accreditation No.: 24716<br>PRC Registration No.: 0016054</p>
                        <button class="review-btn">Review</button>
                    </div>
                </div>

                <div class="card">
                    <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="Property">
                    <div class="card-body">
                        <h5 class="card-title">Quezon City, Commonwealth</h5>
                        <p class="card-text">Studio Unit</p>
                        <p class="price">₱7,000 / month</p>
                        <p class="card-text text-muted">Direct tenants are preferred but open for agents.<br>PRC Accreditation No.: 24716<br>PRC Registration No.: 0016054</p>
                        <button class="review-btn">Review</button>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="my-reviews" role="tabpanel" aria-labelledby="my-reviews-tab">
                <p>No reviews yet.</p>
                <p>You have not written any reviews so far.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
