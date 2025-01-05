document.addEventListener('DOMContentLoaded', function() {
    const selectAllLink = document.querySelector('#select-all-link');
    const deselectAllLink = document.querySelector('#deselect-all-link');
    const deleteSelectedLink = document.getElementById('delete-selected-link');
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

    // Function to toggle row color
    function toggleRowColor(row, isChecked) {
        if (row.classList.contains('collapse')) {
            return; // Jangan mengubah warna jika baris adalah baris collapse
        }
        if (isChecked) {
            row.classList.add('checked');
        } else {
            row.classList.remove('checked');
        }
    }

    // Function to attach event listeners to checkboxes
    function attachCheckboxListeners() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleRowColor(checkbox.closest('tr'), checkbox.checked);
            });
        });
    }

    // Attach listeners on page load
    attachCheckboxListeners();
});