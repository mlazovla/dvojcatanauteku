$(function () {
	$('.main').onepage_scroll({
		sectionContainer: 'section',
		responsiveFallback: 800,
		loop: false
	});

	var $events = $('.calendar-events');
	$events.scrollLeft(10);
	$('#calendar-move-left').on('click', function () {
		$events.scrollLeft($events.scrollLeft() - $('.calendar-event').width());
	});
	$('#calendar-move-right').on('click', function () {
		$events.scrollLeft($events.scrollLeft() + $('.calendar-event').width());
	});
});
