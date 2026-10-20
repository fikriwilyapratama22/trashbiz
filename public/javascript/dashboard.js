document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("mainContent");
    const hamburgerButton = document.getElementById("hamburgerButton");

    hamburgerButton.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("sidebar-collapsed");
    });

    // JavaScript for toggling profile dropdown
    const profileButton = document.querySelector("div.relative > button");
    const profileDropdown = document.querySelector(
        "div.absolute.right-0.mt-2.w-48.bg-white.rounded-md.shadow-lg.py-2"
    );

    profileButton.addEventListener("click", () => {
        profileDropdown.classList.toggle("hidden");
    });
});

// JavaScript for toggling user dropdown
function toggleDropdown() {
    const dropdown = document.getElementById("userDropdown");
    dropdown.classList.toggle("hidden");
}
