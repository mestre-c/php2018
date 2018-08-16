const stories = document.getElementById('story-table');
const solutions = document.getElementById('solution-table');

// applying event delegation to target the delete buttons
if (stories) {
    stories.addEventListener('click', event => {

        if (event.target.className === 'btn btn-danger delete-story') {
                if (confirm('Are you sure?')) {
                    const id = event.target.getAttribute('data-id');

                    // fetch request to the backend
                    fetch(`/stories/delete/${id}` , {
                        method: 'DELETE'
                    }).then(result => window.location.reload());
                }
        }
    });
}




