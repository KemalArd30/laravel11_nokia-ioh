document.addEventListener('DOMContentLoaded', function() {
    const selectAllLink = document.querySelector('#select-all-link');
    const deselectAllLink = document.querySelector('#deselect-all-link');
    const deleteSelectedLink = document.getElementById('delete-selected-link');
    const refreshLink = document.getElementById('refresh-link');
    const refreshUrl = refreshLink.getAttribute('data-refresh-url');
    const bulkDeleteForm = document.getElementById('bulk-delete-form');
    if (!bulkDeleteForm) {
        console.error('Bulk delete form not found');
    }

    // Handle Select All Link Click
    if (selectAllLink) {
        selectAllLink.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Select All clicked');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
                toggleRowColor(checkbox.closest('tr'), true);
            });
        });
        attachCheckboxListeners();
    }

    // Handle Deselect All Link Click
    if (deselectAllLink) {
        deselectAllLink.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Deselect All clicked');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                toggleRowColor(checkbox.closest('tr'), false);
            });
        });
    }

    // Handle Click on Delete Selected Link
    if (deleteSelectedLink) {
        deleteSelectedLink.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Delete Selected clicked');

            const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
            if (selectedCheckboxes.length > 0) {
                if (confirm('Are you sure you want to delete the selected items?')) {
                    bulkDeleteForm.submit();
                }
            } else {
                alert('Please select at least one item to delete.');
            }
        });
    }

    // Handle Click on Refresh Link
    if (refreshLink) {
        refreshLink.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Refresh clicked');
    
            fetch(refreshUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Menggunakan json() untuk parsing otomatis
            })
            .then(data => {
                console.log('Data fetched:', data);
                updateTable(data); // Function to update the table with new data
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    }

    // Function to update the table with new data
    function updateTable(data) {
        const tbody = document.querySelector('table tbody');
        tbody.innerHTML = ''; // Clear existing rows
    
        data.forEach(sitelist => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center"><input type="checkbox" name="ids[]" value="${sitelist.id_sitelist}" class="row-checkbox"></td>
                <td class="text-center">${sitelist.project_year}</td>
                <td class="text-center">${sitelist.coa}</td>
                <td class="text-center">${sitelist.region}</td>
                <td class="text-center">${sitelist.area}</td>
                <td class="text-center">${sitelist.zone}</td>
                <td class="text-center">${sitelist.system_key}</td>
                <td class="text-center">${sitelist.smp_id}</td>
                <td class="text-center">${sitelist.site_id}</td>
                <td class="text-center">${sitelist.site_name}</td>
                <td class="text-center">${sitelist.status_site}</td>
                <td class="text-center">${sitelist.phase_name}</td>
                <td class="text-center">${sitelist.phase_group}</td>
                <td class="text-center">${sitelist.sow}</td>
                <td class="text-center">${sitelist.sow_detail}</td>
                <td class="text-center">${sitelist.remark}</td>
                <td class="text-center">${sitelist.created_at || ''}</td>
                <td class="text-center">${sitelist.last_update || ''}</td>
                <td class="text-center">
                    <a href="sitelist/${sitelist.id_sitelist}/edit" style="margin-right: 10px;">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-${sitelist.id_sitelist}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            `;
            tbody.appendChild(row);
        });
    
        // Reattach event listeners to new checkboxes
        attachCheckboxListeners();
    }

    // Function to reattach checkbox listeners
    function attachCheckboxListeners() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                console.log('Checkbox changed:', checkbox.checked);
                toggleRowColor(checkbox.closest('tr'), checkbox.checked);
                updateSelectAllCheckbox();
            });
        });
    }

    function toggleRowColor(row, isChecked) {
        console.log('Toggling row color:', isChecked);
        if (row.classList.contains('collapse')) {
            return; // Jangan mengubah warna jika baris adalah baris collapse
        }
        if (isChecked) {
            row.classList.add('checked');
        } else {
            row.classList.remove('checked');
        }
    }

    // Function to update Select All Checkbox based on individual checkboxes
    function updateSelectAllCheckbox() {
        const allChecked = Array.from(document.querySelectorAll('.row-checkbox')).every(checkbox => checkbox.checked);
        // Optionally, you can add logic here to update a "Select All" checkbox if you have one
    }
});