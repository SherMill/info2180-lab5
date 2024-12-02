document.addEventListener('DOMContentLoaded', function() {
    const lookUpButton = document.getElementById('lookup');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');
    //added extra button here
    const lookUpCitiesButton = document.getElementById('lookupCities');

    lookupButton.addEventListener('click', function() {
        ajaxLookup('countries');
    });

    lookupCitiesButton.addEventListener('click', function() {
        ajaxLookup('cities');
    });

    function ajaxLookup(type) {
        const countryName = countryInput.value;
        fetch(`world.php?country=${encodeURIComponent(countryName)}&lookup=${type}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data: ', error);
                resultDiv.innerHTML = '<p>Error loading data.</p>';
            });
    }
});
