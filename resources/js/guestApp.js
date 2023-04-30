
function dropDownNavBarMenu() {
    const optionMenu = document.querySelector(".nav-links .select-menu"),
    selectBtn = optionMenu.querySelector(".nav-links .select-btn"),
    options = optionMenu.querySelectorAll(".nav-links .option"),
    sBtn_text = optionMenu.querySelector(".nav-links .sBtn-text");

    selectBtn.addEventListener("click", () =>
        optionMenu.classList.toggle("active")
    );

    options.forEach((option) => {
    option.addEventListener("click", () => {
        let selectedOption = option.querySelector(".nav-links .option-text").innerText;
        sBtn_text.innerText = selectedOption;
        optionMenu.classList.remove("active");
    });
    });
}
dropDownNavBarMenu();

