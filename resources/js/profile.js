// Select all tab buttons and tab contents
const tabs = document.querySelectorAll(".tab-btn"); // Get all elements where the class is 'tab-btn'
const tabContents = document.querySelectorAll(".tab-content");  // Get all elements where the class is 'tab-content'

// Function to handle tab switching
const handleTabSwitch = (tabIndex) => {
    // Remove the "active" class from all tabs and contents
    tabContents.forEach(content => content.classList.remove("active"));
    tabs.forEach(tab => tab.classList.remove("active"));

    // Add the "active" class to the selected tab and content
    tabContents[tabIndex].classList.add("active");
    tabs[tabIndex].classList.add("active");
};

// Add click event listeners to all tab buttons
tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => handleTabSwitch(index));
});

// Handle DOM content loaded event
document.addEventListener("DOMContentLoaded", () => {
    const propertyPostBtn = document.getElementById("property-post-btn");   // Get the property post button element by its ID
    const propertyPostContent = document.getElementById("property-post");   // Get the property post content element by its ID
    const userRole = propertyPostBtn.getAttribute("data-role"); // Retrieve the user's role from the data-role attribute.

    // Configure visibility based on user role
    if (userRole === "Tenant") {
        tabs[1].classList.add("active");    // Make the find roommate post tab as active by default
        tabContents[1].classList.add("active"); // Make the find roommate content as active by default
        propertyPostBtn.style.display = "none"; // Hide the property post button for tenants
        propertyPostContent.style.display = "none"; // Hide the property post content for tenants
    } else {
        tabs[0].classList.add("active");    // Make the property post tab as active by default
        tabContents[0].classList.add("active"); // Make the property post content as active by default
        propertyPostBtn.style.display = "inline-block"; // Show the property post button for landlords
    }
});
