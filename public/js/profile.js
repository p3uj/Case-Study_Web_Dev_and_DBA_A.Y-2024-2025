const tabs = document.querySelectorAll(".tab-btn"); // Get all the tab button
const tabContents = document.querySelectorAll(".tab-content");  // Get all the content in the tab

tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        tabContents.forEach((content) => {
            content.classList.remove("active");
        });
        tabs.forEach(tab => {
            tab.classList.remove("active");
        });
        tabContents[index].classList.add("active");
        tabs[index].classList.add("active");
    });
});
