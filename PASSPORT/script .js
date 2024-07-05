const form = document.querySelector("form"),
      nextBtn = form.querySelector(".nextBtn"),
      backBtn = form.querySelector(".backBtn"),
      allInput = form.querySelectorAll(".first input, .first select");

nextBtn.addEventListener("click", () => {
    let allFilled = true;
    allInput.forEach(input => {
        if (input.value === "" || input.value === "Select gender") {
            allFilled = false;
        }
    });
    if (allFilled) {
        form.classList.add('secActive');
    } else {
        alert("Please fill in all fields.");
        form.classList.remove('secActive');
    }
});

backBtn.addEventListener("click", () => form.classList.remove('secActive'));
