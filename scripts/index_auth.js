document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.nav__link');

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                var targetId = href.substring(1);
                var targetSection = document.getElementById(targetId);

                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});