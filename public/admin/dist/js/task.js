$('.delete-tasks-btn').click(function () {
    let res = confirm('Подтвердить действие');
    if (!res) {
        return false;
    }
});
