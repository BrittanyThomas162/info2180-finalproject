window.addEventListener('load', function() { 
    let displayNotes = document.getElementById("display-notes");
    let addNotesForm = document.getElementById("add-notes-form");
    let contactID = document.querySelector('#display-notes').dataset.id;
    console.log(contactID);

    function fetchAndUpdateNotes() {
        fetch(`view-notes.php?contactID=${contactID}`)
            .then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    return Promise.reject('Something went wrong')
                }
            })
            .then(data => {
                displayNotes.innerHTML = data;
            })
            .catch(error => alert(error));
    }

    fetchAndUpdateNotes()

    addNotesForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        fetch(`update-notes.php?contactID=${contactID}`, {
            method: 'POST',
            body: new FormData(addNotesForm),
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                return Promise.reject('Something went wrong');
            }
        })
        .then(data => {
            console.log(data); 
            fetchAndUpdateNotes();
        })
        .catch(error => alert(error));
    });

});