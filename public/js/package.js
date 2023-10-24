// Function to handle the edit button click
function handleEditButtonClickPackage(packageID,packageName,packagePrice,subjectQuantity,eduID) {
    // Set the data in the modal form
    document.getElementById('packageID').value = packageID;
    document.getElementById('packageName').value = packageName;
    document.getElementById('packagePrice').value = packagePrice;
    document.getElementById('subjectQuantity').value = subjectQuantity;
    document.getElementById('eduID').value = eduID;
    document.getElementById('edit-package-form').action = "/admin/package/" + packageID;
}

// Function to handle the delete button click and confirm delete
function confirmDeletePackage(packageID) {
    if (confirm("Are you sure you want to delete this education level?")) {
        // If user confirms, submit the form for delete action
        document.getElementById('delete-form-package').action = "/admin/package/" + packageID;
        document.getElementById('delete-form-package').submit();
    }
}