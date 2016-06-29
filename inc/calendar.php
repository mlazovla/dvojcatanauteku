<?php
/* REQUIRED functions.php */
?>
<style>
	.calendar-events {
		outline: 11px solid rgba(0,0,30,0.3);
		background: rgba(255,243,248,0.65);
		display: block;
		flex-flow: row wrap;
		justify-content: space-around;
		margin: 30px 30px 30px 30px;
		top: 0px;
	}
	.page2 {
		text-align: center;
	}

	.calendar-events {
		padding: 20px 20px 20px 20px;
		max-width: 1200px;
		height: 85%;
		-webkit-column-count: 3; /* Chrome, Safari, Opera */
		-moz-column-count: 3; /* Firefox */
		column-count: 3;
		overflow: auto;
		display: inline-block;
	}

	.calendar-event {
		text-align: left;
		border-top: 5px double rgba(0,0,0,0.5);
		width: 100%;
		display: inline-flex;
		font-size: small;
		line-height: 140%;
		font-weight: 400;

		padding: 3px 3px;
		margin-bottom: 13px;
		border-radius: 0 0 3px 3px;
		box-shadow: 0 1px 1px rgba(123,140,160,0.2);
	}
	.calendar-event:nth-child(4n+0) {  background-color: rgba(255,255,200,0.2);  }
	.calendar-event:nth-child(4n+1) {  background-color: rgba(255,200,200,0.2);  }
	.calendar-event:nth-child(4n+2) {  background-color: rgba(200,255,200,0.2);  }
	.calendar-event:nth-child(4n+3) {  background-color: rgba(200,255,255,0.2);  }

	.calendar-event .date {
		color: rgba(0,0,0,1);
		display: block;
		font-weight: 600;
		font-size: smaller;
	}

	.calendar-event p {
		margin: 0 0 0 7px;
		display: inline;
	}

	@media (max-width: 1250px) {
		.calendar-events {
			padding: 20px 20px 20px 20px;
			width: 750px;
			-webkit-column-count: 2; /* Chrome, Safari, Opera */
			-moz-column-count: 2; /* Firefox */
			column-count: 2;
		}
	}

	@media (max-width: 768px) {
		.page2 {
			overflow: auto;
		}
		.page2 > div {
			display: block;
			width: 74%;
			margin: 30px auto 30px auto;
			position: static;

		}

		.calendar-events {
			display: block;
			flex: none;
			max-height: 90vh !important;
			width: 100%;
			-webkit-column-count: 1; /* Chrome, Safari, Opera */
			-moz-column-count: 1; /* Firefox */
			column-count: 1;
		}

		.calendar-event {
			display: block;
			width: 100%;
		}
	}

</style>

<script>
	$(document).on('ready', function() {
		$(".calendar-events").scrollLeft(10);
		$("#calendar-move-left").on("click", function() {
			$(".calendar-events").scrollLeft( $(".calendar-events").scrollLeft()-$(".calendar-event").width() );
		})
		$("#calendar-move-right").on("click", function() {
			$(".calendar-events").scrollLeft( $(".calendar-events").scrollLeft()+$(".calendar-event").width() );
		})

	})

</script>

<section class="page2">
	<div class="calendar-events">
		<span id="calendar-move-left" class="button circle desktop-only" style="position: absolute; left:20px; bottom:10px;">«</span>
		<span id="calendar-move-right" class="button circle desktop-only" style="position: absolute; right:20px; bottom:10px;">»</span>
		<h2>Nepravidelný občasník<span class="mobile-only"> »</span></h2>
		<br/><br/>
		<?php
			foreach(loadPosts(connectDatabase()) as $post) {
				echo '<div class="calendar-event">
						<p>
							<span class="date">'. $post['date']->format('H:i j.n.Y') .'</span>
							'. nl2br($post['content']) .'</p>
					</div>';
			}
		?>



	</div>

</section>