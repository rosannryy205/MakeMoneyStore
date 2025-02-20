function increment() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}

function decrement() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
    document.getElementById('number').value = value;
}

function selectSize(element) {
// Bỏ lớp 'selected' khỏi tất cả các size
const sizes = document.querySelectorAll('.size_details');
sizes.forEach(size => {
size.classList.remove('selected');
});

// Thêm lớp 'selected' cho size được click
const sizeDiv = element.querySelector('.size_details');
sizeDiv.classList.add('selected');
}