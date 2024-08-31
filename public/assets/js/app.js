// import axios from "axios";
// window.axios = axios;
import "./index.js";

const iconSearchs = document.querySelectorAll(".iConSearch");
const searchBg = document.getElementById("search");
const searchButton = document.getElementById("search-button");
const searchInput = document.getElementById("search-input");
var searchData = [];
iconSearchs.forEach((iconSearch) => {
    iconSearch.addEventListener("click", (e) => {
        e.preventDefault();
        if (searchBg.style.display === "block") {
            searchBg.style.display = "none";
        } else {
            searchBg.style.display = "block";
            searchBg.style.transition = "0.6s ease-in-out";
        }
        searchBg.classList.toggle("sticky");
    });
});

// searchButton.addEventListener("click", () => {
//     console.log(searchData);
// });

function check_search() {
    searchList.textContent = "";
    if (searchData == "") {
        return 0;
    }
    call_api_check(searchData);
}

function check_search_value() {
    const inputValue = searchInput.value;
    if (searchData != inputValue) {
        searchData = inputValue;
        check_search();
    }
}

setInterval(check_search_value, 1000);

function call_api_check(inputValue) {
    axios({
        method: "get",
        url: "http://127.0.0.1:8000/api/search",
        params: { query: inputValue },
    })
        .then(function (response) {
            const datas = response.data;
            const ul = document.createElement("ul");
            if (datas.length !== 0) {
                datas.forEach((data) => {
                    const li = document.createElement("li");
                    const img = document.createElement("img");
                    const a = document.createElement("a");
                    const p = document.createElement("p");

                    p.textContent = data.name_sp;

                    img.src = `http://127.0.0.1:8000/uploads/${data.img}`;
                    img.width = 70;

                    a.appendChild(img);
                    a.appendChild(p);
                    a.className =
                        "d-flex justify-content-start align-items-center";
                    a.href = `http://127.0.0.1:8000/ProDetails/${data.id}`;

                    li.appendChild(a);

                    ul.appendChild(li);
                });
            } else {
                const li = document.createElement("li");
                const p = document.createElement("p");
                p.textContent = "Không tìm thấy kết quả!";
                li.appendChild(p);
                ul.appendChild(li);
            }
            searchList.appendChild(ul);
            searchList.style.display = "block";
        })
        .catch(function (error) {
            console.error("There was an error making the request:", error);
        });
}

// profile

const inputForms = document.querySelectorAll(".input-form");
const btnFix = document.querySelector(".btn-fix");
const btnUpdate = document.querySelector(".btn-update");

if (typeof btnFix !== "undefined" && btnFix !== null) {
    btnFix.addEventListener("click", (e) => {
        e.preventDefault();
        inputForms.forEach((input) => {
            if (input.disabled == true) {
                input.disabled = false;
            } else {
                input.disabled = true;
            }
        });
    });

    btnUpdate.addEventListener("click", (e) => {
        e.preventDefault();

        const data = {
            id: "",
            fullname: "",
            email: "",
            sdt: "",
        };

        inputForms.forEach((input) => {
            const fieldName = input.name;
            if (data.hasOwnProperty(fieldName)) {
                data[fieldName] = input.value;
            }
        });

        axios({
            method: "post",
            url: "http://127.0.0.1:8000/api/profileUpdate",
            headers: {
                "Content-Type": "application/json",
            },
            data: {
                data: data,
            },
        })
            .then((response) => {
                if (response.status == 200) {
                    swal("Thông báo", "Cập nhật thành công!", "success");
                }
            })
            .catch((error) => {
                swal("Thông báo", "Cập nhật thất bại!", "error");
            });
    });
} else {
}

//

const formBuying = document.getElementById("formBuying");
const btnBuying = document.getElementById("btn-buying");

if (btnBuying) {
    btnBuying.addEventListener("click", (e) => {
        e.preventDefault();
        if (formBuying.style.display === "block") {
            formBuying.style.display = "none";
        } else {
            formBuying.style.display = "block";
            formBuying.style.transition = "0.6s ease-in-out";
        }
        formBuying.classList.toggle("sticky");
    });
}
