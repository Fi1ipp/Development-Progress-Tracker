function editName(site_name) {
    const formData = new FormData();
    const newProjectName = prompt("Change project name:");

    const ids = site_name.split("_")

    if (newProjectName !== null) {
        formData.append("name", newProjectName);
        formData.append("id", ids[0])
        formData.append("site_id", ids[1])

        const func = "http://localhost/Development%20Progress%20Tracker/functions/editProject.php"

        fetch(func, {
            method: "POST",
            body: formData
        })
    }
}

function deleteProject(site_name) {
    const formData = new FormData();
    const sure = prompt("Are you sure you want to delete this project?");

    localStorage.removeItem(site_name);

    const ids = site_name.split("_")

    if (sure !== null) {
        formData.append("id", ids[0])
        formData.append("site_id", ids[1])

        const func = "http://localhost/Development%20Progress%20Tracker/functions/deleteProject.php"

        fetch(func, {
            method: "POST",
            body: formData
        })
    }
}