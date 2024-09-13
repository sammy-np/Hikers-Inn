document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("totalGuest"); // Replace 'yourTableId' with the actual ID of your table
    const rows = table.getElementsByTagName("tr");

    searchInput.addEventListener("input", function () {
        const searchText = searchInput.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) 
        { // Start from 1 to skip the header row
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let rowContainsSearchText = false;

            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent.toLowerCase();

                if (cellText.includes(searchText)) {
                    rowContainsSearchText = true;
                    break;
                }
            }

            if (rowContainsSearchText) {
                row.style.display = "";
                row.classList.add("highlight");
            } else {
                row.style.display = "none";
                row.classList.remove("highlight");
            }
        }
    });
});
