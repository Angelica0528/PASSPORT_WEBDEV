$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
 });

 document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.querySelector(".transition-overlay");

    // Hide the overlay when the page is fully loaded
    setTimeout(() => {
        overlay.classList.add("hidden");
    }, 500);

    // Add a click event listener to all links
    document.querySelectorAll("a").forEach(link => {
        if (link.hostname === window.location.hostname) {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const href = link.getAttribute("href");

                // Show the overlay
                overlay.classList.remove("hidden");

                // Wait for the animation to complete before navigating
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            });
        }
    });
});