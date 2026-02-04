let currentType = 'employees';

document.addEventListener('DOMContentLoaded', () => {
    // Initial load
    loadData('employees');

    // Search input event
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            loadData(currentType, e.target.value);
        });
    }
});

async function loadData(type, search = '') {
    currentType = type;
    const container = document.getElementById('table-container');
    const title = document.getElementById('view-title');
    
    // Update UI state
    title.innerText = `Lista: ${type.charAt(0).toUpperCase() + type.slice(1)}`;
    container.innerHTML = '<div style="text-align:center; padding: 2rem;">Duke ngarkuar...</div>';

    try {
        const response = await fetch(`api_data.php?type=${type}&search=${search}`);
        const data = await response.json();

        if (data.error) {
            container.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
            return;
        }

        if (data.length === 0) {
            container.innerHTML = '<p style="text-align:center; padding: 2rem;">Nuk u gjet asnje rekord.</p>';
            return;
        }

        // Build table
        let html = '<table><thead><tr>';
        
        // Headers based on type
        if (type === 'employees') {
            html += '<th>ID</th><th>Emri</th><th>Mbiemri</th><th>Email</th>';
        } else if (type === 'departments') {
            html += '<th>ID</th><th>Departamenti</th><th>Manager ID</th><th>Location ID</th>';
        } else if (type === 'countries') {
            html += '<th>ID</th><th>Shteti</th><th>Region ID</th>';
        }
        
        html += '</tr></thead><tbody>';

        data.forEach(row => {
            html += `<tr>
                <td>${row.id}</td>
                <td>${row.field1}</td>
                <td>${row.field2}</td>
                ${row.field3 !== undefined && row.field3 !== '' ? `<td>${row.field3}</td>` : ''}
            </tr>`;
        });

        html += '</tbody></table>';
        container.innerHTML = html;

    } catch (err) {
        container.innerHTML = '<div class="alert alert-danger">Gabim gjate marrjes se te dhenave.</div>';
    }
}
