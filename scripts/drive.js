document.addEventListener('DOMContentLoaded', function() {
    var cars = document.querySelectorAll('.car');

    cars.forEach(function(car) {
        car.addEventListener('click', function() {
            cars.forEach(function(c) {
                c.classList.remove('selected');
            });
            this.classList.add('selected');

            document.getElementById('selected_brand').value = this.getAttribute('data-brand');
            document.getElementById('selected_model').value = this.getAttribute('data-model');
        });
    });
});