document.addEventListener("DOMContentLoaded", function () {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const closeMenuButton = document.getElementById("close-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    // Toggle menu visibility on button click
    mobileMenuButton.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });

    // Close menu ketika button du klik
    closeMenuButton.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
    });

    // Close menu when any link inside the menu is clicked
    document.querySelectorAll("#mobile-menu a").forEach(function (link) {
        link.addEventListener("click", function () {
            mobileMenu.classList.add("hidden");
        });
    });
});
