const validator = () => {
    const footer_form = document.querySelector('#fi-form');
    const phoneInput = document.querySelector('#fi_phone');

    if(!footer_form || !phoneInput) return;

    footer_form.addEventListener('submit', evt => {
    
        let phoneValue = phoneInput.value.trim();
        
        let phoneRegex = /^\+380\d{9}$/;
        
        if (!phoneRegex.test(phoneValue) && phoneValue !== '') {
            evt.preventDefault();

            phoneInput.style.borderColor = 'red';
            alert('Помилка в форматі номеру телефону.\nБудь ласка, використовуйте формат:\n+380*********');
        } else {
            phoneInput.style.borderColor = '';
        }
    });
    
}

document.addEventListener('DOMContentLoaded', () => {
    validator();
})