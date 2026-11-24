const menuToggle = document.querySelector(".menu-toggle");
const navList = document.querySelector(".nav-list");

if (menuToggle && navList) {
  menuToggle.addEventListener("click", () => {
    const isOpen = navList.classList.toggle("open");
    menuToggle.setAttribute("aria-expanded", isOpen.toString());
  });
}

// Simple reservation popup for the homepage preview.
const reservation = document.querySelector("#reservation-dialog");

document.querySelectorAll("[data-open-reservation]").forEach((button) => {
  button.addEventListener("click", () => {
    if (reservation) {
      reservation.showModal();
    }
  });
});

const closeReservation = document.querySelector("[data-close-reservation]");

if (closeReservation && reservation) {
  closeReservation.addEventListener("click", () => reservation.close());
}

