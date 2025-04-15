document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll("button:last-child");

    deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const row = this.closest("tr");
            if (confirm("Вы уверены, что хотите удалить пользователя?")) {
                row.remove();
            }
        });
    });
});
