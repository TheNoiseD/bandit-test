const price = parseFloat(document.getElementById('price').innerHTML);
$('#participants').on('change', function() {
    let participants = $(this).val();
    let total = price * participants;
    total = total.toFixed(2);
    let priceHtml = document.getElementById('price');
    priceHtml.innerHTML = total;
})
