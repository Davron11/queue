document.getElementById('addUserForm').addEventListener('submit', function(event) {
    let passport = document.getElementById('passport').value;
    let pinfl = document.getElementById('pinfl').value;
    let photo = document.getElementById('photo').files[0];

    let passportRegex = /^[A-Z]{2} \d{7}$/;
    let pinflRegex = /^\d{14}$/;

    if (!passportRegex.test(passport)) {
        alert("Ошибка: Паспорт должен быть в формате AA 1234567.");
        event.preventDefault();
        return;
    }

    if (!pinflRegex.test(pinfl)) {
        alert("Ошибка: ПИНФЛ должен состоять из 14 цифр.");
        event.preventDefault();
        return;
    }

    if (photo) {
        let fileSize = photo.size / 1024 / 1024; // MB
        if (fileSize > 5) {
            alert("Ошибка: Фото не должно превышать 5MB.");
            event.preventDefault();
            return;
        }
    }
});
