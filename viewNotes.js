window.addEventListener('load', function() { 
    let displayNotes = document.getElementById("display-notes");
    let addNotesForm = document.getElementById("add-notes-form");
    //let addNotes = document.getElementById("add-notes");

    function fetchAndUpdateNotes() {
        fetch("view-notes.php")
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
        fetchAndUpdateNotes();
    });

});