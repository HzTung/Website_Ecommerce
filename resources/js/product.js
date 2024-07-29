const imgEdit = document.getElementById("imgEdit");
const imgEditInput = document.getElementById("editImgInput");

if (typeof imgEditInput !== "undefined" && imgEditInput !== null) {
    imgEditInput.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            const imgUrl = URL.createObjectURL(file);
            imgEdit.src = imgUrl;
            document.getElementById("fileName").textContent = file.name;
        }
    });
}
