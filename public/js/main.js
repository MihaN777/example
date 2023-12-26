// Modals

const modalBtns = document.querySelectorAll("._modal-open");
const modals = document.querySelectorAll("._modal");

const body = document.body;

function openModal(elem) {
    const loginErrors = document.querySelectorAll("[data-register-errors]");
    loginErrors.forEach((el) => {
        el.remove();
    });

    const modalInputs = elem.querySelectorAll("[data-modal-input]");
    modalInputs.forEach((el) => {
        el.value = "";
    });

    elem.classList.add("_active");
    body.classList.add("_locked");
}

function closeModal(e) {
    if (
        e.target.classList.contains("modal-close") ||
        e.target.closest(".modal-close") ||
        e.target.classList.contains("modal-bg")
    ) {
        e.target.closest("._modal").classList.remove("_active");
        body.classList.remove("_locked");
    }
}

modalBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        let data = e.target.dataset.modalOpen;

        modals.forEach((modal) => {
            if (
                modal.dataset.modal == data ||
                modal.dataset.modal ==
                    e.target.closest("._modal-open").dataset.modalOpen
            ) {
                openModal(modal);
            }
        });
    });
});

modals.forEach((modal) => {
    modal.addEventListener("click", (e) => closeModal(e));
});

window.addEventListener("keydown", (e) => {
    modals.forEach((modal) => {
        if (e.key === "Escape" && modal.classList.contains("_active")) {
            modal.classList.remove("_active");
            body.classList.remove("_locked");
        }
    });
});

// Burger menu

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("burger").addEventListener("click", function () {
        document.querySelector("header").classList.toggle("open");
    });
});

// Dropdown user menu

document.addEventListener("DOMContentLoaded", () => {
    /*
		1. по клику на пункты верхнего меню открывать дропдаун
		2. по клику (повторному) на эти пункты - закрывать дропдаун
		3. по клику в любое место сайта, кроме меню - закрывать дропдаун
	*/

    const menuBtns = document.querySelectorAll(".menu__btn");
    const drops = document.querySelectorAll(".dropdown");

    menuBtns.forEach((el) => {
        el.addEventListener("click", (e) => {
            let currentBtn = e.currentTarget;
            let drop = currentBtn
                .closest(".menu__item")
                .querySelector(".dropdown");

            menuBtns.forEach((el) => {
                if (el !== currentBtn) {
                    el.classList.remove("menu__btn--active");
                }
            });

            drops.forEach((el) => {
                if (el !== drop) {
                    el.classList.remove("dropdown--active");
                }
            });

            drop.classList.toggle("dropdown--active");
            currentBtn.classList.toggle("menu__btn--active");
        });
    });

    document.addEventListener("click", (e) => {
        if (!e.target.closest(".menu")) {
            menuBtns.forEach((el) => {
                el.classList.remove("menu__btn--active");
            });

            drops.forEach((el) => {
                el.classList.remove("dropdown--active");
            });
        }
    });
});
