$(function () {
	var $order = $('.order');
	var priceBook = parseInt($order.data('price-book'), 10);
	var pricePost = parseInt($order.data('price-post'), 10);

	$('#amount').on('change input', function () {
		var amount = parseInt($(this).val(), 10) || 0;
		$('#amountTable').text(amount + 'x');
		$('#priceTable').text((amount * priceBook) + ' Kč');
		$('#priceTotal').text((amount * priceBook + pricePost) + ' Kč');
	});
});
