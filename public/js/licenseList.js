document.addEventListener('DOMContentLoaded', function () {

    let currentPage = 1;
    let entriesPerPage = 10;
    let filteredRows = [];
    const allRows = Array.from(document.querySelectorAll('#tableBody tr:not(.no-data-row)'));

    const searchInput = document.getElementById('searchInput');
    const entriesSelector = document.getElementById('entriesSelector');
    const tableBody = document.getElementById('tableBody');
    const paginationInfo = document.getElementById('paginationInfo');
    const paginationControls = document.getElementById('paginationControls');

    function init() {
        filteredRows = [...allRows];

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                currentPage = 1;
                filterTable();
            });
        }

        if (entriesSelector) {
            entriesSelector.addEventListener('change', (e) => {
                entriesPerPage = parseInt(e.target.value);
                currentPage = 1;
                renderTable();
            });
        }

        renderTable();
    }

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();

        filteredRows = allRows.filter(row => {
            const text = row.innerText.toLowerCase();
            return text.includes(searchTerm);
        });

        renderTable();
    }

    function renderTable() {
        const totalEntries = filteredRows.length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        const start = (currentPage - 1) * entriesPerPage;
        const end = Math.min(start + entriesPerPage, totalEntries);

        allRows.forEach(row => row.style.display = 'none');

        if (totalEntries === 0) {
            tableBody.innerHTML = '<tr class="no-data-row"><td colspan="5" class="no-data">No se encontraron registros</td></tr>';
        } else {
            const noDataRow = tableBody.querySelector('.no-data-row');
            if (noDataRow) noDataRow.remove();

            filteredRows.slice(start, end).forEach(row => {
                row.style.display = '';
            });
        }

        updatePaginationInfo(start + 1, end, totalEntries);
        renderPaginationControls(totalPages);
    }

    function updatePaginationInfo(start, end, total) {
        if (total === 0) {
            paginationInfo.innerText = 'Mostrando 0 a 0 de 0 registros';
        } else {
            paginationInfo.innerText = `Mostrando ${start} a ${end} de ${total} registros`;
        }
    }

    function renderPaginationControls(totalPages) {
        paginationControls.innerHTML = '';

        if (totalPages <= 1) return;

        const prevBtn = createPageButton('Anterior', currentPage > 1, () => {
            currentPage--;
            renderTable();
        });
        paginationControls.appendChild(prevBtn);

        for (let i = 1; i <= totalPages; i++) {
            const pageBtn = createPageButton(i, true, () => {
                currentPage = i;
                renderTable();
            });
            if (i === currentPage) pageBtn.classList.add('active');
            paginationControls.appendChild(pageBtn);
        }

        const nextBtn = createPageButton('Siguiente', currentPage < totalPages, () => {
            currentPage++;
            renderTable();
        });
        paginationControls.appendChild(nextBtn);
    }

    function createPageButton(text, enabled, callback) {
        const btn = document.createElement('button');
        btn.innerText = text;
        btn.className = 'page-btn';
        if (!enabled) btn.disabled = true;
        btn.addEventListener('click', callback);
        return btn;
    }

    init();
});

document.addEventListener('DOMContentLoaded', function () {
    init();
});

function openEditModal(id, status, expiration) {
    const modal = document.getElementById('editModalOverlay');
    const form = document.getElementById('editForm');

    document.getElementById('edit_status').value = status;
    document.getElementById('edit_expiration').value = expiration;

    form.action = `/gym/update/${id}`;

    modal.style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function (event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}