document.addEventListener('DOMContentLoaded', function() {
    const lookupButton = document.getElementById('lookup');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function() {
        const countryName = countryInput.value;
        fetch(`world.php?country=${encodeURIComponent(countryName)}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data: ', error);
                resultDiv.innerHTML = '<p>Error loading data.</p>';
            });
    });
});