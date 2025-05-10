document.addEventListener('DOMContentLoaded', function() {
    var categoryLinks = document.querySelectorAll('.category__link');

    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var category = this.getAttribute('data-category');

            document.querySelectorAll('.category-content').forEach(function(content) {
                content.style.display = 'none';
            });
            document.getElementById(category).style.display = 'block';
        });
    });
});