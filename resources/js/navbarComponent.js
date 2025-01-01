class NavbarComponent extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <div class="navbar">
                <img src="../img/RentEaseLogo.png" alt="Rent Ease Logo" class="rentease-logo">
                <form >
                    <input type="text" class="searchbar" placeholder="Search a user...">
                    <button type="submit">Search</button>
                </form>
                <a href="home.html" id="home-link">Home</a>
                <a href="properties.html" id="properties-link">Properties</a>
                <a href="find-roommate-or-tenant.html" id="roommate-link">Find Roommate/Tenant</a>
                <a href="post-a-property.html" id="post-property-link">Post a Property</a>
                <a href="review.html" id="review-link">Review</a>
                <button class="logout-btn" type="submit">Logout</button>
                <a href="user-profile.html" class="profile-link">
                    <img src="../img/sampleProfile.png" class="sample-profile" alt="Sample Profile">
                </a>
            </div>
        `;
        this.setActiveLink();
    }

    setActiveLink() {
        // Get all anchor tags
        const links = this.querySelectorAll('a');

        // Get the current page URL
        const currentPage = window.location.pathname.split('/').pop();

        // Loop through each link and check if the href matches the current page
        links.forEach(link => {
            const linkPage = link.getAttribute('href').split('/').pop();
            if (linkPage === currentPage) {
                link.classList.add('active'); // Add active class to the current link
            } else {
                link.classList.remove('active'); // Remove active class from other links
            }
        });
    }
}

// Register the navbar component
customElements.define('navbar-component', NavbarComponent);
