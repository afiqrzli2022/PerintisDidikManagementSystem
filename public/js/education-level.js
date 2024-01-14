// Function to handle the edit button click
function handleEditButtonClickEduLevel(eduID, eduName) {
    // Set the data in the modal form
    document.getElementById('eduID').value = eduID;
    document.getElementById('eduName').value = eduName;
    document.getElementById('edit-edulevel-form').action = "/admin/education-level/" + eduID;
}

// Function to handle the delete button click and confirm delete
function confirmDeleteEduLevel(eduID) {
    if (confirm("Are you sure you want to delete this education level? All related data might be deleted(Ex: Student's current subscription)")) {
        // If user confirms, submit the form for delete action
        document.getElementById('delete-form-edulevel').action = "/admin/education-level/" + eduID;
        document.getElementById('delete-form-edulevel').submit();
    }
}