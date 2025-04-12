document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menu-button');
    const menuPopup = document.getElementById('menu-popup');
    const closeButton = document.getElementById('close-menu');

    menuButton.addEventListener('click', function() {
        menuPopup.classList.add('active');
    });

    closeButton.addEventListener('click', function() {
        menuPopup.classList.remove('active');
    });

    const areaSelect = document.getElementById('area-select');
    const genreSelect = document.getElementById('genre-select');
    const searchInput = document.getElementById('search-input');

    function applyFilters() {
        const area = areaSelect.value;
        const genre = genreSelect.value;
        const search = searchInput.value.trim();

        let url = '/?';
        if (area && area !== 'All area') {
            url += 'area=' + encodeURIComponent(area) + '&';
        }
        if (genre && genre !== 'All genre') {
            url += 'genre=' + encodeURIComponent(genre) + '&';
        }
        if (search) {
            url += 'search=' + encodeURIComponent(search) + '&';
        }

        url = url.replace(/[&?]$/, '');

        window.location.href = url;
    }

    areaSelect.addEventListener('change', applyFilters);
    genreSelect.addEventListener('change', applyFilters);

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });

    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    favoriteButtons.forEach(button => {
        if (!button.hasAttribute('data-shop-id')) return;

        button.addEventListener('click', function() {
            const shopId = this.getAttribute('data-shop-id');

            fetch('/favorites/' + shopId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    this.classList.add('active');
                } else {
                    this.classList.remove('active');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});