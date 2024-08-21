function showPopup(errorMessage) {
    const popup = document.getElementById('popup');
    const errorMessageElement = document.getElementById('errorMessage');
    errorMessageElement.textContent = errorMessage;
    popup.style.display = 'flex';

    const closeBtn = document.querySelector('.close-btn');
    const closePopupBtn = document.getElementById('closePopupBtn');

    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    closePopupBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
}
