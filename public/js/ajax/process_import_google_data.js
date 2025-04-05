const depot = document.getElementById("depot");
const fileNames = document.getElementById("file_names");

depot.ondragover = (event) => {
    event.preventDefault();
    depot.style.backgroundColor = "#8E166C";
};

depot.ondrop = (event) => {
    event.preventDefault();
    depot.style.backgroundColor = "hsl(0, 90%, 80%)";

    const csvFile = event.dataTransfer.files[0];
    const results = [`<li><strong>${csvFile.name}</strong> - ${csvFile.size} octets</li>`];

    const reader = new FileReader();

    reader.onload = async (e) => {
        const lines = e.target.result.split("\n").filter(line => line.trim() !== "");
        const headers = lines[0].split(",").map(head => head.replace(/"/g, "").trim());

        const getIndex = (label) => headers.findIndex(head => head === label);
        const idxFirstName = getIndex("First Name");
        const idxMiddleName = getIndex("Middle Name");
        const idxLastName = getIndex("Last Name");
        const idxPhoto  = getIndex("Photo");
        const idxEmail = getIndex("E-mail 1 - Value");
        const idxPhone = getIndex("Phone 1 - Value");

        const contacts = [];

        for (let i = 1; i < lines.length; i++) {
            const row = lines[i].split(",");
            contacts.push({
                firstname: row[idxFirstName]?.replace(/"/g, "").trim() || "",
                middlename: row[idxMiddleName]?.replace(/"/g, "").trim() || "",
                lastname: row[idxLastName]?.replace(/"/g, "").trim() || "",
                imageUrl: row[idxPhoto]?.replace(/"/g, "").trim() || "",
                email: row[idxEmail]?.replace(/"/g, "").trim() || "",
                phone: row[idxPhone]?.replace(/"/g, "").trim() || ""
            });
        }

        if (contacts.length > 0) {
            try {
                document.getElementById("loader").style.display = "block";

                const BASE_URL = window.location.hostname === "localhost" ? "/contacts_manager/public" : "";
                const response = await fetch(`${BASE_URL}/ajax/importGoogle2bdd.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                    body: JSON.stringify({ contacts })
                });

                const result = await response.text();
                document.getElementById("import_process").innerHTML = result;
            } catch (error) {
                console.error("Erreur ajax :", error);
            } finally {
                document.getElementById("loader").style.display = "none";
            }
        } else {
            console.log("Aucun contact à importer.");
        }
    };

    reader.readAsText(csvFile, "UTF-8");
    fileNames.innerHTML = `<ul>${results.join("")}</ul>`;
};
