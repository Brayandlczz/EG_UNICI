document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector("#sidebar");
    const mainContent = document.querySelector(".main-content");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("expand");

        if (sidebar.classList.contains("expand")) {
            mainContent.style.marginLeft = "260px";
        } else {
            mainContent.style.marginLeft = "70px";
        }
    });
});
