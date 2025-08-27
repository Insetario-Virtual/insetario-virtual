document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll(".insect-image");
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const prevBtn = document.getElementById("prevImage");
    const nextBtn = document.getElementById("nextImage");

    let currentIndex = 0;

    const openModal = (index) => {
        currentIndex = index;
        modalImage.src = images[currentIndex].src;
        modal.classList.remove("hidden");
    };

    const closeModal = () => {
        modal.classList.add("hidden");
    };

    const showNext = () => {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            modalImage.src = images[currentIndex].src;
        }
    };

    const showPrev = () => {
        if (currentIndex > 0) {
            currentIndex--;
            modalImage.src = images[currentIndex].src;
        }
    };

    images.forEach((img, index) => {
        img.addEventListener("click", () => openModal(index));
    });

    modal.addEventListener("click", closeModal);
    prevBtn.addEventListener("click", (e) => { e.stopPropagation(); showPrev(); });
    nextBtn.addEventListener("click", (e) => { e.stopPropagation(); showNext(); });
});