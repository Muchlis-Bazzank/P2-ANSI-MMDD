// Function to switch between tables
function switchTable(tableIndex) {
  const tables = document.querySelectorAll(".table-container");
  const buttons = document.querySelectorAll(".tab-button");

  tables.forEach((table, index) => {
    if (index === tableIndex) {
      table.classList.add("active");
    } else {
      table.classList.remove("active");
    }
  });

  buttons.forEach((button, index) => {
    if (index === tableIndex) {
      button.classList.add("active");
    } else {
      button.classList.remove("active");
    }
  });
}

// Search functionality
document.getElementById("searchInput").addEventListener("keyup", function () {
  const searchValue = this.value.toLowerCase();
  const tables = document.querySelectorAll(".table");

  tables.forEach((table) => {
    const rows = table.querySelectorAll("tbody tr");

    rows.forEach((row) => {
      const text = row.textContent.toLowerCase();
      if (text.includes(searchValue)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
});

// Add animation class when page loads
document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".fade-in");
  elements.forEach((el, index) => {
    el.style.animationDelay = `${index * 0.1}s`;
  });
});

// Mobile menu toggle
document.getElementById("mobileMenuBtn").addEventListener("click", function () {
  document.getElementById("navbarMenu").classList.toggle("active");
});
