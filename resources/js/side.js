document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll(".scrollable-tabs-container a");
    const rightArrow = document.querySelector(".scrollable-tabs-container .right-arrow svg");
    const leftArrow = document.querySelector(".scrollable-tabs-container .left-arrow svg");
    const tabsList = document.querySelector(".scrollable-tabs-container ul");
    const leftArrowContainer = document.querySelector(".scrollable-tabs-container .left-arrow");
    const rightArrowContainer = document.querySelector(".scrollable-tabs-container .right-arrow");

    const removeAllActiveClasses = () => {
        tabs.forEach(tab => {
            tab.classList.remove("active");
        });
    };

    console.log("slide.js chargé");

    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                removeAllActiveClasses();
                tab.classList.add("active");
            });
        });
    }

    const manageIcons = () => {
        if (!tabsList) return;

        if (tabsList.scrollLeft >= 20) {
            leftArrowContainer.classList.add("active");
        } else {
            leftArrowContainer.classList.remove("active");
        }

        let maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;
        console.log("scroll width:", tabsList.scrollWidth);
        console.log("client width:", tabsList.clientWidth);

        if (tabsList.scrollLeft >= maxScrollValue) {
            rightArrowContainer.classList.remove("active");
        } else {
            rightArrowContainer.classList.add("active");
        }
    };

    if (rightArrow && tabsList) {
        rightArrow.addEventListener("click", () => {
            tabsList.scrollLeft += 400;
            manageIcons();
        });
    }

    if (leftArrow && tabsList) {
        leftArrow.addEventListener("click", () => {
            tabsList.scrollLeft -= 400;
            manageIcons();
        });
    }

    if (tabsList) {
        tabsList.addEventListener("scroll", manageIcons);

        let dragging = false;
        const drag = (e) => {
            if (!dragging) return;
            tabsList.classList.add("dragging");
            tabsList.scrollLeft -= e.movementX;
        };

        tabsList.addEventListener("mousedown", () => {
            dragging = true;
        });

        tabsList.addEventListener("mousemove", drag);

        tabsList.addEventListener("mouseup", () => {
            dragging = false;
            tabsList.classList.remove("dragging");
        });
    }
});
