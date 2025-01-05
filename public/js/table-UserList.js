document.addEventListener('DOMContentLoaded', function() {
    const selectAllLink = document.querySelector('#select-all-link');
    const deselectAllLink = document.querySelector('#deselect-all-link');
    const deleteSelectedLink = document.querySelector('#delete-selected-link');
    const refreshLink = document.querySelector('.refresh'); // Moved inside DOMContentLoaded
    const bulkDeleteForm = document.getElementById('bulk-delete-form');

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
        deleteSelectedLink.addEventListener('click', function (event) {
            event.preventDefault();
    
            const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
            if (selectedCheckboxes.length > 0) {
                if (confirm('Are you sure you want to delete the selected items?')) {
                    const ids = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
                    const form = document.getElementById('bulk-delete-form');
    
                    // Tambahkan input hidden dengan ID yang dipilih
                    ids.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });
    
                    form.submit();
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

            fetch('http://127.0.0.1:8000/users/data')
                .then(response => response.json())
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

        data.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center"><input type="checkbox" name="ids[]" value="${user.id}" class="row-checkbox"></td>
                <td class="text-center">${user.name}</td>
                <td class="text-center">${user.email}</td>
                <td class="text-center">${user.region}</td>
                <td class="text-center">${user.role}</td>
                <td class="text-center">${user.created_at || ''}</td>
                <td class="text-center">${user.updated_at || ''}</td>
                <td class="text-center">
                    <a href="user/${user.id}/edit" style="margin-right: 10px;">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-${user.id}">
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

    // Function to toggle row color
    function toggleRowColor(row, isChecked) {
        console.log('Toggling row color:', isChecked);
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