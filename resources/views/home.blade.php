<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/home.css') }}">
    <!-- Add Font Awesome for the arrows -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    {{-- Used the component of navbar --}}
    <x-navbar></x-navbar>

    <div class="container">
        <div class="text-section">
            <h1>RentEase</h1>
            <p>Hassle-free and easy way to find a new home! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Habitant cras morbi hendrerit nunc vel sapien. In habitasse at diam suspendisse non vitae fermentum, pharetra arcu.</p>
            <a href="#">Find now</a>
        </div>
        <div class="image-section">
            <!-- Adding the images from the specified paths -->
            <img src="{{ Vite::asset('resources/images/home/circleOne.jpg') }}" alt="Circle One" class="circleOne-image">
            <img src="{{ Vite::asset('resources/images/home/circleTwo.jpg') }}" alt="Circle Two" class="circleTwo-image">
        </div>
    </div>

<!-- Featured Properties Section -->
<div class="featured-properties">
    <h2 class="section-title">Featured Properties</h2>
    <div class="property-grid">
        <img src="{{ Vite::asset('resources/images/home/fp1.jpg') }}" alt="Property 1" class="property-image">
        <img src="{{ Vite::asset('resources/images/home/fp2.jpg') }}" alt="Property 2" class="property-image">
        <img src="{{ Vite::asset('resources/images/home/fp3.jpg') }}" alt="Property 3" class="property-image">
        <img src="{{ Vite::asset('resources/images/home/fp4.jpg') }}" alt="Property 4" class="property-image">
        <img src="{{ Vite::asset('resources/images/home/fp5.jpg') }}" alt="Property 5" class="property-image">
        <img src="{{ Vite::asset('resources/images/home/fp6.jpg') }}" alt="Property 6" class="property-image"> <!-- New image fp6 added -->
    </div>
</div>

<!-- Properties Section -->
<div class="properties">
    <h2>Properties</h2>
    <div class="arrows-container">
        <button class="arrow left-arrow"><i class="fas fa-chevron-left"></i></button>
        <div class="properties-grid">
            <div class="property-card">
                <div class="image-holder">
                    <img src="{{ Vite::asset('resources/images/home/p1.jpg') }}" alt="Apartment">
                </div>
                <h3>SkyRise Apartment</h3>
                <div class="category">Category: Apartment</div>
                <div class="location">Location: Metro Manila, Philippines</div>
                <div class="price">₱15,000/month</div>
                <div class="ratings">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i> <!-- Empty star -->
                </div>
                <a href="#">View Details</a>
            </div>
            <div class="property-card">
                <div class="image-holder">
                    <img src="{{ Vite::asset('resources/images/home/p2.jpg') }}" alt="Boarding House">
                </div>
                <h3>BoardBase Boarding House</h3>
                <div class="category">Category: Boarding House</div>
                <div class="location">Location: Quezon City, Philippines</div>
                <div class="price">₱20,000/month</div>
                <div class="ratings">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i> <!-- Empty star -->
                    <i class="far fa-star"></i> <!-- Empty star -->
                </div>
                <a href="#">View Details</a>
            </div>
            <div class="property-card">
                <div class="image-holder">
                    <img src="{{ Vite::asset('resources/images/home/p3.jpg') }}" alt="Studio Unit">
                </div>
                <h3>APT Studio Unit</h3>
                <div class="category">Category: Studio Unit</div>
                <div class="location">Location: Cebu, Philippines</div>
                <div class="price">₱30,000/month</div>
                <div class="ratings">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> <!-- Full stars -->
                </div>
                <a href="#">View Details</a>
            </div>
            <div class="property-card">
                <div class="image-holder">
                    <img src="{{ Vite::asset('resources/images/home/p4.jpg') }}" alt="Dorm">
                </div>
                <h3>Dormix Dormitories</h3>
                <div class="category">Category: Dormitory</div>
                <div class="location">Location: Manila, Philippines</div>
                <div class="price">₱12,000/month</div>
                <div class="ratings">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i> <!-- Empty star -->
                </div>
                <a href="#">View Details</a>
            </div>
        </div>
        <button class="arrow right-arrow"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<!-- Top Rated Properties Section -->
    <div class="top-rated-properties">
    <h2>Top Rated Properties</h2>
    <div class="top-rated-grid">
        <div class="ranked-property">
            <div class="rank">1</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Luxury Apartment</h3>
                <p>Downtown location, spacious</p>
            </div>
        </div>
        <div class="ranked-property">
            <div class="rank">2</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Suburban House</h3>
                <p>Quiet neighborhood, large yard</p>
            </div>
        </div>
        <div class="ranked-property">
            <div class="rank">3</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Beachfront Condo</h3>
                <p>Ocean view, modern amenities</p>
            </div>
        </div>
        <div class="ranked-property">
            <div class="rank">4</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Urban Loft</h3>
                <p>City center, trendy design</p>
            </div>
        </div>
        <div class="ranked-property">
            <div class="rank">5</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Mountain Retreat</h3>
                <p>Scenic views, peaceful setting</p>
            </div>
        </div>
        <div class="ranked-property">
            <div class="rank">6</div>
            <div class="image-placeholder"></div>
            <div class="info">
                <h3>Riverside Townhouse</h3>
                <p>Waterfront location, modern design</p>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<!-- About Us Section -->
<div class="about-us">
    <h2>About Us</h2>
    <div class="about-us-content">
        <!-- First Column for Text -->
        <div class="about-us-text">
            <p>At RentEase, we strive to provide a hassle-free and seamless experience for those looking to find their perfect home. Our platform offers a wide selection of properties, from apartments to boarding houses, with detailed information to help you make an informed decision. We are committed to making the property rental process as easy and convenient as possible for both renters and property owners.</p>
            <p>With RentEase, you can browse listings, view property details, and contact landlords or agents directly. Our goal is to make renting a property as stress-free as possible for everyone involved.</p>
        </div>
        
        <!-- Second Column for Video -->
        <div class="about-us-video">
            <video width="100%" controls>
                <source src="{{ Vite::asset('resources/images/home/RentEaseVideo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div>

<!-- Contact Us Section -->
<div class="contact-us">
    <div class="contact-details">
        <h2>Contact Us</h2>
        <p>We’d love to hear from you! Reach out to us through any of the following channels:</p>
        
        <div class="cards-grid">
            <!-- Address Card -->
            <div class="card">
                <h3>Address</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> RentEase, P445+257, Graceful, Quezon City, Metro Manila</li>
                </ul>
            </div>

            <!-- Email Card -->
            <div class="card">
                <h3>Email</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> hello@rentease.com</li>
                    <li><i class="fas fa-envelope"></i> support@rentease.com</li>
                </ul>
            </div>

            <!-- Call Us Card -->
            <div class="card">
                <h3>Call Us</h3>
                <ul>
                    <li><i class="fas fa-phone"></i> +63 912 345 6789</li>
                    <li><i class="fas fa-phone"></i> +63 912 987 6543</li>
                </ul>
            </div>

            <!-- Follow Us Card -->
            <div class="card">
                <h3>Follow Us</h3>
                <p>Follow us on social media:</p>
                <ul class="social-media">
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-discord"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="location">
        <h2>Our Location</h2>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.80204930130863!2d121.10551580000001!3d14.7052863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397bb000379d1e1%3A0x2d3d34d77fe10053!2sRentEase!5e0!3m2!1sen!2sph!4v1695801322305!5m2!1sen!2sph"
                width="100%"
                height="200"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<!-- Footer Section -->
{{-- Footer --}}
    <x-footer />
</body>
</html>
