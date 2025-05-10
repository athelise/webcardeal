document.addEventListener('DOMContentLoaded', function() {
    const cars = document.querySelectorAll('.car');
    const submitButton = document.querySelector('.submit__button');
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const brandInput = document.getElementById('selected-brand');
    const modelInput = document.getElementById('selected-model');

    function updateSubmitButton() {
        const isCarSelected = brandInput.value && modelInput.value;
        const isDateSelected = dateInput.value;
        const isTimeSelected = timeInput.value;
        
        submitButton.disabled = !(isCarSelected && isDateSelected && isTimeSelected);
    }

    cars.forEach(function(car) {
        car.addEventListener('click', function() {
            cars.forEach(function(c) {
                c.classList.remove('selected');
            });
            this.classList.add('selected');

            brandInput.value = this.getAttribute('data-brand');
            modelInput.value = this.getAttribute('data-model');
            updateSubmitButton();
        });
    });

    dateInput.addEventListener('change', updateSubmitButton);
    timeInput.addEventListener('change', updateSubmitButton);
});