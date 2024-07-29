window.addEventListener("scroll", function () {
    const header = document.getElementById("header");
    header.style.transition = "0.6s ease-in-out";
    header.classList.toggle("sticky", window.scrollY > 200);
});

//
const textHeading = document.querySelector(".text-heading");
const arr = ["Sản phẩm cao cấp của Sicko", "Ra mắt hình thức mua hàng trả góp"];
let i = 0;
textHeading.innerText = arr[1];
setInterval(function () {
    textHeading.innerText = arr[i];
    i = (i + 1) % arr.length;
}, 1500);

const IconUser = document.getElementById("iconUser");
const userForm = document.getElementById("userForm");

if (IconUser !== null) {
    IconUser.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent the default anchor behavior
        if (
            userForm.style.display === "none" ||
            userForm.style.display === ""
        ) {
            userForm.style.display = "block";
            userForm.style.transform = "translateY(30px)";
        } else {
            userForm.style.display = "none";
        }
        userForm.style.position = "absolute"; // Make sure the position is set properly
    });
}
