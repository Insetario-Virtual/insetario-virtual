document.addEventListener("DOMContentLoaded", () => {
    const resetBtn = document.getElementById("resetBtn");
    const form = document.getElementById("filterForm");

    resetBtn.addEventListener("click", () => {
        form.reset();
    });
});
