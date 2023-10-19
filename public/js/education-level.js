// Function to handle the edit button click
function handleEditButtonClick(eduID, eduName) {
    // Set the data in the modal form
    document.getElementById('eduName').value = eduName;
    document.getElementById('edit-edulevel-form').action = "/admin/education-level/" + eduID;
}

// Function to handle the delete button click and confirm delete
function confirmDelete(eduID) {
    if (confirm("Are you sure you want to delete this education level?")) {
        // If user confirms, submit the form for delete action
        document.getElementById('delete-form').action = "/admin/education-level/" + eduID;
        document.getElementById('delete-form').submit();
    }
}