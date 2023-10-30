function handleEditButtonClickSubject(subjectID,subjectName,time,day,duration,eduID,tutorID) {
    // Set the data in the modal form
    document.getElementById('subjectID').value = subjectID;
    document.getElementById('subjectName').value = subjectName;
    document.getElementById('time').value = time;
    document.getElementById('day').value = day;
    document.getElementById('duration').value = duration;
    document.getElementById('eduID').value = eduID;
    document.getElementById('tutorID').value = tutorID;
    document.getElementById('edit-subject-form').action = "/admin/subject/" + subjectID;
}

// Function to handle the delete button click and confirm delete
function confirmDeleteSubject(subjectID) {
    if (confirm("Are you sure you want to delete this education level?")) {
        // If user confirms, submit the form for delete action
        document.getElementById('delete-form-subject').action = "/admin/subject/" + subjectID;
        document.getElementById('delete-form-subject').submit();
    }
}