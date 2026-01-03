function openFullSize(img) {
    var modal = document.getElementById("imgModal");
    var modalImg = document.getElementById("modalImg");
    modal.style.display = "block";
    modalImg.src = img.src;
}

function closeModal() {
    document.getElementById("imgModal").style.display = "none";
}

// Close the modal when clicking outside the image
window.onclick = function (event) {
    var modal = document.getElementById("imgModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        closeModal();
    }
});
let currentPage = 1;
const totalPages = 2;

function goToPage(pageNumber) {
    // Sembunyikan semua halaman
    for (let i = 1; i <= totalPages; i++) {
        document.getElementById(`page-${i}`).style.display = 'none';
    }

    // Tampilkan halaman yang dipilih
    document.getElementById(`page-${pageNumber}`).style.display = 'grid';

    // Perbarui status tombol navigasi
    updatePaginationButtons(pageNumber);

    // Perbarui halaman aktif
    currentPage = pageNumber;
}

function prevPage() {
    if (currentPage > 1) {
        goToPage(currentPage - 1);
    }
}

function nextPage() {
    if (currentPage < totalPages) {
        goToPage(currentPage + 1);
    }
}

function updatePaginationButtons(pageNumber) {
    // Reset semua tombol halaman
    const pageButtons = document.querySelectorAll('.page-btn');
    pageButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Tandai tombol halaman aktif
    pageButtons[pageNumber - 1].classList.add('active');

    // Aktifkan/nonaktifkan tombol prev
    document.querySelector('.prev-next-btn:first-child').disabled = (pageNumber === 1);

    // Aktifkan/nonaktifkan tombol next
    document.querySelector('.prev-next-btn:last-child').disabled = (pageNumber === totalPages);
}