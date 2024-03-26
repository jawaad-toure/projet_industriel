function updateQuantities() {
    var newPersonCount = parseInt(document.getElementById('recipeFor').innerText);
    var initialPersonCount = parseInt(document.getElementById('recipeFor').getAttribute('data-initial'));
    var factor = newPersonCount / initialPersonCount;

    var quantities = document.querySelectorAll('.ingredient-quantity');

    quantities.forEach(function (quantityElement) {
        var initialQuantity = parseFloat(quantityElement.getAttribute('data-initial'));
        var unit = quantityElement.getAttribute('data-unit');
        var newQuantity = initialQuantity * factor;
        if (newQuantity > 1 && Number.isInteger(newQuantity)) {
            quantityElement.innerText = newQuantity.toFixed(0) + ' ' + unit + 's';
        } else {
            quantityElement.innerText = newQuantity.toFixed(1) + ' ' + unit + 's'; 
        }

        if (newQuantity === 1) {
            quantityElement.innerText = newQuantity.toFixed(0) + ' ' + unit;
        }
    });
}

function increment() {
    var currentValue = parseInt(document.getElementById('recipeFor').innerText);
    document.getElementById('recipeFor').innerText = currentValue + 1;
    updateQuantities();
}

function decrement() {
    var currentValue = parseInt(document.getElementById('recipeFor').innerText);
    if (currentValue > 1) {
        document.getElementById('recipeFor').innerText = currentValue - 1;
        updateQuantities();
    }
}

window.onload = function () {
    updateQuantities();
};