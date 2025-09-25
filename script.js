function message()
{
    alert("Thank you for Submitting");
}
function toggleMenu() {
    document.querySelector("nav ul").classList.toggle("show");
  }
  document.getElementById("read-more-btn").addEventListener("click", function() {
    var moreText = document.getElementById("more-text");
    if (moreText.style.display === "none") {
        moreText.style.display = "inline";  // show the extra text
        this.textContent = "Read Less";     // change button text
    } else {
        moreText.style.display = "none";    // hide the extra text
        this.textContent = "Read More...";
    }
});
// Select all "See More" buttons
const seeMoreButtons = document.querySelectorAll(".see-more-btn");

seeMoreButtons.forEach(button => {
    button.addEventListener("click", function() {
        // Find the corresponding hidden text in the same blog
        const moreText = this.previousElementSibling.querySelector(".blog-more");

        if (moreText.style.display === "none" || moreText.style.display === "") {
            moreText.style.display = "inline"; // show the extra text
            this.textContent = "See Less";      // change button text
        } else {
            moreText.style.display = "none";    // hide the extra text
            this.textContent = "See More";      // reset button text
        }
    });
});
