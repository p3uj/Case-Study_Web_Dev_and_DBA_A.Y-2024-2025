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

    <!-- Font Awesome Icon Library -->
    <script src="https://kit.fontawesome.com/87abdb3ce2.js" crossorigin="anonymous"></script>
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
        <div class="tab-content" id="reviewTabsContent">
            <!-- 'To Review' Tab -->
            <div class="tab-pane fade show active" id="to-review" role="tabpanel" aria-labelledby="to-review-tab" style="width: 100%;">
                <!-- Card List -->               
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ Vite::asset('resources/images/sampleProfile.png') }}" class="card-img" alt="Card Image">
                        </div>
                        
                        <div class="card-body col-md-3">
                            <h5 class="fw-bold">Quezon City, Commonwealth</h5>
                            <div class="d-flex">
                                <p class="card-info">Studio Unit</p>
                                <p class="card-info" style="background-color: rgb(208, 76, 76)">₱7,000/month</p>
                            </div>
                            <p class="card-desc">Direct Tenants are preferred but open for Agents.</p>
                            <div class="reviews">
                                <h3>
                                    <i class="fas fa-star" data-rating="1"></i>
                                    <i class="fas fa-star" data-rating="2"></i>
                                    <i class="fas fa-star" data-rating="3"></i>
                                    <i class="fas fa-star" data-rating="4"></i>
                                    <i class="fas fa-star" data-rating="5"></i>
                                </h3>
                            <p>4 out of 5</p>    
                            </div>
                        </div>

                        <div class="card-button-col col-md-1">
                            <button class="card-button">Review</button>
                        </div>
                    </div>
                </div>

            <div>
                <p>No property to review.</p>
                <p>There is no property to review now.</p>
            </div> 
            <!-- 'My Reviews' Tab -->
            <div class="tab-pane fade" id="my-reviews" role="tabpanel" aria-labelledby="my-reviews-tab" style="width: 100%;">
                <div>
                    <p>No reviews yet.</p>
                    <p>You have not written any reviews yet.</p>
                </div>    
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
