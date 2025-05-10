document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.nav__link');

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetSection = document.getElementById(targetId);

            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});