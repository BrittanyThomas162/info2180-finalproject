window.addEventListener('load', function() { 
    let tableDiv = document.getElementById("contactsTable");
    let filterOptions = document.getElementById("filterOptions");
    let filterStatus = 'all';

    // Function to fetch and update the table
    function fetchAndUpdateTable() {
        fetch(`view-contacts.php?filter=${filterStatus}`)
            .then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    return Promise.reject('Something went wrong')
                }
            })
            .then(data => {
                tableDiv.innerHTML = data;
            })
            .catch(error => alert(error));
    }

    fetchAndUpdateTable();

    // Event listener for filter options
    filterOptions.addEventListener('click', function(event) {
        if (event.target.tagName === 'A') {
            event.preventDefault();
            filterStatus = event.target.id;
            console.log("Filter Status:", filterStatus);

            fetchAndUpdateTable();
        }
    });
});