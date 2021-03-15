
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', (event) => {
        let elem = event.target;

        if(elem.className === 'delete') {
            let id = elem.dataset.id;
            let url = location.href;

            let data = { id };
            let options = {
                method: 'DELETE',
                body: JSON.stringify(data),
            };
            fetch(url, options)
                .then((response) => {
                    elem.closest('.items').remove();
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    });
    $deleteButton = document.querySelector('delete');
    console.log($deleteButton);
});