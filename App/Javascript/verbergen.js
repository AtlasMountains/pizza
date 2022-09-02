let checkbox = document.getElementById("account");
let verborgenItem = document.getElementById("verbergen");

document.addEventListener("DOMContentLoaded", function () {
    tonenOfVerbergen();
});
checkbox.addEventListener('change', tonenOfVerbergen);

function tonenOfVerbergen() {
    if (checkbox.checked) {
        verborgenItem.style.display = 'contents';
    } else {
        verborgenItem.style.display = 'none';
    }
}
