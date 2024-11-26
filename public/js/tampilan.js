function toggleSearchBox() {
    const searchBox = document.querySelector('.searching');
    const searchIcon = document.querySelector('.search-icon');

    // Toggle class 'active' to searchBox when clicking on search icon
    if (!searchBox.classList.contains('active')) {
        searchBox.classList.add('active');
        searchBox.focus(); // Focus on the search box after it expands
        searchIcon.style.display = 'none'; // Hide search icon
    } else {
        resetSearchBox();
    }
}

function resetSearchBox() {
    const searchBox = document.querySelector('.searching');
    const searchIcon = document.querySelector('.search-icon');
    searchBox.classList.remove('active');
    searchBox.value = ''; // Clear the input value
    searchIcon.style.display = 'block'; // Show search icon again
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const searchBox = event.target.value;
        // Redirect ke URL beranda dengan parameter pencarian
        window.location.href = `/beranda?search=${encodeURIComponent(searchBox)}`;
    }
}

document.addEventListener('click', function(event) {
    const searchBox = document.querySelector('.searching');
    const searchIcon = document.querySelector('.search-icon');

    if (!searchBox.contains(event.target) && !searchIcon.contains(event.target)) {
        resetSearchBox();
    }
});